<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessageTextController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AdminUsersController;
use App\Http\Middleware\AdminMiddleware;
use App\Livewire\CounterAlberto;
use App\Livewire\CreatePost;
use App\Livewire\SearchPosts;
use App\Livewire\MessageComponent;
use App\Models\User;


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

// DB::listen (function ($query) {
//     dump($query->sql);
// });

// Route::view('/', 'welcome');

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::view('livewire', 'livewire')
    ->name('livewire');




Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/search-posts', SearchPosts::class);

Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::get('users', [AdminUsersController::class, 'index'])->name('users.index');
    Route::put('/users/{User}', [AdminUsersController::class, 'update'])->name('users.update');
    Route::delete('/users/{User}', [AdminUsersController::class, 'destroy'])->name('users.delete');
    Route::get('/users/download', [AdminUsersController::class, 'download'])->name('users.download');
});



require __DIR__.'/auth.php';

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});



Route::get('/form', [MessageTextController::class, 'index'])->name('form');
Route::post('/form', [MessageTextController::class, 'store'])->name('form.store');
Route::get('/messages/{MessageText}/edit', [MessageTextController::class, 'edit'])->name('messages.edit');
Route::put('/messages/{MessageText}', [MessageTextController::class, 'update'])->name('messages.update');
Route::delete('/messages/{MessageText}', [MessageTextController::class, 'destroy'])->name('messages.delete');

Route::group(['middleware' => 'auth'], function () {
    Route::resource('messages', 'MessageTextController');

    Route::get('messages/{MessageText}/like', [MessageTextController::class, 'like'])->name('messages.like');
    Route::get('messages/{MessageText}/unlike', [MessageTextController::class, 'unlike'])->name('messages.unlike');

    Route::get('messages/{MessageText}/dislike', [MessageTextController::class, 'dislike'])->name('messages.dislike');
    Route::get('messages/{MessageText}/undislike', [MessageTextController::class, 'undislike'])->name('messages.undislike');
});


Route::get('/privatemessages/{receiver}', function ($receiverId) {
    $receiver = User::findOrFail($receiverId);
    return view('messages.show', compact('receiver'));
})->name('privatemessages.show');


Route::get('/createpost', CreatePost::class);
Route::get('/counter', CounterAlberto::class);
// Route::get('/privado', MessageComponent::class);