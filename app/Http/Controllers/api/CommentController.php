<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Comment;
use App\Models\CommentLikes;
use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{

    public function getAll(Job $job, $isAuth)
    {

        $comments = $job->comments()->where('status', 'تایید شده')->get();

        $result = [];
        foreach ($comments as $cmt) {

            $comment =  $cmt->toArray();
            $comment['cmt_id'] = intval($cmt->id);
            $likedNum = $cmt->likesNum();
            $unlikedNum = $cmt->unlikesNum();
            $comment['liked'] = $likedNum;
            $comment['unliked'] = $unlikedNum;

            if ($isAuth != 'false') {

                $likeU = CommentLikes::where('user_id', $isAuth)->where('type_user', 'user')->where('comment_id', $cmt->id)->where('comment_type', 'comment')->first();
                if ($likeU != null) {

                    if ($likeU->like_type == 'like') {

                        $comment['userLiked'] = 'liked';
                    } else {

                        $comment['userLiked'] = 'unliked';
                    }
                } else {

                    $comment['userLiked'] = 'false';
                }
            } else {

                $comment['userLiked'] = 'false';
            }

            $infosAll = $cmt->user()->first()->toArray();

            $result[] = array_merge($comment, $infosAll);
        }

        $order = collect($result);
        return response($order->sortByDesc('cmt_id'), 200);
    }

    public function getUserAll(User $user,$type) {
        
        if($type == 1) {
            $queryCmt = $user->comments()->where('status' , 'تایید شده')->where('deleted_at',null)->get();
        }
        else if($type == 2) {
            
           $queryCmt = $user->comments()->where('status' , 'تایید نشده')->where('deleted_at',null)->get();
        }
        else if($type == 3) {
            
           $queryCmt = $user->comments()->withTrashed()->where('deleted_at','!=',null)->get(); 
        }
        else {
            
            $queryCmt = $user->comments()->withTrashed()->get();
        }
        
        $result = [];
        foreach($queryCmt as $cmt) {
            
            $cmtAll = $cmt->toArray();
            $cmtAll['job_name_fa'] = $cmt->job()->first()->job_name_fa;
            $cmtAll['job_name_en'] = $cmt->job()->first()->job_name_en;
            $cmtAll['job_name_ar'] = $cmt->job()->first()->job_name_ar;
            $cmtAll['job_img'] = $cmt->job()->first()->banner;
            $result []=$cmtAll;
        }
        return $result;
    }

    public function add(Job $job, User $user, Request $request)
    {

        // validation
        $validation = Validator::make($request->all(), [
            'comment_text' => ['required', 'string'],
        ]);

        if ($validation->fails()) {

            $errors = $validation->errors()->first();
            return response($errors, 302);
        }

        Comment::create([
            "user_id" => $user->id,
            "job_id" => $job->id,
            "comment_text" => nl2br($request->comment_text),
        ]);

        return response('ثبت شد', 200);
    }

    public function like(User $user, $comment)
    {

        $resultAll = [];


        $check = CommentLikes::where("user_id", $user->id)->where("comment_id", $comment)->where("comment_type", "comment")->where("like_type", "like")->where("type_user", "user")->first();

        if ($check != []) {

            $check->delete();

            $msg = 'like removed';
        } else {

            $check2 = CommentLikes::where("user_id", $user->id)->where("comment_id", $comment)->where("comment_type", "comment")->where("like_type", "unlike")->where("type_user", "user")->first();

            if ($check2 != []) {

                $check2->update([
                    "like_type" => "like",
                ]);

                $msg = 'liked';
            } else {

                CommentLikes::create([
                    "user_id" => $user->id,
                    "comment_id" => $comment,
                    "like_type" => "like",
                    "comment_type" => "comment",
                    "type_user" => "user",
                ]);


                $msg = 'liked';
            }
        }

        $cmtLikeNum = Comment::where("id", $comment)->first()->likesNum();
        $cmtUnLikeNum = Comment::where("id", $comment)->first()->unlikesNum();

        $resultAll = [$cmtLikeNum,$cmtUnLikeNum, $msg];

        return response($resultAll, 200);
    }

    public function unlike(User $user, $comment)
    {

        $resultAll = [];

        $check = CommentLikes::where("user_id", $user->id)->where("comment_id", $comment)->where("comment_type", "comment")->where("like_type", "unlike")->where("type_user", "user")->first();

        if ($check != []) {

            $check->delete();

            $msg = 'unlike removed';
        } else {

            $check2 = CommentLikes::where("user_id", $user->id)->where("comment_id", $comment)->where("comment_type", "comment")->where("like_type", "like")->where("type_user", "user")->first();

            if ($check2 != []) {

                $check2->update([
                    "like_type" => "unlike",
                ]);

                $msg = 'unliked';
            } else {

                CommentLikes::create([
                    "user_id" => $user->id,
                    "comment_id" => $comment,
                    "like_type" => "unlike",
                    "comment_type" => "comment",
                    "type_user" => "user",
                ]);

                $msg = 'unliked';
            }
        }

        $cmtLikeNum = Comment::where("id", $comment)->first()->likesNum();
        $cmtUnLikeNum = Comment::where("id", $comment)->first()->unlikesNum();

        $resultAll = [$cmtLikeNum,$cmtUnLikeNum, $msg];

        return response($resultAll, 200);
    }

    // delete
    public function delete(Comment $comment,$type)
    {

        $this->deleteCmtLikes($comment);

        $user_id = $comment->user()->first();

        $comment->delete();
        return $this->getUserAll($user_id,$type);
    }

    public function deleteCmtLikes($comment)
    {

        $cmtLikes = CommentLikes::where("comment_id", $comment->id)->where("comment_type", "comment")->get();
        foreach ($cmtLikes as $cmt) {

            $cmt->delete();
        }
    }

    public function editCmtUser(Request $request, $comment)
    {

        // validation
        $validation = Validator::make($request->all(), [
            "comment_text" => ['required', 'string'],
        ]);

        if ($validation->fails()) {

            $errors = $validation->errors();
            return response($errors->first(), 200);
        }

        Comment::where("id", $comment)->withTrashed()->update([
            "status" => "تایید نشده",
            "comment_text" => $request->comment_text,
            "deleted_at" => null,
        ]);



        return response('edited', 200);
    }
}
