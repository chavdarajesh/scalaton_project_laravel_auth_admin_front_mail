<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Admin\FaqsController as AdminFaqsController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Front\AuthController;
use App\Http\Controllers\Front\ContactController;
use App\Http\Controllers\Front\FrontPagesController;
use App\Http\Controllers\Front\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/admin/login', [DashboardController::class, 'adminloginget'])->name('admin.login');
Route::post('admin/login', [DashboardController::class, 'adminloginpost'])->name('admin.login.post');

Route::get('/admin/forgotpassword', [AdminProfileController::class, 'adminforgotpasswordget'])->name('admin.forgotpassword');
Route::post('admin/forgotpassword', [AdminProfileController::class, 'adminforgotpasswordpost'])->name('admin.forgotpassword.post');

Route::get('/admin/reset-password/{token}', [AdminProfileController::class, 'showResetPasswordFormget'])->name('admin.reset.password.get');
Route::post('admin/reset-password', [AdminProfileController::class, 'submitResetPasswordFormpost'])->name('admin.reset.password.post');

Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => 'is_admin'], function () {
    Route::get('/', function () {
        // return view('welcome');
        return redirect()->route('admin.dashboard');
    });
    Route::get('/dashboard', [DashboardController::class, 'admindashboard'])->name('admin.dashboard');
    Route::post('/logout', [DashboardController::class, 'adminlogout'])->name('admin.logout');

    Route::get('/profilechangepassword', [AdminProfileController::class, 'adminprofileprofilechangepassword'])->name('admin.profile.profilechangepassword');

    Route::get('/profilesetting', [AdminProfileController::class, 'adminprofilesetting'])->name('admin.profile.setting');
    Route::post('/profilesetting', [AdminProfileController::class, 'adminprofilesettingpost'])->name('admin.profile.setting.post');
    Route::post('/profilesetting/changepassword', [AdminProfileController::class, 'adminprofilsettingchangepasswordepost'])->name('admin.profile.setting.changepassword.post');

    Route::get('/users', [UserController::class, 'get_users'])->name('admin.get.users');
    Route::delete('/user/delete/{id}', [UserController::class, 'user_delete'])->name('admin.delete.user');
    Route::get('/user/edit/{id}', [UserController::class, 'user_edit'])->name('admin.edit.user');
    Route::get('/user/view/{id}', [UserController::class, 'user_view'])->name('admin.view.user');
    Route::put('/user/update', [UserController::class, 'user_update'])->name('admin.update.user');
    Route::post('/user_status/update', [UserController::class, 'user_status_update'])->name('admin.update.user.status');
    Route::post('/user_is_verified/update', [UserController::class, 'user_is_verified_update'])->name('admin.update.user.is_verified');


    Route::get('/contact_msg', [AdminContactController::class, 'get_contact_msg'])->name('admin.get.contact_msg');
    Route::delete('/contact_msg/delete/{id}', [AdminContactController::class, 'contact_msg_delete'])->name('admin.delete.contact_msg');
    Route::get('/contcat_msg/view/{id}', [AdminContactController::class, 'contcat_msg_view'])->name('admin.view.contcat_msg');


    Route::get('/contact_settings', [AdminContactController::class, 'get_contact_settings'])->name('admin.get.contact_settings');
    Route::post('/contact_settings', [AdminContactController::class, 'post_contact_settings'])->name('admin.post.contact_settings');

    Route::get('/faqs', [AdminFaqsController::class, 'get_faqs'])->name('admin.get.faqs');
    Route::get('/faqs/add', [AdminFaqsController::class, 'get_faqs_add'])->name('admin.add.faq');
    Route::post('/faqs', [AdminFaqsController::class, 'post_faqs'])->name('admin.post.faq');
    Route::delete('/faqs/delete/{id}', [AdminFaqsController::class, 'faqs_delete'])->name('admin.delete.faq');
    Route::get('/faqs/edit/{id}', [AdminFaqsController::class, 'faqs_edit'])->name('admin.edit.faq');
    Route::get('/faqs/view/{id}', [AdminFaqsController::class, 'faqs_view'])->name('admin.view.faq');
    Route::put('/faqs/update', [AdminFaqsController::class, 'faqs_update'])->name('admin.update.faq');
    Route::post('/faq_status/update', [AdminFaqsController::class, 'faq_status_update'])->name('admin.update.faq.status');

    Route::get('/user_referrals/{id}', [UserController::class, 'get_user_referrals'])->name('admin.get.user_referrals');
});





Route::group(['namespace' => 'Front'], function () {
    Route::get('/', [FrontPagesController::class, 'homepage'])->name('front.homepage');
    Route::get('/about', [FrontPagesController::class, 'aboutpage'])->name('front.aboutpage');
    Route::get('/services', [FrontPagesController::class, 'servicespage'])->name('front.servicespage');
    Route::get('/privacy_policy', [FrontPagesController::class, 'privacy_policypage'])->name('front.privacy_policypage');
    Route::get('/term_and_condition', [FrontPagesController::class, 'term_and_conditionpage'])->name('front.term_and_conditionpage');


    Route::get('/contact', [ContactController::class, 'contactpage'])->name('front.contactpage');
    Route::post('/contact', [ContactController::class, 'postcontact'])->name('front.post.contact');

    Route::get('/login', [AuthController::class, 'login'])->name('front.login');
    Route::get('/register', [AuthController::class, 'register'])->name('front.register');
    Route::get('/forgotpassword', [AuthController::class, 'forgotpasswordget'])->name('front.forgotpassword');
    Route::get('/reset-password/{token}', [AuthController::class, 'showResetPasswordFormget'])->name('front.reset.password.get');
    Route::get('/otp_verification/{id}', [AuthController::class, 'showotp_verificationFormget'])->name('front.otp_verification.get');


    Route::post('/login', [AuthController::class, 'postlogin'])->name('front.post.login');
    Route::post('/register', [AuthController::class, 'postregister'])->name('front.post.register');
    Route::post('/otp_verification', [AuthController::class, 'postotp_verification'])->name('front.post.otp_verification');
    Route::post('/forgotpassword', [AuthController::class, 'postforgotpassword'])->name('front.post.forgotpassword');
    Route::post('/reset-password', [AuthController::class, 'submitResetPasswordFormpost'])->name('front.reset.password.post');

    Route::get('/faqs', [FrontPagesController::class, 'faqspage'])->name('front.faqspage');

    Route::group(['middleware' => 'is_auth'], function () {

        Route::post('/logout', [AuthController::class, 'logout'])->name('front.post.logout');

        Route::get('/profile', [ProfileController::class, 'profilepage'])->name('front.profilepage');
        Route::post('/profile', [ProfileController::class, 'postprofilepage'])->name('front.post.profilepage');
        Route::post('/profile/changepassword', [ProfileController::class, 'postprofilechangepassword'])->name('front.post.profile.changepassword');
    });

});
