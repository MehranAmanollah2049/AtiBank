<?php

use App\Http\Controllers\api\AboutUsController;
use App\Http\Controllers\api\CategoryController;
use App\Http\Controllers\api\CityController;
use App\Http\Controllers\api\CommentController;
use App\Http\Controllers\api\ContactUsController;
use App\Http\Controllers\api\CountryController;
use App\Http\Controllers\api\GalleryJobController;
use App\Http\Controllers\api\JobController;
use App\Http\Controllers\api\StateController;
use App\Http\Controllers\api\TicketController;
use App\Http\Controllers\api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('atibank/api')->group(function () {


    // country
    Route::get('countrys' , [CountryController::class , 'getList']);

    // state
    Route::get('states/{country}' , [StateController::class , 'getList']);

    // city
    Route::get('citys/{state}' , [CityController::class , 'getList']);

    // main category
    Route::get('Category' , [CategoryController::class , 'mainCategory']);
    Route::get('subCategory/{mainCategory}' , [CategoryController::class , 'subCategory']);

    // jobs
    Route::get('Jobs/{job}', [JobController::class, 'job']);
    Route::get('Jobs/{subcategory}/{city}/{isAuth}', [JobController::class, 'getAllJobs']);
    Route::get('Jobs/{subcategory}/{city}/mostViews/{isAuth}', [JobController::class, 'mostViewJobs']);
    Route::get('Jobs/{subcategory}/{city}/mostPopulars/{isAuth}', [JobController::class, 'mostPopularJobs']);
    Route::get('Jobs/{job}/{ip}', [JobController::class, 'addView']);  
    Route::get('Jobs/{job}/{user}/{rate}', [JobController::class, 'addRate']);
    Route::post('Jobs/add', [JobController::class, 'add']);
    Route::post('Jobs/{job}/edit', [JobController::class, 'edit']);
    Route::get('Job/{job}/{user}/delete', [JobController::class, 'delete']);

    Route::get('Jobs/{width}/{height}/{subcategory}' , [JobController::class , 'findLoc']);

    // user
    Route::get('User/{user}/FavList', [UserController::class, 'FavList']);
    Route::get('User/{user}/{job}/addFavList', [UserController::class, 'addFavList']);
    Route::post('User/add' , [UserController::class , 'signup']);
    Route::post('User/verify_phone/{phoneNumber}' , [UserController::class , 'verify_phone']);
    Route::post('User/logIn' , [UserController::class , 'login']);
    Route::get('User/{user}/JobList' , [UserController::class , 'JobList']);
    Route::put('User/{user}/edit_texts' , [UserController::class , 'editProfile_text']);
    Route::put('User/{user}/edit_phone' , [UserController::class , 'editProfile_phone']);
    Route::put('User/{user}/verify_phone' , [UserController::class , 'update_phone']);
    Route::put('User/{user}/edit_location' , [UserController::class , 'edit_location']);
    Route::put('User/{phoneNumber}/changePas' , [UserController::class , 'changePas']);

    // comment
    Route::get('Comments/{job}/{isAuth}', [CommentController::class, 'getAll']);
    Route::post('Comments/{job}/{user}', [CommentController::class, 'add']);
    Route::get("Comments/like/{user}/{comment}", [CommentController::class, 'like']);
    Route::get("Comments/unlike/{user}/{comment}", [CommentController::class, 'unlike']);
    Route::get('Comments/{comment}/delete', [CommentController::class, 'delete']);
    Route::put('Comments/{comment}/edit', [CommentController::class, 'editCmtUser']);

    // gallery
    Route::post('Job/Gallery/{job}/add' , [GalleryJobController::class , 'add_pic']);
    Route::get('Job/Gallery/{job}/get/without_trash' , [GalleryJobController::class , 'getAll_withoutTrash']);
    Route::get('Job/Gallery/{job}/get/withTrash' , [GalleryJobController::class , 'getAll_withTrash']);
    Route::post('Job/Gallery/{jobgallery}/delete' , [GalleryJobController::class , 'delete_pic']);

    // contact us
    Route::get('contactUs' , [ContactUsController::class , 'getAll']);

    // contact us
    Route::get('aboutUs' , [AboutUsController::class , 'getAll']);

    // sponser
    Route::get('Sponser/{maincategory}' , [JobController::class , 'getSponser']);


    // tickets
    Route::post('getJobList' , [TicketController::class , 'getJobList']);
    Route::post('getUserList' , [TicketController::class , 'getUserList']);
    Route::post('getMessages' , [TicketController::class , 'getAllMsgs'])->name('api.getMsgs');
    Route::post('addMsg' , [TicketController::class , 'addMsg']);
    Route::delete('deleteMsg/{ticket}' , [TicketController::class , 'deleteMsg']);
    Route::put('editMsg/{ticket}' , [TicketController::class , 'editMsg']);
    Route::delete('deleteAllChat' , [TicketController::class , 'deleteAllChat']);

    // <----- upload ------>
    Route::post('uploadImg' , [GalleryJobController::class , 'uploadImg']);
});
