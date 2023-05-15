<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TetsController;
//ADMIN
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GuestController;
//CMS
use App\Http\Controllers\Cms\CmsLogsController;
use App\Http\Controllers\Cms\CmsMenusAccessController;
use App\Http\Controllers\Cms\CmsMenusController;
use App\Http\Controllers\Cms\CmsModulesController;
use App\Http\Controllers\Cms\CmsSettingsController;
use App\Http\Controllers\Cms\RoleController;
use App\Http\Controllers\Cms\CmsRoleAccessController;
use App\Http\Controllers\Cms\UsersController;
use App\Http\Controllers\Cms\CmsMenusDetailController;
use App\Http\Controllers\Cms\CmsEmailsController;
use App\Http\Controllers\Cms\CmsDocumentController;
use App\Http\Controllers\Cms\CmsManagementUsersController;

// MANAGEMENT CLASS
use App\Http\Controllers\Management\MemberController;
use App\Http\Controllers\Management\MemberStatusController;
use App\Http\Controllers\Management\PointClaimController;
use App\Http\Controllers\Management\PointReedemController;

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
Route::middleware(['web'])->group(function () {

    Route::group(['middleware' => ['auth']], function () {

        Route::get("account",[CmsManagementUsersController::class,"account"]);
        Route::get("password",[CmsManagementUsersController::class,"password"]);
        Route::post("account/update",[CmsManagementUsersController::class,"account_update"]);
        Route::post("password/update",[CmsManagementUsersController::class,"password_update"]);
    });

});


//ROUTE UNTUK ADMIN DAN SUPER ADMIN DEFAULT

