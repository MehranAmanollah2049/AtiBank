<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdvertisingController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\verify_phone;
use App\Http\Controllers\CategroyController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CommentsLikeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\PanelController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


/////////////////////////////////////////// admin Routs 

// check username and password to logIn
Route::get("LogInAdmin", [AdminController::class, 'showlogIn'])->middleware('guestAdmin');
Route::post("LogInAdmin", [AdminController::class, 'logIn'])->middleware('guestAdmin');
Route::get("logOutAdminPanel", [AdminController::class, 'logOut']);


// getEmptySelect
Route::get('getEmptySelect' , [HomeController::class , 'getEmptySelect']);

// all admin routs
Route::prefix('admin')->middleware('admin')->group(function () {

    // main admin page
    Route::get('/index', function () {
        return view('admin.Main.index', [
            "sideBar" => "index"
        ]);
    });


    /////// position

    // countrys
    Route::get("positions/countrys", [AdminController::class, 'showCountry']);
    Route::post("/addCountry", [CountryController::class, 'add']);
    Route::delete("country/{country}/delete", [CountryController::class, 'delete']);
    Route::get("searchCountry", [CountryController::class, 'search']);
    Route::get("positions/{country}/edit_country", [AdminController::class, 'showEditCountry']);
    Route::put("countrys/{country}/edit", [CountryController::class, 'edit']);

    // states
    Route::get("positions/states", [AdminController::class, 'showState']);
    Route::post("/addState", [StateController::class, 'add']);
    Route::delete("state/{state}/delete", [StateController::class, 'delete']);
    Route::get("searchState", [StateController::class, 'search']);
    Route::get("state/{state}/edit_state", [AdminController::class, 'showEditState']);
    Route::put("state/{state}/edit", [StateController::class, 'edit']);

    // citys
    Route::get("positions/citys", [AdminController::class, 'showCity']);
    Route::get("getStates/{country}", [StateController::class, 'getStates']);
    Route::post("addCity", [CityController::class, 'add']);
    Route::get("searchCity", [CityController::class, 'search']);
    Route::delete("citys/{city}/delete", [CityController::class, 'delete']);
    Route::get("city/{city}/edit_city", [AdminController::class, 'showEditCity']);
    Route::put("city/{city}/edit", [CityController::class, 'edit']);

    /////// catagorys

    // main catagory
    Route::get("catagorys/main_catagorys", [AdminController::class, 'showMainCategory']);
    Route::post("category/add", [CategroyController::class, 'add']);
    Route::delete("category/{mainCategory}/delete", [CategroyController::class, 'delete']);
    Route::get("searchMainCategory", [CategroyController::class, 'search']);
    Route::get("catagorys/{mainCategory}/edit_main_catagory", [AdminController::class, 'showEditMainCategory']);
    Route::put("category/{mainCategory}/edit", [CategroyController::class, 'edit']);


    // subcategory
    Route::get("catagorys/subcategory", [AdminController::class, 'ShowSubcategory']);
    Route::post("addSubcategory", [SubcategoryController::class, 'add']);
    Route::delete("subcategory/{subcategory}/delete", [SubcategoryController::class, 'delete']);
    Route::get("searchSubcategory", [SubcategoryController::class, 'search']);
    Route::get("catagorys/{subcategory}/edit_subcategory", [AdminController::class, 'ShowEditSubcategory']);
    Route::put("subcategory/{subcategory}/edit", [SubcategoryController::class, 'edit']);


    // jobs
    Route::get("jobs/", [AdminController::class, 'showJob']);
    Route::get("getCitys/{state}", [CityController::class, 'getCitys']);
    Route::get("getSubcategorys/{maincategory}", [SubcategoryController::class, 'getSubcategorys']);
    Route::post("jobs/add", [JobController::class, 'add']);
    Route::delete("job/{job}/delete", [JobController::class, 'delete']);
    Route::post("job/{job}/accept", [JobController::class, 'acceptJob']);
    Route::get("searchJob", [JobController::class, 'search']);
    Route::get("job/{job}/edit_job", [AdminController::class, 'showEditJob']);
    Route::put("job/{job}/edit", [JobController::class, 'edit']);
    Route::get("job/{job}/add_pic", [AdminController::class, 'showAddpicJob']);
    Route::post("job/{job}/add_pic", [JobController::class, 'add_pic']);
    Route::delete("jobImg/{jobgallery}/delete", [JobController::class, 'delete_pic']);
    Route::get("job/add_pic/{jobgallery}/edit", [AdminController::class, 'showEditPic']);
    Route::put("job/{jobgallery}/edit_pic", [JobController::class, 'edit_pic']);
    Route::get('job/add_pic/{jobgallery}/accept' , [JobController::class , 'accept']);
    

    // Users
    Route::get("users", [AdminController::class, 'showUsers']);
    Route::delete("user/{user}/delete/{JobDelStatus}", [UserController::class, 'delete']);
    Route::get("searchUser", [UserController::class, 'search']);
    Route::get("users/{phoneNumber}/info", [AdminController::class, 'showUserInfo']);


    // commnets
    Route::get("comments/", [AdminController::class, 'showCommentPage']);
    Route::delete("comment/{comment}/delete", [CommentController::class, 'delete']);
    Route::get("comments/{comment}/accept", [CommentController::class, 'accept']);
    Route::get("GetCommentText/{comment}", [CommentController::class, 'getText']);
    Route::get("searchCommentNotAccepted", [CommentController::class, 'search1']);
    Route::get("searchComment", [CommentController::class, 'search2']);
    Route::get("comments/{comment}/{user}/{getterType}/answer", [AdminController::class, 'showAnswerComment']);
    Route::post("answers/add", [AnswerController::class, 'add']);


    // answers
    Route::get("answers_list/", [AdminController::class, 'answerList']);
    Route::delete("answerComment/{answer}/delete", [AnswerController::class, 'delete']);
    Route::get("answerComment/{answer}/accept", [AnswerController::class, 'accept']);
    Route::get("GetAnswerCommentText/{answer}", [AnswerController::class, 'showAnswerText']);
    Route::get("commentsAnswer/{answer}/edit", [AdminController::class, 'showEditPage']);
    Route::post("commentsAnswer/{answer}/edit", [AnswerController::class, 'edit']);
    Route::get("SearchAnswer", [AnswerController::class, 'search']);
    Route::get("SearchAnswerNotAccepted", [AnswerController::class, 'search2']);

    // tickets
    Route::get("comments/tickets", [AdminController::class, 'showTicket']);
    Route::delete("tickets/{ticket}/delete", [TicketController::class, 'delete']);
    Route::get("GetTicketText/{ticket}", [TicketController::class, 'showTicketText']);
    Route::get("searchTicket", [TicketController::class, 'search']);

    // ads
    Route::get("ads/", [AdminController::class, 'showAds']);
    Route::post("ads/", [AdvertisingController::class, 'addAds']);
    Route::delete("ads/{advertising}/{reason}/delete", [AdvertisingController::class, 'delete']);
    Route::delete("ads/{advertising}/delete", [AdvertisingController::class, 'delete2']);
    Route::get("ads/{advertising}/accept", [AdvertisingController::class, 'accept']);
    Route::get("GetAdsText/{advertising}", [AdvertisingController::class, 'showText']);
    Route::get("ads/{advertising}/edit", [AdminController::class, 'showEditAds']);
    Route::put("ads/{advertising}", [AdvertisingController::class, 'EditAds']);
    Route::get("searchAds", [AdvertisingController::class, 'search']);
    Route::get("ads/{advertising}/addPrice", [AdminController::class, 'showAddPrice']);
    Route::post("ads/{advertising}/addPrice", [AdvertisingController::class, 'AddPrice']);

    // call_requests
    Route::get("call_requests", [AdminController::class, 'showCallRequests']);
    Route::get("GetCotactText/{contact}", [ContactController::class, 'showText']);
    Route::delete("contact/{contact}/delete", [ContactController::class, 'delete']);
    Route::post('contact_us_infos' , [ContactController::class , 'manageContact']);

    // profile
    Route::get("profile", [AdminController::class, 'showprofile']);
    Route::put("profile/{admin}/edit", [AdminController::class, 'editProfile']);

    // about us
    Route::get("about", [AdminController::class, 'showAbout']);
    Route::post('about/EditMain/{aboutus}', [AboutController::class, 'EditMain']);
    Route::post('about/AddItem', [AboutController::class, 'addItem']);
    Route::delete('about/{aboutus}/delete', [AboutController::class, 'delete']);
    Route::get('about/getText/{aboutus}', [AboutController::class, 'showText']);
    Route::get('about/edit/{aboutus}', [AdminController::class, 'showEditAbout']);
    Route::put("about/{aboutus}/edit", [AboutController::class, 'edit']);

    // deletedData
    Route::get('deletedData', [AdminController::class, 'showDeletedData']);
    Route::get('restore/{Model}/{id}', [AdminController::class, 'restoreData']);
});

