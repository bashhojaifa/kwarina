<?php

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

//Route::get('/', function () {
//    return view('welcome');
//})->name('home');

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');


//  Admin Registration
Route::get('admin/register', 'Admin\RegistrationController@registerForm')->name('register.form');
Route::put('admin-register', 'Admin\RegistrationController@store')->name('admin.register');


//  For Admin

Route::group(['as' => 'admin.','prefix' => 'admin', 'namespace' => 'Admin', 'middleware'=> ['auth', 'admin']], function (){

    //  Admin Dashboard
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');

    //   Create/Update/Delete Home page content
    Route::resource('home-content', 'HomeController');

    //  Create/Update/Delete Books
    Route::resource('book', 'BookController');

    //   Create/Update/Delete Author
    Route::resource('author', 'AuthorController');

    // User Create/Update/Delete
    Route::resource('user', 'UserController');

    // All Users Sequence
    Route::get('sequence', 'SequenceUsers@sequence')->name('sequence');

    //   Create/Update/Delete Post
    Route::resource('post', 'PostController');

    //  Pending post
    Route::get('pending/post', 'PostController@pending')->name('pending.post');

    // Pending Post Approve
    Route::put('post/{id}/approve', 'PostController@approve')->name('post.approve');

    //   View Like Post
    Route::get('like/posts', 'SavePostsController@likePost')->name('like.posts');

    //  View Comment Post
    Route::get('comment/posts', 'SavePostsController@commentPost')->name('comment.posts');

    //  Admin Profile settings
    Route::get('profile/update', 'SettingsController@profileform')->name('profile.form');
    Route::put('profile-update', 'SettingsController@profileUpdate')->name('profile.update');

    //   Change Admin Password
    Route::get('password/change', 'SettingsController@passwordForm')->name('password.form');
    Route::put('change-password', 'SettingsController@changePassword')->name('change.password');

    // Carousel Images Create/Update/Delete
    Route::resource('carousel', 'CarouselController');

    //  Notification Create/Update/Delete
    Route::resource('notification', 'NotificationsController');
});

//  For Author

Route::group(['as' => 'author.', 'prefix' => 'author', 'namespace' => 'Author', 'middleware'=> ['auth', 'author']], function(){
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');

    //   Create/Update/Delete Post
    Route::resource('post', 'PostController');

    //  Author Users
    Route::get('your-users', 'UsersController@authorUsers')->name('users');

    //    Author Profile Update
    Route::get('profile/update', 'SettingsController@profileForm')->name('profile.form');
    Route::put('profile-update', 'SettingsController@profileUpdate')->name('profile.update');

    //    Change Author Password
    Route::get('password/change', 'SettingsController@passwordForm')->name('password.form');
    Route::put('change-password', 'SettingsController@changePassword')->name('change.password');

    //   View Like Post
    Route::get('like/posts', 'SavePostsController@likePost')->name('like.posts');

    //  View Comment Post
    Route::get('comment/posts', 'SavePostsController@commentPost')->name('comment.posts');
});


//  For user
Route::group(['as' => 'user.', 'prefix' => 'user', 'namespace' => 'User', 'middleware'=> ['auth', 'user']], function(){
   //   view profile
   Route::get('profile', 'ProfileController@profile')->name('profile');

   //   profile Update
   Route::put('update-profile', 'ProfileController@updateProfile')->name('update.profile');

   //   Change Password
   Route::put('update-password', 'ProfileController@updatePassword')->name('update.password');

   //   View Like Post
    Route::get('like/posts', 'SavePostsController@likePost')->name('like.posts');

    //  View Comment Post
    Route::get('comment/posts', 'SavePostsController@commentPost')->name('comment.posts');
});

//  For Auth
Route::group(['namespace' => 'Auth', 'middleware' => ['auth']], function (){
    // Show all post
    Route::get('post', 'PostController@index')->name('post');

    //  Books
    Route::get('all-books', 'BookController@allBook')->name('all.book');
    Route::get('view/{id}', 'BookController@viewBook')->name('book.view');
    Route::get('download/{id}', 'BookController@downloadBook')->name('book.download');

    // User Post
    Route::get('user/post/{id}', 'PostController@authorPost')->name('user.post');

    // Details post
    Route::get('post/{slug}', 'PostController@details')->name('post.details');

    //  Like Post
    Route::post('like', 'LikeController@postLikePost')->name('like');

    // Comment store
    Route::post('comment/{post}', 'CommentController@store')->name('comment.store');


    //  Edit comment
    Route::post('comment', 'CommentController@commentEdit' )->name('comment.edit');

    // Delete Comment
    Route::delete('comment/{id}', 'CommentController@destroyComment')->name('comment.destroy');

    //  profile
//    Route::get('profile', 'ProfileController@profile')->name('profile');
});
