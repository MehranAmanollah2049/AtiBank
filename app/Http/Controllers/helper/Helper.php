<?php

namespace App\Http\Controllers\helper;

use App\Models\CommentLikes;

class Helper {

    // delete Images from directory
    public static function RemoveImg($src) {

        return true;
        // if($src != "/Tools/Images/Website_images/user.svg") {

        //     unlink($src);
        // }
    }

    // upload image
    public static function uploadImg($file,$path) {


        $basePt = "/Tools/Images" . $path;
        $pathName = "Tools/Images" . $path;
        $pathImg = $file->store($pathName);
        $move = $file->move(public_path($basePt) , $pathImg);

        if($move) {

            return $pathImg;
        }

    }
    
 

    // create toast
    public static function msg($text,$type,$timer = 5000) {

        toast($text, $type)->timerProgressBar()->autoClose($timer)->hideCloseButton();
    }

    // delete user infos
    public static function del_user_infos($user)
    {

        // delete comments
        $comments = $user->comments()->get();
        foreach ($comments as $cmt) {

            $answers = $cmt->answers()->get();
            foreach ($answers as $answer) {

                $answer->delete();
            }

            $cmt->delete();
        }

        $answersSender = $user->answersSender()->get();
        foreach ($answersSender as $answer) {

            $answer->delete();
        }

        $answersGetter = $user->answersGetter()->get();
        foreach ($answersGetter as $answer) {

            $answer->delete();
        }


        // delete Advertising
        $Advertising = $user->advertising()->get();
        foreach ($Advertising as $ads) {

            $ads->delete();
        }

        $cmtLikes = CommentLikes::where("user_id" , $user->id)->where("type_user" , "user")->get();
        foreach($cmtLikes as $cmt) {

            $cmt->delete();
        }
    }

    // delete user jobs
    public static function del_user_jobs($user)
    {

        $jobs = $user->jobs()->get();
        foreach ($jobs as $job) {

            Helper::RemoveImg($job->banner);

            $images = $job->galley()->get();
            foreach ($images as $img) {

                Helper::RemoveImg($img->image);
            }

            $job->delete();
        }
    }


    public static function getPhone($request)
    {
        return $request->Number_code . $request->phoneNumber;
    }
}