/////////////////////////////////////////// admin Routs 



/////////////////////////////////////////// website Routs 


// auth user

Route::prefix('auth')->middleware('guest')->group(function () {

    Route::get('signup', [HomeController::class, 'showSignUp'])->name('auth.signup.show');
    Route::get('login', [HomeController::class, 'showlogin'])->name('auth.login.show');
    Route::get('forgotpass', [HomeController::class, 'showforgotPass'])->name('auth.forgetpas.show');
    Route::get('confrim_phone', [HomeController::class, 'showConfrimPhone'])->name('confrim_phone')->middleware('confrimCheck');

    Route::post("signup", [RegisterController::class, 'prepareSignUp'])->name("auth.signup.prepare");
    Route::post("login", [LoginController::class, 'prepareLogIn'])->name("auth.login.prepare");
    Route::post("forgetpas", [ForgotPasswordController::class, 'prepareLogIn_forgetpas'])->name("auth.forgetpas.prepare");
    Route::get("resendCode", [verify_phone::class, 'resendCode'])->name('auth.resendCode');
    Route::post("confirm_phone", [verify_phone::class, 'verify'])->name('auth.confirm_phone')->middleware('confrimCheck');
    

});

Route::get('logout' , [HomeController::class , 'logOut']);

Route::get("GetCitysVal/{state}", [CityController::class, 'getCitys2']);
Route::get("GetStatesVal/{country}", [StateController::class, 'getStates2']);

