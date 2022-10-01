<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\GenreController;
use App\Http\Controllers\Api\MoviesController;

use App\Http\Controllers\Api\SeriesMoviesController;

use App\Http\Controllers\Api\SeriesMoviesEpisodesController;



use App\Http\Controllers\Api\SlidersController;
use App\Http\Controllers\Api\ActorsDirectorsController;
use App\Http\Controllers\Api\SubjectController;
use App\Http\Controllers\Api\TopicController;
use App\Http\Controllers\Api\QuestionController;


use App\Http\Controllers\Api\VouncherController;

use App\Http\Controllers\Api\PdfFileController;

use App\Http\Controllers\Api\PaystackController;








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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('sliders', [SlidersController::class, 'index']);
Route::get('genres', [GenreController::class, 'index']);

Route::get('get-all-movies', [MoviesController::class, 'index']);
Route::get('get-all-dramas', [MoviesController::class, 'getAllDramas']);
Route::get('get-all-thrillers', [MoviesController::class, 'getAllThrillers']); 
Route::get('get-all-latest-movies', [MoviesController::class, 'getAllLatestMovies']);
Route::get('get-all-animation', [MoviesController::class, 'getAllAnimations']);
Route::get('stars', [ActorsDirectorsController::class, 'index']);
Route::get('get-all-subjects', [SubjectController::class, 'index']);
Route::get('get-topics-by-subjectId/{subjectId}', [TopicController::class, 'getTopicsBySubjectId']);
Route::get('get-questions-by-topicId/{topicId}', [QuestionController::class, 'getQuestionsByTopicId']);

Route::get('get-movies-by-genre-name/{genreName}', [MoviesController::class, 'getMoviesByGenreName']);

Route::get('get-all-series', [SeriesMoviesController::class, 'index']);
Route::get('get-seasons-by-seriesId/{seriesId}', [SeriesMoviesEpisodesController::class, 'getSeasonsBySeriesId']);
Route::get('get-seasons-by-seriesId/{seriesId}', [SeriesMoviesEpisodesController::class, 'getSeasonsBySeriesId']);
Route::get('get-episodes-by-seasonId/{seriesId},{seasonId}', [SeriesMoviesEpisodesController::class, 'getEpisodeBySeasonId']);


Route::post('use-voucher-payment', [VouncherController::class, 'useVoucherPayment']);


Route::post('upload-image', [SubjectController::class, 'store']);

Route::post('upload-image-to-server', [SubjectController::class, 'uploadFile']);


Route::get('get-all-books', [PdfFileController::class, 'index']);

Route::post('paystack-payment', [PaystackController::class, 'store']);









