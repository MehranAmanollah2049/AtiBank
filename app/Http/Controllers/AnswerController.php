<?php

namespace App\Http\Controllers;

use App\Http\Controllers\helper\DateHelper;
use App\Http\Controllers\helper\Helper;
use App\Http\Requests\Answer\AnswerAddRequest;
use App\Models\Answer;
use App\Models\Comment;
use App\Models\CommentLikes;
use App\Models\Job;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AnswerController extends Controller
{
    // add
    public function add(Request $request)
    {

        // validation
        $validation = Validator::make($request->all(), [
            "answer_text" => "required|string",
        ]);

        if ($validation->fails()) {

            $errors = $validation->errors();
            Helper::msg($errors->first(), 'error');
            return back();
        }

        Answer::create([
            "user_id_sender" => session()->has("admin") ? session("admin") : auth()->user()->id,
            "user_id_receiver" => $request->input("user_id_receiver"),
            "comment_id" => $request->input("comment_id"),
            "answer_text" => nl2br($request->answer_text),
            "status" => session()->has("admin") ? "تایید شده" : "تایید نشده",
            "type_sender" => session()->has("admin") ? "admin" : "user",
            "type_receiver" => $request->input("Receiver"),
        ]);

        Helper::msg(__("message.CommentSucess"), 'success');

        return back();
    }

    // delete
    public function delete(Answer $answer)
    {

        $this->deleteCmtLikes($answer);
        $answer->delete();
        Helper::msg('دیدگاه مورد نظر با موفقیت حذف شد', 'success');
        return back();
    }

    // accept
    public function accept(Answer $answer)
    {

        $answer->update([
            "status" => "تایید شده",
        ]);

        Helper::msg('دیدگاه مورد نظر با موفقیت تایید شد', 'success');
        return back();
    }

    // show Answer Text
    public function showAnswerText($answer)
    {

        return Answer::where('id' , $answer)->withTrashed()->first()->answer_text;
    }

    // edit
    public function edit(AnswerAddRequest $request, Answer $answer)
    {

        $validation = $request->validated();

        $answer->update($validation);

        Helper::msg('دیدگاه مورد نظر با موفقیت ویرایش شد', 'success');
        return back();
    }

    // search
    public function search(Request $request)
    {

        $answersAccepted = Answer::where("status", "تایید شده")->get();

        if ($request->input("searchVal") != "") {

            if (DateTime::createFromFormat('Y-m-d', $request->input("searchVal")) !== false) {

                $answersAccepted = [];
                $answers = Answer::where("status", "تایید شده")->get();
                foreach ($answers as $answer) {

                    if (DateHelper::FaConvert($answer->created_at) == $request->input("searchVal")) {

                        $answersAccepted[] = $answer;
                    }
                }
            } else {

                $answersAccepted = Answer::where("status", "تایید شده")->where("id", $request->input("searchVal"))->orwhere("answer_text", "LIKE", "%" . $request->input("searchVal") . "%")->get();
                if ($answersAccepted->count() == 0) {

                    if ($request->input("searchVal") == "ادمین") {

                        $answersAccepted = Answer::where("status", "تایید شده")->where("type_sender", "admin")->orwhere("type_receiver", "admin")->get();
                    } else {

                        $user = User::where("name", "LIKE", "%" . $request->input("searchVal") . "%")->orwhere("family", "LIKE", "%" . $request->input("searchVal") . "%")->first();
                        if ($user != []) {

                            $answersAccepted = [];
                            foreach ($user->answersSender()->where("status", "تایید شده")->get() as $answer) {

                                $answersAccepted[] = $answer;
                            }

                            foreach ($user->answersGetter()->where("status", "تایید شده")->get() as $answer) {

                                $answersAccepted[] = $answer;
                            }
                        } else {

                            $jobs = Job::where("job_name_fa", "LIKE", "%" . $request->input("searchVal") . "%")->orwhere("job_name_en", "LIKE", "%" . $request->input("searchVal") . "%")->where("job_name_ar", "LIKE", "%" . $request->input("searchVal") . "%")->first();
                            if ($jobs != []) {

                                $answersAccepted = [];
                                $cmts = $jobs->comments()->where("status", "تایید شده")->get();
                                foreach ($cmts as $cmt) {

                                    $answers = $cmt->answers()->where("status", "تایید شده")->get();
                                    foreach ($answers as $answer) {

                                        $answersAccepted[] = $answer;
                                    }
                                }
                            } else {

                                $comment = Comment::where("id", $request->input("searchVal"))->where("status", "تایید شده")->first();
                                if ($comment != []) {

                                    $answersAccepted = $comment->answers()->where("status", "تایید شده")->get();
                                }
                            }
                        }
                    }
                }
            }
        }


        $answersNotAccepted = Answer::where("status", "تایید نشده")->get();

        return view("admin.Comments.answers_list", [
            "sideBar" => "comments",
            "answersNotAccepted" => $answersNotAccepted,
            "answersAccepted" => $answersAccepted,
        ]);
    }

    // search2
    public function search2(Request $request)
    {

        $answersNotAccepted = Answer::where("status", "تایید نشده")->get();

        if ($request->input("searchVal") != "") {

            if (DateTime::createFromFormat('Y-m-d', $request->input("searchVal")) !== false) {

                $answersNotAccepted = [];
                $answers = Answer::where("status", "تایید نشده")->get();
                foreach ($answers as $answer) {

                    if (DateHelper::FaConvert($answer->created_at) == $request->input("searchVal")) {

                        $answersNotAccepted[] = $answer;
                    }
                }
            } else {

                $answersNotAccepted = Answer::where("status", "تایید نشده")->where("id", $request->input("searchVal"))->orwhere("answer_text", "LIKE", "%" . $request->input("searchVal") . "%")->get();
                if ($answersNotAccepted->count() == 0) {

                    if ($request->input("searchVal") == "ادمین") {

                        $answersNotAccepted = Answer::where("status", "تایید نشده")->where("type_sender", "admin")->orwhere("type_receiver", "admin")->get();
                    } else {

                        $user = User::where("name", "LIKE", "%" . $request->input("searchVal") . "%")->orwhere("family", "LIKE", "%" . $request->input("searchVal") . "%")->first();
                        if ($user != []) {

                            $answersNotAccepted = [];
                            foreach ($user->answersSender()->where("status", "تایید نشده")->get() as $answer) {

                                $answersNotAccepted[] = $answer;
                            }

                            foreach ($user->answersGetter()->where("status", "تایید نشده")->get() as $answer) {

                                $answersNotAccepted[] = $answer;
                            }
                        } else {

                            $jobs = Job::where("job_name_fa", "LIKE", "%" . $request->input("searchVal") . "%")->orwhere("job_name_en", "LIKE", "%" . $request->input("searchVal") . "%")->where("job_name_ar", "LIKE", "%" . $request->input("searchVal") . "%")->first();
                            if ($jobs != []) {

                                $answersNotAccepted = [];
                                $cmts = $jobs->comments()->where("status", "تایید نشده")->get();
                                foreach ($cmts as $cmt) {

                                    $answers = $cmt->answers()->where("status", "تایید نشده")->get();
                                    foreach ($answers as $answer) {

                                        $answersNotAccepted[] = $answer;
                                    }
                                }
                            } else {

                                $comment = Comment::where("id", $request->input("searchVal"))->where("status", "تایید نشده")->first();
                                if ($comment != []) {

                                    $answersNotAccepted = $comment->answers()->where("status", "تایید نشده")->get();
                                }
                            }
                        }
                    }
                }
            }
        }




        $answersAccepted = Answer::where("status", "تایید شده")->get();

        return view("admin.Comments.answers_list", [
            "sideBar" => "comments",
            "answersNotAccepted" => $answersNotAccepted,
            "answersAccepted" => $answersAccepted,
        ]);
    }

    public function deleteCmtLikes($comment) {

        $cmtLikes = CommentLikes::where("comment_id" , $comment->id)->where("comment_type" , "answer")->get();
        foreach($cmtLikes as $cmt) {

            $cmt->delete();
        }
    }
}
