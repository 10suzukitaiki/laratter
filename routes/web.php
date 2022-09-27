<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TweetController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\SearchController;

use App\Http\Controllers\broke;

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
Route::group(['middleware' => 'auth'], function () {
    Route::get('/tweet/search/input', [SearchController::class, 'create'])->name('search.input');
    // 🔽 追加（検索処理）
    Route::get('/tweet/search/result', [SearchController::class, 'index'])->name('search.result');
    Route::get('/tweet/timeline', [TweetController::class, 'timeline'])->name('tweet.timeline');
    Route::get('/tweet/mypage', [TweetController::class, 'mydata'])->name('tweet.mypage');
    Route::get('user/{user}', [FollowController::class, 'show'])->name('follow.show');
    Route::post('tweet/{tweet}/favorites', [FavoriteController::class, 'store'])->name('favorites');
    Route::post('user/{user}/follow', [FollowController::class, 'store'])->name('follow');
    // 🔽 追加
    Route::post('user/{user}/unfollow', [FollowController::class, 'destroy'])->name('unfollow');
    // 🔽 追加
    Route::post('tweet/{tweet}/unfavorites', [FavoriteController::class, 'destroy'])->name('unfavorites');
    Route::resource('tweet', TweetController::class);


    // 🔽 追加
    Route::post('tweet/{tweet}/broke', [broke::class, 'store'])->name('broke');

    // 🔽 追加
    Route::post('tweet/{tweet}/unbroke', [broke::class, 'destroy'])->name('unbroke');

});

Route::get('/', function () {
  return view('welcome');
});

Route::get('/dashboard', function () {
  return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';