<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Backend\TeamController;
use App\Http\Controllers\Backend\Book;
use App\Http\Controllers\Backend\RoomTypeController;
use App\Http\Controllers\Backend\RoomController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [UserController::class, 'Index']);

Route::get('/dashboard', function () {
    return view('frontend.dashboard.user_dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // New Routes down here (NB: I can delete above ones)
    Route::get('/profile', [UserController::class, 'UserProfile'])->name('user.profile');
    Route::post('/profile/store', [UserController::class, 'UserStore'])->name('profile.store');
    Route::get('/user/logout', [UserController::class, 'UserLogout'])->name('user.logout');
    Route::get('/user/change/password', [UserController::class, 'UserChangePassword'])->name('user.change.password');
    Route::post('/user/change/password', [UserController::class, 'ChangePasswordStore'])->name('password.change.store');
});

require __DIR__ . '/auth.php';

//Admin Group Middleware
Route::middleware(['auth', 'roles:admin'])->group(function () {

    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
    Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');
    Route::post('/admin/password/update', [AdminController::class, 'AdminPasswordUpdate'])->name('admin.password.update');
});// End Admin Group Middleware 

Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');


//Admin Group Middleware
Route::middleware(['auth', 'roles:admin'])->group(function () {
    // Team All Router team.store
    Route::controller(TeamController::class)->group(function () {
        Route::get('/all/team', action: 'AllTeam')->name('all.team');
        Route::get('/add/team', action: 'AddTeam')->name('add.team');
        Route::post('/team/store', action: 'StoreTeam')->name('team.store');
        Route::get('/edit/team/{id}', action: 'EditTeam')->name('edit.team');
        Route::post('/team/update', action: 'UpdateTeam')->name('team.update');    
        Route::get('/team/delete/{id}', action: 'DeleteTeam')->name('delete.team');  
    });


    //Book Area Group Middleware
    Route::middleware(['auth', 'roles:admin'])->group(function () {
    // Book Area All Router team.store
     Route::controller(Book::class)->group(function () {
         Route::get('/update/bookarea', action: 'UpdateBookarea')->name('update.book.area');
         Route::post('/book/area/update', action: 'BookAreaUpdate')->name('booarea.update'); 
          });
    });

        //Room Type Group Middleware
    Route::middleware(['auth', 'roles:admin'])->group(function () {
    // Book Area All Router team.store
     Route::controller( RoomTypeController::class)->group(function () {
        Route::get('/room/type/list', action: 'RoomTypeList')->name('room.type.list');
        Route::post('/book/area/update', action: 'BookAreaUpdate')->name('booarea.update'); 
        Route::get('/add/room/type', action: 'AddRoomType')->name('add.room.type'); 
        Route::post('/room/type/store', action: 'RoomTypeStore')->name('room.type.store'); 
          });
    });
    // End Admin Group Middleware 

         //Room all Group 
        Route::controller( RoomController::class)->group(function () {
        
            Route::get('/edit/room/{id}', action: 'EditRoom')->name('edit.room');
            Route::post('/update/room/{id}', action: 'UpdateRoom')->name('update.room');
            Route::get('/multi/image/delete/{id}', action: 'MultiImageDelete')->name('multi-image.delete');

            Route::post('/store/room/no/{id}', action: 'StoreRoomNumber')->name('store.room.no');
            Route::get('/edit/roomno/{id}', action: 'EditRoomNumber')->name('edit.roomno');
            Route::post('/update/room/no/{id}', action: 'updateRoomNumber')->name('update.roomno');
            Route::get('/delete/roomno/{id}', action: 'DeleteRoomNumber')->name('delete.roomno');
          });

}); 
