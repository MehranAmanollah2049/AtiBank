<?php

namespace App\Http\Controllers;

use App\Http\Controllers\helper\Helper;
use App\Http\Requests\Comment\CommentAdd;
use App\Models\Answer;
use App\Models\Comment;
use App\Models\CommentLikes;
use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{

    public function add(Job $job,Request $request) {

        // validation
        $validation = Validator::make($request->all(), [
            'Comment_text' => ['required', 'string'],
        ]);

        if ($validation->fails()) {

            $errors = $validation->errors();
            Helper::msg($errors->first(), 'error');
            return back();
        }

        Comment::create([
            "user_id" => auth()->user()->id,
            "job_id" => $job->id,
            "comment_text" => nl2br($request->Comment_text),
        ]);

        Helper::msg(__('message.CommentSucess') , 'success');
        return back();

    }
    
    // delete
    public function delete(Comment $comment)
    {

        $this->deleteCmtLikes($comment);

        $comment->delete();
        Helper::msg('دیدگاه مورد نظر با موفقیت حذف شد', 'success');
        return back();
    }

    // accept
    public function accept(Comment $comment)
    {

        $comment->update([
            "status" => "تایید شده",
        ]);

        Helper::msg('دیدگاه مورد نظر با موفقیت تایید شد', 'success');
        return back();
    }

    // getText
    public function getText($comment)
    {

        return Comment::where('id' , $comment)->withTrashed()->first()->comment_text;
    }

    // search from comment where status == تایید نشده
    public function search1(Request $request)
    {

        $commentsNotAccepted = Comment::where("status", "تایید نشده")->get();

        if ($request->input("searchVal") != "") {

            $user = User::where("name", "LIKE", "%" . $request->input("searchVal") . "%")->orwhere("family", "LIKE", "%" . $request->input("searchVal") . "%")->first();
            if ($user != []) {
                $commentsNotAccepted = $user->comments()->where("status", "تایید نشده")->get();
            } else {

                $job = Job::where("job_name_fa", "LIKE", "%" . $request->input("searchVal") . "%")->orwhere("job_name_en", "LIKE", "%" . $request->input("searchVal") . "%")->orwhere("job_name_ar", "LIKE", "%" . $request->input("searchVal") . "%")->first();
                if ($job != []) {
                    $commentsNotAccepted = $job->comments()->where("status", "تایید نشده")->get();
                }
            }
        }

        $commentsAccepted = Comment::where("status", "تایید شده")->get();

        return view("admin.Comments.comments", [
            "sideBar" => "comments",
            "commentsAccepted" => $commentsAccepted,
            "commentsNotAccepted" => $commentsNotAccepted,
        ]);
    }

    // search from comment where status == تایید شده
    public function search2(Request $request)
    {

        $commentsAccepted = Comment::where("status", "تایید شده")->get();

        if ($request->input("searchVal") != "") {

            $commentsAccepted = Comment::where("id", $request->input("searchVal"))->orwhere("comment_text", "LIKE", "%" . $request->input("searchVal") . "%")->where("status", "تایید شده")->get();
            if ($commentsAccepted->count() == 0) {

                $user = User::where("name", "LIKE", "%" . $request->input("searchVal") . "%")->orwhere("family", "LIKE", "%" . $request->input("searchVal") . "%")->first();
                if ($user != []) {
                    $commentsAccepted = $user->comments()->where("status", "تایید شده")->get();
                } else {

                    $job = Job::where("job_name_fa", "LIKE", "%" . $request->input("searchVal") . "%")->orwhere("job_name_en", "LIKE", "%" . $request->input("searchVal") . "%")->orwhere("job_name_ar", "LIKE", "%" . $request->input("searchVal") . "%")->first();
                    if ($job != []) {
                        $commentsAccepted = $job->comments()->where("status", "تایید شده")->get();
                    }
                }
            }
        }

        $commentsNotAccepted = Comment::where("status", "تایید نشده")->get();

        return view("admin.Comments.comments", [
            "sideBar" => "comments",
            "commentsAccepted" => $commentsAccepted,
            "commentsNotAccepted" => $commentsNotAccepted,
        ]);
    }

    public function deleteCmtLikes($comment) {

        $cmtLikes = CommentLikes::where("comment_id" , $comment->id)->where("comment_type" , "comment")->get();
        foreach($cmtLikes as $cmt) {

            $cmt->delete();
        }
    }

    public function editCmtUser(Request $request,$comment,$type) {

        // validation
        $validation = Validator::make($request->all(), [
            "Comment_text" => ['required' , 'string'],
        ]);

        if ($validation->fails()) {

            $errors = $validation->errors();
            Helper::msg($errors->first(), 'error');
            return back();
        }

        if($type == "comment") {

            Comment::where("id" , $comment)->withTrashed()->update([
                "status" => session()->has('admin') ? "تایید شده" : "تایید نشده",
                "comment_text" => $request->Comment_text,
                "deleted_at" => null,
            ]);
        }
        else if($type == "answer") {

            Answer::where("id" , $comment)->withTrashed()->update([
                "status" => session()->has('admin') ? "تایید شده" : "تایید نشده",
                "answer_text" => $request->Comment_text,
                "deleted_at" => null,
            ]);
        }
        else {

            return back();
        }


        Helper::msg(__('message.CmtEdited') , 'success');
        return back();
    }

    public function deleteCmtUser($comment,$type) {

        if($type == "comment") {

            Comment::where("id" , $comment)->delete();
        }
        else if($type == "answer") {

            Answer::where("id" , $comment)->delete();
        }
        else {

            return back();
        }


        Helper::msg(__('message.CmtDeleted') , 'success');
        return back();
    }
}
