<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\EmailSendController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ReplyController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// Public routes for users

// Users
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{id}', [UserController::class, 'show']);

Route::get('/users/search/{name}', [UserController::class, 'search']);
Route::get('/users/comments/{id}', [UserController::class, 'searchComments']); // comments of an user
Route::get('/users/select/names', [UserController::class, 'getNames']);
Route::get('/users/select/emails', [UserController::class, 'getEmails']);


// Comments
Route::get('/comments', [CommentController::class, 'index']);
Route::get('/comments/{id}', [CommentController::class, 'show']);
Route::get('/comments/search/{name}', [CommentController::class,'search']);
Route::get('/comments/users/{id}', [CommentController::class,'searchById']); // comments of an user

// Replies
Route::get('/replies', [ReplyController::class, 'index']);
Route::get('/replies/{id}', [ReplyController::class, 'show']);

// Likes
Route::get('/likes', [CommentController::class, 'index']);
Route::get('/likes/{id}', [CommentController::class, 'show']);



// Protected routes
Route::group(['middleware' =>['auth:sanctum']], function() {
  
  // User routes
  Route::get('/whichconnected', [UserController::class, 'userConnected']);
  Route::post('/logout', [UserController::class, 'logout']);
  Route::delete('/users/{id}', [UserController::class, 'destroy']);
  Route::put('/users/{id}', [UserController::class, 'update']);
  
  // Comment routes
  
  Route::post('/comments', [CommentController::class, 'store']);
  Route::put('/comments/{id}', [CommentController::class, 'update']);
  Route::delete('/comments/{id}', [CommentController::class, 'destroy']);

  // Route::resource('comments', CommentController::class);
  
  // Like routes
  Route::post('/likes', [LikeController::class, 'store']);
  Route::post('/likes/{id}', [LikeController::class, 'update']);
  Route::delete('/likes/{id}', [LikeController::class, 'destroy']);
  
  // Reply routes
  Route::post('/replies', [ReplyController::class, 'store']);
  Route::post('/replies/{id}', [ReplyController::class, 'update']);
  Route::delete('/replies/{id}', [ReplyController::class, 'destroy']);
});


// Forgot Password
Route::post('/forgotpassword', [UserController::class, 'forgotPassword']);

Route::post('/send-mail', [EmailSendController::class, 'sendEmail'])->name('send.email');

Route::get('/users/emails/{email}', [UserController::class, 'getUserByEmail']);