<?php

namespace App\Http\Controllers;


use App\Models\Job;
use App\Models\ViewHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function index()
    {

        return view('website.index');
    }

    public function changeLang($lang)
    {

        session(['lang' => $lang]);
        App::setLocale($lang);

        return back();
    }

    public function showSignUp()
    {

        $this->setPerUrl();

        return view('website.auth.SignUp');
    }

    // show login page
    public function showlogin()
    {

        return view('website.auth.LogIn');
    }

    // show forgot Password page
    public function showforgotPass()
    {

        return view('website.auth.forgotPass');
    }

    // show Confrim Phone number page
    public function showConfrimPhone()
    {

        return view('website.auth.confrim_phone');
    }


    // logout
    public function logOut()
    {

        Auth::logout();
        session()->invalidate();
        return back();
    }


    public function showAllJobs()
    {

        $Jobs = Job::where("status", "تایید شده")->paginate(9);
        if ($Jobs->count() == 0) {
            $Jobs = null;
        }

        return view("website.AllJobs", compact('Jobs'));
    }

    public function showJob(Job $job)
    {

        if ($job->status == 'تایید نشده') {

            return back();
        }

        $views = new ViewHistory();
        $views->addView($job);

        $comments = $job->comments()->where("status", 'تایید شده')->paginate(10);

        return view("website.Job", compact('job', 'comments'));
    }


    public function setPerUrl()
    {

        if (!session()->has("PER_URL")) {

            return session(['PER_URL' => url()->previous()]);
        }
        return false;
    }

    public function getEmptySelect()
    {

        $select = __('message.choose');
        return "<option selected='selected'>$select</option>";
    }


    public function showContactUs()
    {

        return view("website.ContactUs");
    }

    public function showAboutUs()
    {

        return view("website.AboutUs");
    }
}