Route::middleware(['web'])->group(function () {

    Route::group(['middleware' => ['auth']], function () {

        Route::get('dashboard',[DashboardController::class, 'index'])->name('dashboard');

        Route::get('test',[TetsController::class, 'index']);

        Route::post('logout',[AuthController::class, 'logout']);   

        Route::get('member',[MemberController::class, 'index']);
        Route::get('member/create',[MemberController::class, 'create']);
        Route::get('member/show/{id}',[MemberController::class, 'show']);
        Route::get('member/edit/{id}',[MemberController::class, 'edit']);
        Route::get('member/destroy/{id}',[MemberController::class, 'destroy']);
        Route::post('member/store',[MemberController::class, 'store']);
        Route::post('member/update',[MemberController::class, 'update']);

        Route::get('status',[MemberStatusController::class, 'index']);
        Route::get('status/create',[MemberStatusController::class, 'create']);
        Route::get('status/show/{id}',[MemberStatusController::class, 'show']);
        Route::get('status/edit/{id}',[MemberStatusController::class, 'edit']);
        Route::get('status/destroy/{id}',[MemberStatusController::class, 'destroy']);
        Route::post('status/store',[MemberStatusController::class, 'store']);
        Route::post('status/update',[MemberStatusController::class, 'update']);

        Route::get('point_claim',[PointClaimController::class, 'index']);
        Route::get('point_claim/create',[PointClaimController::class, 'create']);
        Route::get('point_claim/show/{id}',[PointClaimController::class, 'show']);
        Route::get('point_claim/edit/{id}',[PointClaimController::class, 'edit']);
        Route::get('point_claim/destroy/{id}',[PointClaimController::class, 'destroy']);
        Route::post('point_claim/store',[PointClaimController::class, 'store']);
        Route::post('point_claim/update',[PointClaimController::class, 'update']);

        Route::get('point_reedem',[PointReedemController::class, 'index']);
        Route::get('point_reedem/create',[PointReedemController::class, 'create']);
        Route::get('point_reedem/show/{id}',[PointReedemController::class, 'show']);
        Route::get('point_reedem/edit/{id}',[PointReedemController::class, 'edit']);
        Route::get('point_reedem/destroy/{id}',[PointReedemController::class, 'destroy']);
        Route::post('point_reedem/store',[PointReedemController::class, 'store']);
        Route::post('point_reedem/update',[PointReedemController::class, 'update']);

        Route::group(['prefix' => 'admin','middleware' => ['admin']], function () {

            Route::get('role',[RoleController::class, 'index'])->name('role');
            Route::get('role/create',[RoleController::class, 'create'])->name('role-create');
            Route::get('role/show/{id}',[RoleController::class, 'show'])->name('role-show');
            Route::get('role/edit/{id}',[RoleController::class, 'edit'])->name('role-edit');
            Route::get('role/destroy/{id}',[RoleController::class, 'destroy'])->name('role-destroy');
            Route::post('role/store',[RoleController::class, 'store'])->name('role-store');
            Route::post('role/update',[RoleController::class, 'update'])->name('role-update');
            Route::post('role/action/{slug}/{id}',[RoleController::class, 'action']);


            Route::get('users',[UsersController::class, 'index'])->name('users');
            Route::get('users/create',[UsersController::class, 'create'])->name('users-create');
            Route::get('users/show/{id}',[UsersController::class, 'show'])->name('users-show');
            Route::get('users/edit/{id}',[UsersController::class, 'edit'])->name('users-edit');
            Route::get('users/destroy/{id}',[UsersController::class, 'destroy'])->name('users-destroy');
            Route::post('users/store',[UsersController::class, 'store'])->name('users-store');
            Route::post('users/update',[UsersController::class, 'update'])->name('users-update');
            Route::post('users/action/{slug}/{id}',[UsersController::class, 'action']);


            Route::get('logs',[CmsLogsController::class, 'index'])->name('logs');

            Route::get('settings',[CmsSettingsController::class, 'index'])->name('settings');
            Route::get('settings/create',[CmsSettingsController::class, 'create'])->name('settings-create');
            Route::get('settings/show/{id}',[CmsSettingsController::class, 'show'])->name('settings-show');
            Route::get('settings/edit/{id}',[CmsSettingsController::class, 'edit'])->name('settings-edit');
            Route::get('settings/destroy/{id}',[CmsSettingsController::class, 'destroy'])->name('settings-destroy');
            Route::post('settings/store',[CmsSettingsController::class, 'store'])->name('settings-store');
            Route::post('settings/update',[CmsSettingsController::class, 'update'])->name('settings-update');
            Route::post('settings/action/{slug}/{id}',[CmsSettingsController::class, 'action']);

            Route::get('role_access/{role_id}', [CmsRoleAccessController::class, 'index']);
            Route::post('role_access/store', [CmsRoleAccessController::class, 'store']);

            Route::group(['middleware' => ['superadmin']], function () {

                    Route::get('modules',[CmsModulesController::class, 'index'])->name('modules');
                    Route::get('modules/create',[CmsModulesController::class, 'create'])->name('modules-create');
                    Route::get('modules/show/{id}',[CmsModulesController::class, 'show'])->name('modules-show');
                    Route::get('modules/edit/{id}',[CmsModulesController::class, 'edit'])->name('modules-edit');
                    Route::get('modules/destroy/{id}',[CmsModulesController::class, 'destroy'])->name('modules-destroy');
                    Route::post('modules/store',[CmsModulesController::class, 'store'])->name('modules-store');
                    Route::post('modules/update',[CmsModulesController::class, 'update'])->name('modules-update');
                    Route::post('modules/action/{slug}/{id}',[CmsModulesController::class, 'action']);
                    Route::get('modules/generate/{id}',[CmsModulesController::class, 'generate'])->name('modules-generate');

                    Route::get('menus',[CmsMenusController::class, 'index'])->name('menus');
                    Route::get('menus/create',[CmsMenusController::class, 'create'])->name('menus-create');
                    Route::get('menus/show/{id}',[CmsMenusController::class, 'show'])->name('menus-show');
                    Route::get('menus/edit/{id}',[CmsMenusController::class, 'edit'])->name('menus-edit');
                    Route::get('menus/destroy/{id}',[CmsMenusController::class, 'destroy'])->name('menus-destroy');
                    Route::post('menus/store',[CmsMenusController::class, 'store'])->name('menus-store');
                    Route::post('menus/update',[CmsMenusController::class, 'update'])->name('menus-update');
                    Route::get('menus/action/{id}',[CmsMenusController::class, 'action']);
                    Route::get('menus/status/{id}/{status}',[CmsMenusController::class, 'status']);

                    Route::get('menu_access/{cms_menus_id}',[CmsMenusAccessController::class, 'index']);
                    Route::get('menu_access/destroy/{id}',[CmsMenusAccessController::class, 'destroy']);
                    Route::post('menu_access/store',[CmsMenusAccessController::class, 'store']);

                    Route::get('menu_detail/{cms_menus_id}', [CmsMenusDetailController::class, 'index']);
                    Route::get('menu_detail/destroy/{id}', [CmsMenusDetailController::class, 'destroy']);
                    Route::post('menu_detail/store', [CmsMenusDetailController::class, 'store']);
                    Route::post('menu_detail/update', [CmsMenusDetailController::class, 'update']);


                    Route::get('emails',[CmsEmailsController::class, 'index'])->name('emails');
                    Route::get('emails/create',[CmsEmailsController::class, 'create'])->name('emails-create');
                    Route::get('emails/show/{id}',[CmsEmailsController::class, 'show'])->name('emails-show');
                    Route::get('emails/edit/{id}',[CmsEmailsController::class, 'edit'])->name('emails-edit');
                    Route::get('emails/destroy/{id}',[CmsEmailsController::class, 'destroy'])->name('emails-destroy');
                    Route::post('emails/store',[CmsEmailsController::class, 'store'])->name('emails-store');
                    Route::post('emails/update',[CmsEmailsController::class, 'update'])->name('emails-update');

                    Route::get('document',[CmsDocumentController::class, 'index'])->name('document');
            });

        });

    });

    

    Route::group(['middleware' => ['guest']], function () {
        Route::get('login',[GuestController::class, 'login'])->name('login');
        Route::get('register',[GuestController::class, 'register'])->name('register');
        Route::get('forget',[GuestController::class, 'forget'])->name('forget');
        //confirmasi email
        Route::get('verifikasi/{email}',[AuthController::class, 'validasiEmail']);

        Route::get('verifikasi',[GuestController::class, 'verifikasi'])->name('verifikasi');
    });

    Route::group(['middleware' => ['guest','throttle:6,1']], function () {

        Route::post('sign-in',[AuthController::class, 'login']);
        Route::post('sign-up',[AuthController::class, 'register']);
        Route::post('forget-password',[AuthController::class, 'forget_password']);


    });

    Route::get('/',[GuestController::class, 'welcome'])->name('welcome');


});