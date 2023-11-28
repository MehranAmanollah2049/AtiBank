<?php

namespace App\Http\Controllers;

use App\Http\Controllers\helper\Helper;
use App\Models\AboutUs;
use App\Models\Admin;
use App\Models\Advertising;
use App\Models\Answer;
use App\Models\City;
use App\Models\Comment;
use App\Models\Contact;
use App\Models\Country;
use App\Models\Job;
use App\Models\JobGallery;
use App\Models\MainCategory;
use App\Models\State;
use App\Models\Subcategory;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class AdminController extends Controller
{

    // showlogIn
    public function showlogIn() {

        return view('admin.logInPage');
    }

    // logIn
    public function logIn(Request $request)
    {

        $validation = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $admin = Admin::where('username', $validation['username'])->where("password", $validation['password'])->first();

        if ($admin != []) {

            session(["admin" => $admin->id]);
            Auth::logout();
            Helper::msg('به پنل ادمین خوش آمدید', 'success');
            return redirect('admin/index');

        } else {

            Helper::msg('نام کاربری و رمز عبور شما صحیح نمی باشد', 'error');
            return back();
            
        }
    }

    // show Country page
    public function showCountry()
    {

        $countrys = Country::all();

        return view('admin.positions.country.countrys', [
            'sideBar' => 'positions',
            "countrys" => $countrys,
        ]);
    }

    // show Edit Country page
    public function showEditCountry(Country $country)
    {

        return view('admin.positions.country.edit_countrys', [
            'sideBar' => 'positions',
            "country" => $country,
        ]);
    }

    // show State page
    public function showState()
    {

        $states = State::all();

        return view("admin.Positions.state.states", [
            "sideBar" => "positions",
            "states" => $states,
        ]);
    }

    // show Edit State page
    public function showEditState(State $state)
    {

        return view("admin.Positions.state.edit_state", [
            "sideBar" => "positions",
            "state" => $state,
        ]);
    }

    // show City page
    public function showCity()
    {

        $citys = City::all();
      
        return view("admin.Positions.city.citys", [
            "sideBar" => "positions",
            "citys" => $citys,
        ]);
    }

    // show Edit City page
    public function showEditCity(City $city)
    {

        return view("admin.Positions.city.edit_city", [
            "sideBar" => "positions",
            "city" => $city,
        ]);
    }

    // show MainCategory page
    public function showMainCategory()
    {

        $categories = MainCategory::all();

        return view("admin.Catagorys.main_catagory.main_catagory", [
            "sideBar" => "catagorys",
            "categories" => $categories,
        ]);
    }

    // show Edit MainCategory page
    public function showEditMainCategory(MainCategory $mainCategory)
    {

        return view("admin.Catagorys.main_catagory.edit_main_catagory", [
            "sideBar" => "catagorys",
            "category" => $mainCategory,
        ]);
    }

    // Show Subcategory page
    public function ShowSubcategory()
    {

        $subcategories = Subcategory::all();

        return view("admin.Catagorys.subcategory.subcategory", [
            "sideBar" => "catagorys",
            "subcategories" => $subcategories,
        ]);
    }

    // Show Edit Subcategory page
    public function ShowEditSubcategory(Subcategory $subcategory)
    {

        return view("admin.Catagorys.subcategory.edit_subcategory", [
            "sideBar" => "catagorys",
            "subcategory" => $subcategory,
        ]);
    }

    // show job page
    public function showJob()
    {

        $jobs = Job::all();

        return view("admin.Jobs.jobs", [
            "sideBar" => "jobs",
            "jobs" => $jobs,
        ]);
    }


    // show edit job page
    public function showEditJob(Job $job)
    {

        return view("admin.Jobs.edit_job", [
            "sideBar" => "jobs",
            "job" => $job,
        ]);
    }


    // show add picture to job page
    public function showAddpicJob(Job $job)
    {

        $gallery = $job->galley()->get();

        return view("admin.Jobs.add_pic_jobs", [
            "sideBar" => "jobs",
            "gallery" => $gallery,
            "job" => $job,
        ]);
    }

    // show Edit Pic
    public  function showEditPic(JobGallery $jobgallery) {

        return view("admin.Jobs.edit_pic_jobs", [
            "sideBar" => "jobs",
            "gallery" => $jobgallery,
        ]);
    }


    // show users page
    public function showUsers()
    {

        $users = User::all();

        return view("admin.Users.users", [
            "sideBar" => "users",
            "users" => $users,
        ]);
    }


    // show user info page
    public function showUserInfo($phoneNumber)
    {

        $user = User::where("phoneNumber", $phoneNumber)->first();
        if ($user != []) {

            $comments = User::where("phoneNumber", $phoneNumber)->first()->comments()->get();
            $answers = [];
            foreach ($comments as $cmt) {

                $ans = $cmt->answers()->get();
                foreach ($ans as $an) {

                    $answers[] = $an;
                }
            }
        } else {

            $comments = [];
            $answers = [];
        }

        return view("admin.Users.users_info", [
            "sideBar" => "users",
            "user" => $user,
            "phoneNumber" => $phoneNumber,
            "comments" => $comments,
            "answers" => $answers,
        ]);
    }


    // show comments page
    public function showCommentPage()
    {

        $commentsAccepted = Comment::where("status", "تایید شده")->get();
        $commentsNotAccepted = Comment::where("status", "تایید نشده")->get();

        return view("admin.Comments.comments", [
            "sideBar" => "comments",
            "commentsAccepted" => $commentsAccepted,
            "commentsNotAccepted" => $commentsNotAccepted,
        ]);
    }

    // show Answer Comment page
    public function showAnswerComment($comment_id, $user_id_receiver, $getterType)
    {

        return view("admin.Comments.answer", [
            "sideBar" => "comments",
            "comment_id" => $comment_id,
            "user_id_receiver" => $user_id_receiver,
            "getterType" => $getterType,
        ]);
    }

    // show answer list page
    public function answerList()
    {

        $answersNotAccepted = Answer::where("status", "تایید نشده")->get();
        $answersAccepted = Answer::where("status", "تایید شده")->get();

        return view("admin.Comments.answers_list", [
            "sideBar" => "comments",
            "answersNotAccepted" => $answersNotAccepted,
            "answersAccepted" => $answersAccepted,
        ]);
    }

    // show Edit Page
    public function showEditPage(Answer $answer)
    {

        return view("admin.Comments.edit_answer", [
            "sideBar" => "comments",
            "answer" => $answer,
        ]);
    }

    // show ticket page
    public function showTicket()
    {

        $tickets = Ticket::all();

        return view("admin.Comments.tickets", [
            "sideBar" => "comments",
            "tickets" => $tickets,
        ]);
    }

    // show ads page
    public function showAds()
    {

        $ads = Advertising::all();

        return view("admin.ads.ads", [
            "sideBar" => "ads",
            "ads" => $ads,
        ]);
    }

    // showEditAds
    public function showEditAds(Advertising $advertising)
    {

        return view("admin.ads.edit_ads", [
            "sideBar" => "ads",
            "ads" => $advertising,
        ]);
    }

    // show Add Price page
    public function showAddPrice(Advertising $advertising)
    {

        return view("admin.ads.addPrice", [
            "sideBar" => "ads",
            "ad" => $advertising,
        ]);
    }

    // sho call requests page
    public function showCallRequests()
    {

        $contacts = Contact::all();

        return view("admin.Call_requests.call_requests", [
            "sideBar" => "call_requests",
            "contacts" => $contacts,
        ]);
    }

    // showprofile
    public function showprofile()
    {

        $admin = Admin::where("id", session("admin"))->first();

        return view("admin.profile.profile", [
            "sideBar" => "Profile",
            "admin" => $admin,
        ]);
    }


    // edit admin profile
    public function editProfile(Request $request, Admin $admin)
    {

        $validation = $request->validate([
            "name" => "required",
            "family" => "required",
            "username" => "required",
            "password" => "required",
            "phoneNumber" => "required",
        ]);

        $admin->update($validation);

        Helper::msg('اطلاعات شما با موفقیت ویرایش شد', 'success');

        return back();
    }

    // show About us page
    public function showAbout() {

        $main_about_text = AboutUs::all()->where('type' , 'main')->first();
        $aboutAll = AboutUs::all();

        return view("admin.about_us.about", [
            "sideBar" => "about",
            "main_about_text" => $main_about_text,
            "aboutAll" => $aboutAll,
        ]);
    }

    // show Edit About us page
    public function showEditAbout(AboutUs $aboutus) {

        return view("admin.about_us.edit_about", [
            "sideBar" => "about",
            "about" => $aboutus,
        ]);
    }

    // show Deleted Data page
    public function showDeletedData() {
        
        return view("admin.deletedData.deletedData", [
            "sideBar" => "deletedData",
        ]);
    }

    // restore Data
    public function restoreData($model,$id) {

        // ===> App\Models\{Country}
        $model_table_1 = str_replace('{' , '',"App\Models\{$model}"); // ===> App\Models\{Country
        $model_table = str_replace('}' , '',$model_table_1); // ===> App\Models\Country
        $model_table::where('id',$id)->restore(); // ===> App\Models\Country::where('id',$id)->restore()
        Helper::msg("اطلاعات مورد نظر با موفقیت بازگردانی شد" , 'success');
        return back();
    }

    



    // logOut
    public function logOut()
    {

        session()->forget("admin");
        return back();
    }
}
