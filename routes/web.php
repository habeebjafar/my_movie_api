<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\MoviesController;
use App\Http\Controllers\SeriesMoviesController;

use App\Http\Controllers\SeriesMoviesSeasonsController;

use App\Http\Controllers\SeriesMoviesEpisodesController;



use App\Http\Controllers\CountryController;
use App\Http\Controllers\SliderController;

use App\Http\Controllers\ActorsDirectorsController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\SubjectTopicsController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\VoucherController;

use App\Http\Controllers\PdfFileController;

use App\Http\Controllers\PaystackController;






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

Route::get('/', function () {
    return view('welcome');
});

Route::get('dashboard', [DashboardController::class, 'index']);

Route::get('get-slider-form', [SliderController::class, 'create']);
Route::post('post-slider-form', [SliderController::class, 'store']);
Route::get('all-sliders', [SliderController::class, 'index']);
Route::get('edit-slider/{id}', [SliderController::class, 'edit']);
Route::post('update-slider-form/{id}', [SliderController::class, 'update']);
Route::get('delete-slider/{id}', [SliderController::class, 'destroy']);
Route::get('get-genre-form', [GenreController::class, 'create']);
Route::post('post-genre-form', [GenreController::class, 'store']);
Route::get('all-genres', [GenreController::class, 'index']);
Route::get('delete-genre/{id}', [GenreController::class, 'destroy']);
Route::get('edit-genre/{id}', [GenreController::class, 'edit']);
Route::post('update-genre/{id}', [GenreController::class, 'update']);
Route::get('get-country-form', [CountryController::class, 'create']);
Route::post('post-country-form', [CountryController::class, 'store']);
Route::post('post-country-form', [CountryController::class, 'store']);
Route::get('all-countries', [CountryController::class, 'index']);
Route::get('delete-country/{id}', [CountryController::class, 'destroy']);
Route::get('edit-country/{id}', [CountryController::class, 'edit']);
Route::post('update-country/{id}', [CountryController::class, 'update']);
Route::get('get-star-form', [ActorsDirectorsController::class, 'create']);
Route::post('post-star-form', [ActorsDirectorsController::class, 'store']);
Route::get('all-stars', [ActorsDirectorsController::class, 'index']);
Route::get('delete-star/{id}', [ActorsDirectorsController::class, 'destroy']);
Route::get('edit-star/{id}', [ActorsDirectorsController::class, 'edit']);
Route::post('update-star-form/{id}', [ActorsDirectorsController::class, 'update']);
Route::get('get-movie-form', [MoviesController::class, 'create']);
Route::post('post-movie-form', [MoviesController::class, 'store']);
Route::get('all-movies', [MoviesController::class, 'index']);
Route::get('delete-movie/{id}', [MoviesController::class, 'destroy']);
Route::get('edit-movie/{id}', [MoviesController::class, 'edit']);
Route::post('update-movie-form/{id}', [MoviesController::class, 'update']);
Route::get('get-series-form', [SeriesMoviesController::class, 'create']);
Route::post('post-series-form', [SeriesMoviesController::class, 'store']);
Route::get('all-series', [SeriesMoviesController::class, 'index']);
Route::get('delete-series/{id}', [SeriesMoviesController::class, 'destroy']);
Route::get('edit-series/{id}', [SeriesMoviesController::class, 'edit']);
Route::post('update-series-form/{id}', [SeriesMoviesController::class, 'update']);

Route::get('get-season-form', [SeriesMoviesSeasonsController::class, 'create']);
Route::post('post-season-form', [SeriesMoviesSeasonsController::class, 'store']);
Route::get('all-seasons', [SeriesMoviesSeasonsController::class, 'index']);




//Route::get('get-season-form', [SeriesMoviesController::class, 'getSeasonForm']);
//Route::post('add-season', [SeriesMoviesController::class, 'addSeason']);

Route::get('get-episode-form', [SeriesMoviesEpisodesController::class, 'create']);
Route::post('post-episode-form', [SeriesMoviesEpisodesController::class, 'store']);
Route::get('all-episodes', [SeriesMoviesEpisodesController::class, 'index']);
Route::get('edit-episode/{id}', [SeriesMoviesEpisodesController::class, 'edit']);
Route::post('update-episode-form/{id}', [SeriesMoviesEpisodesController::class, 'update']);
Route::get('delete-episode/{id}', [SeriesMoviesEpisodesController::class, 'destroy']);



Route::get('get-subject-form', [SubjectController::class, 'create']);
Route::post('post-subject-form', [SubjectController::class, 'store']);
Route::get('all-subjects', [SubjectController::class, 'index']);

Route::get('delete-subject/{id}', [SubjectController::class, 'destroy']);
Route::get('edit-subject/{id}', [SubjectController::class, 'edit']);
Route::post('update-subject/{id}', [SubjectController::class, 'update']);
Route::get('get-topic-form', [SubjectTopicsController::class, 'create']);
Route::post('post-topic-form', [SubjectTopicsController::class, 'store']);
Route::get('all-topics', [SubjectTopicsController::class, 'index']);
Route::get('delete-topic/{id}', [SubjectTopicsController::class, 'destroy']);
Route::get('edit-topic/{id}', [SubjectTopicsController::class, 'edit']);
Route::post('update-topic-form/{id}', [SubjectTopicsController::class, 'update']);

Route::get('get-question-form', [QuizController::class, 'create']);

//Route::get('all-topics', [SubjectTopicsController::class, 'topicIndex']);
Route::get('edit-question/{id}', [QuizController::class, 'edit']);


Route::get('getTopics/{id}', [QuizController::class, 'getTopics']);

Route::post('post-question-form', [QuizController::class, 'store']);
Route::get('all-questions', [QuizController::class, 'index']);
Route::get('delete-question/{id}', [QuizController::class, 'destroy']);
Route::post('update-question-form/{id}', [QuizController::class, 'update']);


Route::get('get-voucher-form', [VoucherController::class, 'create']);
Route::post('post-voucher-form', [VoucherController::class, 'store']);
Route::get('get-all-vouchers', [VoucherController::class, 'index']);
Route::get('sell-voucher/{id}', [VoucherController::class, 'sellVoucher']);

Route::get('test-voucher-form', [VoucherController::class, 'testVoucherForm']);
Route::post('test-voucher', [VoucherController::class, 'testVoucher']);

Route::get('print-voucher-form', [VoucherController::class, 'printVoucherForm']);



Route::get('get-book-form', [PdfFileController::class, 'create']);
Route::post('post-book-form', [PdfFileController::class, 'store']);
Route::get('get-all-books', [PdfFileController::class, 'index']);
Route::get('delete-book/{id}', [PdfFileController::class, 'destroy']);
Route::get('edit-book/{id}', [PdfFileController::class, 'edit']);
Route::post('update-book-form/{id}', [PdfFileController::class, 'update']);

Route::get('get-all-paystack-payments', [PaystackController::class, 'index']);





































