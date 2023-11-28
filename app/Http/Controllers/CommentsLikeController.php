<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Comment;
use App\Models\CommentLikes;
use Illuminate\Http\Request;

class CommentsLikeController extends Controller
{

    public function like($comment, $comment_type)
    {

        $resultAll = [];

        if (auth()->check() || session()->has("admin")) {

            $user_id = session()->has("admin") ? session("admin") : auth()->user()->id;
            $user_type = session()->has("admin") ? "admin" : "user";

            $check = CommentLikes::where("user_id", $user_id)->where("comment_id", $comment)->where("comment_type" , $comment_type)->where("like_type", "like")->where("type_user", $user_type)->first();

            if ($check != []) {

                $check->delete();

                $first = 0;
                $sec = 0;

                $msg = __('message.unlikeRemove');

            } else {

                $check2 = CommentLikes::where("user_id", $user_id)->where("comment_id", $comment)->where("comment_type" , $comment_type)->where("like_type", "unlike")->where("type_user", $user_type)->first();

                if ($check2 != []) {

                    $check2->update([
                        "like_type" => "like",
                    ]);

                    $first = 1;
                    $sec = 0;

                    $msg = __('message.liked');

                } else {

                    CommentLikes::create([
                        "user_id" => $user_id,
                        "comment_id" => $comment,
                        "like_type" => "like",
                        "comment_type" => $comment_type,
                        "type_user" => $user_type,
                    ]);

                    $first = 1;
                    $sec = 0;

                    $msg = __('message.liked');
                }
            }

            if($comment_type == "comment") {

                $cmtLikeNum = Comment::where("id" , $comment)->first()->likesNum();
                $cmtUnLikeNum = Comment::where("id" , $comment)->first()->unlikesNum();
            }
            else {

                $cmtLikeNum = Answer::where("id" , $comment)->first()->likesNum();
                $cmtUnLikeNum = Answer::where("id" , $comment)->first()->unlikesNum();
            }

            $resultAll = [$cmtLikeNum,$cmtUnLikeNum,$first,$sec,$msg];

        } else {

            $resultAll = [__('message.addCommentBtn2')];
        }

        return join("|", $resultAll);
    }

    public function unlike($comment, $comment_type)
    {

        $resultAll = [];

        if (auth()->check() || session()->has("admin")) {

            $user_id = session()->has("admin") ? session("admin") : auth()->user()->id;
            $user_type = session()->has("admin") ? "admin" : "user";

            $check = CommentLikes::where("user_id", $user_id)->where("comment_id", $comment)->where("comment_type" , $comment_type)->where("like_type", "unlike")->where("type_user", $user_type)->first();

            if ($check != []) {

                $check->delete();

                $first = 0;
                $sec = 0;

                $msg = __('message.unlikeRemove');

            } else {

                $check2 = CommentLikes::where("user_id", $user_id)->where("comment_id", $comment)->where("comment_type" , $comment_type)->where("like_type", "like")->where("type_user", $user_type)->first();

                if ($check2 != []) {

                    $check2->update([
                        "like_type" => "unlike",
                    ]);

                    $first = 0;
                    $sec = 1;

                    $msg = __('message.unlike');

                } else {

                    CommentLikes::create([
                        "user_id" => $user_id,
                        "comment_id" => $comment,
                        "like_type" => "unlike",
                        "comment_type" => $comment_type,
                        "type_user" => $user_type,
                    ]);

                    $first = 0;
                    $sec = 1;

                    $msg = __('message.unlike');
                }
            }

            if($comment_type == "comment") {

                $cmtLikeNum = Comment::where("id" , $comment)->first()->likesNum();
                $cmtUnLikeNum = Comment::where("id" , $comment)->first()->unlikesNum();
            }
            else {

                $cmtLikeNum = Answer::where("id" , $comment)->first()->likesNum();
                $cmtUnLikeNum = Answer::where("id" , $comment)->first()->unlikesNum();
            }

            $resultAll = [$cmtLikeNum,$cmtUnLikeNum,$first,$sec,$msg];

        } else {

            $resultAll = [__('message.addCommentBtn2')];
        }

        return join("|", $resultAll);
    }
}
