<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SessionController;
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

Route::get('/', [PostController::class, 'showHomePage']);
Route::get('/category/{category}', [PostController::class, 'showCategoryPage']);
Route::get('/post/{post}', [PostController::class, 'showSinglePostPage']);

Route::post('/add-comment/{post}', [PostController::class, 'addComment']);
Route::get('/search', [PostController::class, 'showSearchPage']);

Route::prefix('/admin')->group(function(){
    Route::get('/persons-data', [AdminController::class, 'showPersonsData']);
    Route::get('/posts-data', [AdminController::class, 'showPostsData']);
    Route::get('/category-data', [AdminController::class, 'showCategoryData']);
    Route::get('/comments-data', [AdminController::class, 'showCommentsData']);

    Route::get('/show-edit-person/{id}', [AdminController::class, 'showEditPerson']);
    Route::get('/show-edit-post/{id}', [AdminController::class, 'showEditPost']);
    Route::get('/show-edit-category/{id}', [AdminController::class, 'showEditCategory']);

    Route::post('/edit-person/{id}', [AdminController::class, 'editPerson']);
    Route::post('/edit-category/{id}', [AdminController::class, 'editCategory']);
    Route::post('/edit-post/{id}', [AdminController::class, 'editPost']);

    Route::get('/show-new-person', [AdminController::class, 'showNewPerson']);
    Route::get('/show-new-category', [AdminController::class, 'showNewCategory']);
    Route::get('/show-new-post', [AdminController::class, 'showNewPost']);

    Route::post('/new-person', [AdminController::class, 'newPerson']);
    Route::post('/new-category', [AdminController::class, 'newCategory']);
    Route::post('/new-post', [AdminController::class, 'newPost']);

    Route::post('/delete-person/{id}', [AdminController::class, 'deletePerson']);
    Route::post('/delete-category/{id}', [AdminController::class, 'deleteCategory']);
    Route::post('/delete-post/{id}', [AdminController::class, 'deletePost']);
    Route::post('/delete-comment/{id}', [AdminController::class, 'deleteComment']);

    Route::get('/search-person', [AdminController::class, 'searchPerson']);
    Route::get('/search-category', [AdminController::class, 'searchCategory']);
    Route::get('/search-post', [AdminController::class, 'searchPost']);
    Route::get('/search-comment', [AdminController::class, 'searchComment']);
})->middleware('admincheck');

Route::prefix('/user')->group(function(){
    Route::get('/show-my-data', [UserController::class, 'showMyData']);
    Route::get('/show-new-post', [UserController::class, 'showNewPost']);
    Route::post('/new-post', [UserController::class, 'newPost']);
    Route::get('/show-edit-post/{id}', [UserController::class, 'showEditPost']);
    Route::post('/edit-post/{id}', [UserController::class, 'editPost']);
    Route::post('/delete-post/{id}', [UserController::class, 'deletePost']);
})->middleware('usercheck');

Route::get('/get-session', [SessionController::class, 'getSession']);
Route::get('/set-session', [SessionController::class, 'setSession']);
Route::get('/destroy-session', [SessionController::class, 'destroySession']);

Route::get('/login', [LoginController::class, 'showLoginPage']);
Route::get('/signup', [LoginController::class, 'showRegisterPage']);
Route::post('/authenticate', [LoginController::class, 'authenticate']);
Route::post('/register', [LoginController::class, 'register']);
