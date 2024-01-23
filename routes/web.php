<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Admin\FaqsController as AdminFaqsController;
use App\Http\Controllers\Admin\BlogController as AdminBlogController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;

use App\Http\Controllers\Front\AuthController as FrontAuthController;
use App\Http\Controllers\Front\ContactController as FrontContactController;
use App\Http\Controllers\Front\PagesController as FrontPagesController;
use App\Http\Controllers\Front\ProfileController as FrontProfileController;

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

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Admin Auth Route start
Route::get('/admin/login/get', [AdminAuthController::class, 'loginGet'])->name('admin.login.get');
Route::post('/admin/login/save', [AdminAuthController::class, 'loginSave'])->name('admin.login.save');

Route::get('/admin/password/forgot/get', [AdminAuthController::class, 'passwordForgotGet'])->name('admin.password.forgot.get');
Route::post('admin/password/forgot/save', [AdminAuthController::class, 'passwordForgotSave'])->name('admin.password.forgot.save');

Route::get('/admin/password/reset/{token}', [AdminAuthController::class, 'passwordResetGet'])->name('admin.password.reset.get');
Route::post('/admin/password/reset/save', [AdminAuthController::class, 'passwordResetSave'])->name('admin.password.reset.save');
// Admin Auth Route end

// Admin route start
Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => 'is_admin'], function () {

    // dashboard route start
    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    });
    Route::get('/dashboard', [AdminDashboardController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
    // dashboard route end

    // profile setting Modlue start
    Route::get('/profile/setting/password', [AdminProfileController::class, 'profileSettingsPasswordIndex'])->name('admin.profile.settings.password.index');
    Route::post('/profile/setting/password/save', [AdminProfileController::class, 'profileSettingsPasswordSave'])->name('admin.profile.settings.password.save');

    Route::get('/profile/setting', [AdminProfileController::class, 'profileSettingIndex'])->name('admin.profile.setting.index');
    Route::post('/profil/esetting/save', [AdminProfileController::class, 'profileSettingSave'])->name('admin.profile.setting.save');
    // profile setting Modlue end

    // contact us msg Modlue start
    Route::get('/contact/messages', [AdminContactController::class, 'index'])->name('admin.contact.messages.index');
    Route::get('/contact/messages/view/{id}', [AdminContactController::class, 'view'])->name('admin.contact.messages.view');
    Route::post('/contact/messages/delete/{id}', [AdminContactController::class, 'delete'])->name('admin.contact.messages.delete');
    // contact us msg Modlue end

    // contact settings Modlue start
    Route::get('/contact/settings', [AdminContactController::class, 'indexContactSettings'])->name('admin.contact.settings.index');
    Route::post('/contact/settings/save', [AdminContactController::class, 'saveContactSettings'])->name('admin.contact.settings.save');
    // contact settings Modlue end

    // User Modlue start
    Route::any('/users', [AdminUserController::class, 'index'])->name('admin.users.index');
    Route::get('/usesr/create', [AdminUserController::class, 'create'])->name('admin.users.create');
    Route::post('/users/save', [AdminUserController::class, 'save'])->name('admin.users.save');
    Route::get('/users/view/{id}', [AdminUserController::class, 'view'])->name('admin.users.view');
    Route::get('/users/edit/{id}', [AdminUserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/users/update', [AdminUserController::class, 'update'])->name('admin.users.update');
    Route::post('/users/status/toggle', [AdminUserController::class, 'statusToggle'])->name('admin.users.status.toggle');
    Route::post('/users/verify/toggle', [AdminUserController::class, 'verifyToggle'])->name('admin.users.verify.toggle');
    Route::post('/users/delete/{id}', [AdminUserController::class, 'delete'])->name('admin.users.delete');
    Route::get('/users/referrals/{id}', [AdminUserController::class, 'userReferrals'])->name('admin.users.referrals');
    // User Modlue end

    // Blogs Modlue start
    Route::any('/blogs', [AdminBlogController::class, 'index'])->name('admin.blogs.index');
    Route::get('/blogs/create', [AdminBlogController::class, 'create'])->name('admin.blogs.create');
    Route::post('/blogs/save', [AdminBlogController::class, 'save'])->name('admin.blogs.save');
    Route::get('/blogs/view/{id}', [AdminBlogController::class, 'view'])->name('admin.blogs.view');
    Route::get('/blogs/edit/{id}', [AdminBlogController::class, 'edit'])->name('admin.blogs.edit');
    Route::put('/blogs/update', [AdminBlogController::class, 'update'])->name('admin.blogs.update');
    Route::post('/blogs/status/toggle', [AdminBlogController::class, 'statusToggle'])->name('admin.blogs.status.toggle');
    Route::post('/blogs/delete/{id}', [AdminBlogController::class, 'delete'])->name('admin.blogs.delete');
    // Blogs Modlue end

    // Faqs Modlue start
    Route::any('/faqs', [AdminFaqsController::class, 'index'])->name('admin.faqs.index');
    Route::get('/faqs/create', [AdminFaqsController::class, 'create'])->name('admin.faqs.create');
    Route::post('/faqs/save', [AdminFaqsController::class, 'save'])->name('admin.faqs.save');
    Route::get('/faqs/view/{id}', [AdminFaqsController::class, 'view'])->name('admin.faqs.view');
    Route::get('/faqs/edit/{id}', [AdminFaqsController::class, 'edit'])->name('admin.faqs.edit');
    Route::put('/faqs/update', [AdminFaqsController::class, 'update'])->name('admin.faqs.update');
    Route::post('/faqs/status/toggle', [AdminFaqsController::class, 'statusToggle'])->name('admin.faqs.status.toggle');
    Route::post('/faqs/delete/{id}', [AdminFaqsController::class, 'delete'])->name('admin.faqs.delete');
    // Faqs Modlue end
});
// Admin route end

// front route start
Route::group(['namespace' => 'Front'], function () {

    Route::get('/', [FrontPagesController::class, 'homepage'])->name('front.home');
    Route::get('/about', [FrontPagesController::class, 'about'])->name('front.about');
    Route::get('/services', [FrontPagesController::class, 'services'])->name('front.services');
    Route::get('/blogs', [FrontPagesController::class, 'blog'])->name('front.blog');
    Route::get('/blog-details/{id}', [FrontPagesController::class, 'blog_details'])->name('front.blog_details');
    Route::get('/privacy_policy', [FrontPagesController::class, 'privacy_policy'])->name('front.privacy_policy');
    Route::get('/term_and_condition', [FrontPagesController::class, 'term_and_condition'])->name('front.term_and_condition');
    Route::get('/faqs', [FrontPagesController::class, 'faqs'])->name('front.faqs');

    Route::get('/contact', [FrontContactController::class, 'contact'])->name('front.contact');
    Route::post('/contact/message/save', [FrontContactController::class, 'contactMessageSave'])->name('front.contact.message.save');

    Route::get('/login', [FrontAuthController::class, 'login'])->name('front.login');
    Route::get('/register', [FrontAuthController::class, 'register'])->name('front.register');
    Route::get('/password/forgot', [FrontAuthController::class, 'passwordForgotGet'])->name('front.password.forgot.get');
    Route::get('/password/reset/{token}', [FrontAuthController::class, 'passwordResetGet'])->name('front.reset.password.get');
    Route::get('/otp/verification/{id}', [FrontAuthController::class, 'otpVerificationGet'])->name('front.otp.verification.get');


    Route::post('/login', [FrontAuthController::class, 'postlogin'])->name('front.post.login');
    Route::post('/register', [FrontAuthController::class, 'postregister'])->name('front.post.register');
    Route::post('/otp/verification', [FrontAuthController::class, 'postotp_verification'])->name('front.post.otp_verification');
    Route::post('/password/forgot', [FrontAuthController::class, 'postforgotpassword'])->name('front.post.forgotpassword');
    Route::post('/password/reset', [FrontAuthController::class, 'passwordResetSave'])->name('front.reset.password.post');


    Route::group(['middleware' => 'is_auth'], function () {
        Route::post('/logout', [FrontAuthController::class, 'logout'])->name('front.post.logout');
        Route::get('/profile/setting', [FrontProfileController::class, 'profilepage'])->name('front.profilepage');
        Route::post('/profile/setting/save', [FrontProfileController::class, 'postprofilepage'])->name('front.post.profilepage');
        Route::post('/profile/changepassword/save', [FrontProfileController::class, 'postprofilechangepassword'])->name('front.post.profile.changepassword');
    });
});
// front route end