// auth 


Route::get("/", [HomeController::class, 'index']);
Route::get("changeLanguage/{lang}", [HomeController::class, 'changeLang']); // change language
Route::get("add_like_to_job/{job}" , [UserController::class , 'like_job']); // likeor unlike a job
Route::get("AllJobs" , [HomeController::class , 'showAllJobs'])->name('AllJobs');// all jobs page
Route::get("Filter/getStates/{country}" , [StateController::class , 'getStates3']);
Route::get("Filter/getCitys/{state}" , [CityController::class , 'getCity3']);
Route::get("Filter/getSubs/{maincategory}" , [SubcategoryController::class , 'getSubs']);
Route::get("AllJobs/Filter" , [JobController::class , 'Filters']);
Route::get("Filter/getEmpty/{type}" , [JobController::class , 'filterEmpty']);
Route::get('Job/{job}' , [HomeController::class , 'showJob']);
Route::get('Job/{job}/Rate/{rate}', [JobController::class , 'addRate']);
Route::post('Job/{job}/addComment' , [CommentController::class , 'add']);
Route::post("answers/add", [AnswerController::class, 'add']);
Route::get("Job/comments/like/{comment}/{comment_type}" , [CommentsLikeController::class , 'like']);
Route::get("Job/comments/unlike/{comment}/{comment_type}" , [CommentsLikeController::class , 'unlike']);
Route::get('searchJob/{value}' , [JobController::class , 'serachForJob']);
Route::get('JobAll/search' , [JobController::class , 'SearchInJobAll']);
Route::post('addTicket/{job}/send' , [TicketController::class , 'addTicketFromJobPage']);
Route::get('contactUs' , [HomeController::class , 'showContactUs']);
Route::post('Add_contact_us_request' , [ContactController::class , 'add']);
Route::get('About_us' , [HomeController::class , 'showAboutUs']);

