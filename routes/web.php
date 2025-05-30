<?php

use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\AdminPostController;
use App\Http\Controllers\Admin\AdminSettingController;
use Illuminate\Support\Facades\Artisan;

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

// Route::get('/', function () {
//     return view('layouts.app');
// });

Route::get('/', function () {
    return redirect('/wall');
});

Route::middleware('guest')->group(function () {
    // Login Page (SPA-style)
    Route::get('/login', function () {
        return view('auth.login'); // This should extend app.blade.php and use @section('login')
    })->name('login');

    // Register Page (SPA-style)
    Route::get('/register', function () {
        return view('auth.register'); // Same: extends app.blade.php, uses @section('register')
    })->name('register');

    // Login Post (same as Breeze)
    Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login');

    // Register Post (same as Breeze)
    Route::post('/register', [RegisteredUserController::class, 'store'])->name('register');
});
    // Logout
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

Route::get('/wall', [PostController::class, 'wall'])->name('posts.wall');
Route::get('/wall/load', [PostController::class, 'loadMorePosts']);

Route::middleware('auth')->group(function () {
    Route::get('/user/settings', [ProfileController::class, 'index'])->name('user.settings');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->post('/post/{id}/like', [LikeController::class, 'toggle'])->name('post.like');
Route::middleware('auth')->post('/post/{id}/report', [ReportController::class, 'store'])->name('post.report');

Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/pending', [AdminController::class, 'index'])->name('admin.pending');
    Route::post('/approve/{id}', [AdminController::class, 'approve'])->name('admin.approve');
    Route::post('/flag/{id}', [AdminController::class, 'flag'])->name('admin.flag');
});


Route::middleware('auth')->group(function () {
    Route::get('/post/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/post', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

});

//Route::post('/posts', [PostController::class, 'store'])->middleware('auth');
Route::post('/posts/{post}/like', [LikeController::class, 'toggle'])->middleware('auth');

Route::get('/dashboard', [PostController::class, 'mine'])->name('posts.mine')->middleware('auth');

Route::prefix('admin')->group(function () {
    Route::get('register', [AuthController::class, 'showRegister'])->name('admin.register');
    Route::post('register', [AuthController::class, 'register']);
    
    Route::get('login', [AuthController::class, 'showLogin'])->name('admin.login');
    Route::post('login', [AuthController::class, 'login']);

    Route::middleware(['auth', 'admin'])->group(function () {
        Route::post('logout', [AuthController::class, 'logout'])->name('admin.logout');
        Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    });

    Route::get('/users', [AdminUserController::class, 'index'])->name('admin.users');
    Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])->name('admin.users.destroy');

    // Posts Management
    Route::get('/posts', [AdminPostController::class, 'index'])->name('admin.posts.index');
    Route::get('/posts/{post}/edit', [AdminPostController::class, 'edit'])->name('admin.posts.edit');
    Route::put('/posts/{post}', [AdminPostController::class, 'update'])->name('admin.posts.update');
    Route::delete('/posts/{post}', [AdminPostController::class, 'destroy'])->name('admin.posts.destroy');

    Route::get('/admin/settings', [AdminSettingController::class, 'edit'])->name('admin.settings.edit');
    Route::post('/admin/settings', [AdminSettingController::class, 'update'])->name('admin.settings.update');
});

Route::get('/run-seeder-87451xytd', function () {
    Artisan::call('db:seed', ['--class' => 'AdminPostsSeeder', '--force' => true]);
    return 'Seeder executed successfully.';
});

Route::get('/test',function(){
    return view('test');
});

