<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Comment;
use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PanelController extends Controller
{
    
    public function showJobMange() {

        return view("website.panel.manage_jobs.JobAdd" , [
            "sideBarPanel" => "jobs_manage",
            'sideBarPanel2' => "jobs_manage_add",
        ]);
    }

    public function showJobList($type) {


        $user = User::where("id" , auth()->user()->id)->first();
        if($type == "withTrashed") {

            $jobs = $user->jobs()->withTrashed()->paginate(10);
            $typeResend = "withOutTrashed";
        }
        else {

            $jobs = $user->jobs($type)->paginate(10);
            $typeResend = "withTrashed";
        }

        $jobsAll = $user->jobs()->withTrashed()->get();

        return view("website.panel.manage_jobs.JobList" , [
            "sideBarPanel" => "jobs_manage",
            'sideBarPanel2' => "jobs_manage_list",
            "jobsAll" => $jobsAll,
            "jobs" => $jobs,
            "typeResend" => $typeResend,
        ]);
    }

    public function showGallery(Job $job,$type) {

        if($type == "withTrashed") {

            $gallery = $job->galley()->withTrashed()->paginate(10);
            $typeResend = "withOutTrashed";
        }
        else {

            $gallery = $job->galley()->paginate(10);
            $typeResend = "withTrashed";
        }

        $galleryAll = $job->galley()->withTrashed()->get();
      
        return view("website.panel.manage_jobs.gallery" , [
            "sideBarPanel" => "jobs_manage",
            'sideBarPanel2' => "jobs_manage_list",
            "job" => $job,
            "gallery" => $gallery,
            "galleryAll" => $galleryAll,
            "typeResend" => $typeResend,
        ]);
    }

    public function showEditJob($job) {

        $job = Job::where("id" , $job)->withTrashed()->first();

        return view("website.panel.manage_jobs.edit_job" , [
            "sideBarPanel" => "jobs_manage",
            'sideBarPanel2' => "jobs_manage_list",
            "job" => $job,
        ]);
    }

    public function showFavList() {

        $user = User::where("id" , auth()->user()->id)->first();
        $jobs = $user->likes()->get();

        return view("website.panel.favorateList.FavList" , [
            "sideBarPanel" => "favorite_list",
            "jobs" => $jobs,
        ]);
    }


    public function showCommentsList() {

        $user = User::where("id" , auth()->user()->id)->first();
        $comments = $user->comments()->withTrashed()->get();
        $answers = $user->answersSender()->withTrashed()->get();

        return view("website.panel.comments.CmtManage" , [
            "sideBarPanel" => "comments_manage",
            "comments" => $comments,
            "answers" => $answers,
        ]);
    }

    public function showEditCmt($comment,$type) {

        if($type == "comment") {

            $text = Comment::where("id" , $comment)->withTrashed()->first()->comment_text;
        }
        else if($type == "answer") {

            $text = Answer::where("id" , $comment)->withTrashed()->first()->answer_text;
        }
        else {

            return back();
        }

        return view("website.panel.comments.editCmt" , [
            "sideBarPanel" => "comments_manage",
            "comment" => $comment,
            "type" => $type,
            "text" => $text,
        ]);
    }

    public function showMassanger() {

        return view("website.panel.tickets.massenger" , [
            "sideBarPanel" => "tickets_manage",
        ]);
    }

    public function showProfile() {

        return view("website.panel.profile.EditProfile" , [
            "sideBarPanel" => "profile_manage",
        ]);
    }

    public function showConfrim_phone() {

        return view("website.panel.profile.Confrim_phone" , [
            "sideBarPanel" => "profile_manage",
        ]);
    }

}