// user panel

Route::prefix("panel")->middleware("auth")->group(function () {

    // manage jobs
    Route::get('JobMangement' , [PanelController::class , 'showJobMange']);
    Route::get("getStates/{country}", [StateController::class, 'getStates']);
    Route::get("getCitys/{state}", [CityController::class, 'getCitys']);
    Route::get("getSubcategorys/{maincategory}", [SubcategoryController::class, 'getSubcategorys']);
    Route::post("jobs/add", [JobController::class, 'add']);
    Route::get("JobList/{type}" , [PanelController::class , 'showJobList']);
    Route::delete("job/{job}/delete", [JobController::class, 'delete']);
    Route::get("job/addGallery/{job}/show/{type}" , [PanelController::class , 'showGallery']);
    Route::post("job/{job}/add_pic", [JobController::class, 'add_pic']);
    Route::delete("jobImg/{jobgallery}/delete", [JobController::class, 'delete_pic']);
    Route::get("job/{job}/edit_job" , [PanelController::class , 'showEditJob']);
    Route::put("job/{job}/edit", [JobController::class, 'edit']);

    // favorate list
    Route::get("Job/favorateList/show" , [PanelController::class , 'showFavList']);
    Route::get('Job/{job}/deleteList' , [UserController::class , 'deleteFavList']);

    // comments
    Route::get("User/comments" , [PanelController::class , 'showCommentsList']);
    Route::get("editComment/{comment}/{type}" , [PanelController::class , 'showEditCmt']);
    Route::post("editComment/{comment}/{type}" , [CommentController::class , 'editCmtUser']);
    Route::delete('Cmt/{id}/{type}/delete' , [CommentController::class , 'deleteCmtUser']);
    Route::get('comment/{cmt_id}/{type}/request' , [CommentController::class , 'request_again']);


    // tickets
    Route::get('massenger' , [PanelController::class , 'showMassanger']);
    // Route::get('getJobsList' , [TicketController::class , 'getJobsList']);
    // Route::get('getUserList' , [TicketController::class , 'getUserList']);
    Route::get('getJobsList/{searchVal}' , [TicketController::class , 'getJobsList']);
    Route::get('getUserList/{searchVal}' , [TicketController::class , 'getUserList']);
    Route::get('setDatas/{sender_id}/{sender_type}/{receiver_id}/{receiver_type}' , [TicketController::class , 'setDatas']);
    Route::post('massanger/addMsg' , [TicketController::class , 'addMsg']);
    Route::get('getAllMsgs' , [TicketController::class , 'getAllMsgs']);
    Route::get('editMsg/{ticket}' , [TicketController::class , 'editMsg']);
    Route::post('msg/{ticket}/edit' , [TicketController::class , 'EditFormMsg']);
    Route::get('deleteMsg/{ticket}' , [TicketController::class , 'deleteMsg']);
    Route::get('getGetterInfo' , [TicketController::class , 'getGetterInfo']);
    Route::delete('deleteAllChatBtn' , [TicketController::class , 'deleteAllChatBtn']);


    // profile
    Route::get('profile' , [PanelController::class , 'showProfile']);
    Route::post('profile/edit' , [UserController::class , 'editProfile']);
    Route::get('confrim_phone' , [PanelController::class , 'showConfrim_phone'])->name('panel.confrim_phone');
    Route::get('resendCode' , [verify_phone::class , 'resendCode'])->name('panel.resendCode');
    Route::post('confrim_phone' , [verify_phone::class , 'verify'])->name('panel.confirm_phone');

});

// user panel

/////////////////////////////////////////// website Routs 

