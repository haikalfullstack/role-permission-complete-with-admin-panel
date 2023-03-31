<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

use App\Http\Controllers\VendorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Backend\RoleController;

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

Route::get('/', function () {
    return view('frontend.index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


// Admin Dashboard
Route::middleware(['auth', 'role:admin'])->group(function(){
    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/logout', [AdminController::class, 'AdminDestroy'])->name('admin.logout');
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
    Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');
    Route::post('/admin/update/password', [AdminController::class, 'AdminUpdatePassword'])->name('update.password');


    // Permission All Route 
    Route::controller(RoleController::class)->group(function(){

    Route::get('/all/permission' , 'AllPermission')->name('all.permission');
    Route::get('/add/permission' , 'AddPermission')->name('add.permission');
    Route::post('/store/permission' , 'StorePermission')->name('store.permission');
    Route::get('/edit/permission/{id}' , 'EditPermission')->name('edit.permission');
   
    Route::post('/update/permission' , 'UpdatePermission')->name('update.permission');
   
     Route::get('/delete/permission/{id}' , 'DeletePermission')->name('delete.permission');
    
   });

    // Roles All Route 
Route::controller(RoleController::class)->group(function(){

    Route::get('/all/roles' , 'AllRoles')->name('all.roles');
    Route::get('/add/roles' , 'AddRoles')->name('add.roles');
    Route::post('/store/roles' , 'StoreRoles')->name('store.roles');
    Route::get('/edit/roles/{id}' , 'EditRoles')->name('edit.roles');
   
    Route::post('/update/roles' , 'UpdateRoles')->name('update.roles');
   
    Route::get('/delete/roles/{id}' , 'DeleteRoles')->name('delete.roles');
   
    // add role permission 
   
    Route::get('/add/roles/permission' , 'AddRolesPermission')->name('add.roles.permission');
   
    Route::post('/role/permission/store' , 'RolePermissionStore')->name('role.permission.store');
    
     Route::get('/all/roles/permission' , 'AllRolesPermission')->name('all.roles.permission');
   
     Route::get('/admin/edit/roles/{id}' , 'AdminRolesEdit')->name('admin.edit.roles');
   
     Route::post('/admin/roles/update/{id}' , 'AdminRolesUpdate')->name('admin.roles.update');
   
    Route::get('/admin/delete/roles/{id}' , 'AdminRolesDelete')->name('admin.delete.roles');
   
   });


//    Admin User All Route
Route::controller(AdminController::class)->group(function(){

    Route::get('/all/admin' , 'AllAdmin')->name('all.admin');
    Route::get('/add/admin' , 'AddAdmin')->name('add.admin');
    Route::post('/admin/user/store' , 'AdminUserStore')->name('admin.user.store');
    Route::get('/edit/admin/role/{id}' , 'EditAdminRole')->name('edit.admin.role');
    Route::post('/admin/user/update/{id}' , 'AdminUserUpdate')->name('admin.user.update');
    Route::get('/delete/admin/role/{id}' , 'DeleteAdminRole')->name('delete.admin.role');
  
   
   });


});

// Vendor Dashboard
Route::middleware(['auth', 'role:vendor'])->group(function(){
    Route::get('vendor/dashboard', [VendorController::class, 'VendorDashboard'])->name('vendor.dashboard');
    Route::get('/vendor/logout', [VendorController::class, 'VendorDestroy'])->name('vendor.logout');
    Route::get('/vendor/profile', [VendorController::class, 'VendorProfile'])->name('vendor.profile');
    Route::post('/vendor/profile/store', [VendorController::class, 'VendorProfileStore'])->name('vendor.profile.store');
    Route::get('/vendor/change/password', [VendorController::class, 'VendorChangePassword'])->name('vendor.change.password');
    Route::post('/vendor/update/password', [VendorController::class, 'VendorUpdatePassword'])->name('vendor.update.password');
   
});

Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');
Route::get('/vendor/login', [VendorController::class, 'VendorLogin'])->name('vendor.login');
