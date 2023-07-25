<?php

use App\Http\Controllers\HomeController as Home;
use App\Http\Controllers\Panel\InformationController;
use App\Http\Controllers\Panel\ExercisesController;
use App\Http\Controllers\Panel\HomeController;
use App\Http\Controllers\Panel\NutritionController;
use App\Http\Controllers\Panel\SettingsController;
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

Route::get('/', [Home::class, 'landing'])->name('landing');
Route::get('/index', [Home::class, 'index'])->name('index');
Route::get('/login', [Home::class, 'index']);

Route::controller(Home::class)->prefix('auth/')->as('auth.')->middleware(['web'])->group(
    function () {
        Route::get('login', 'login')->name('login');
    }
);

Route::prefix('panel/')->as('panel.')->middleware(['web', 'auth'])->group(
    function () {

        Route::controller(HomeController::class)->group(
            function () {
                Route::get('', 'home')->name('home');
            }
        );

        Route::controller(ExercisesController::class)->prefix('exercises/')->as('exercises.')->group(
            function () {
                Route::get('', 'index')->name('index');
                Route::get('workouts', 'workouts')->name('workouts');
                Route::get('muscles', 'muscles')->name('muscles');
                Route::get('equipment', 'equipment')->name('equipment');
                Route::get('levels', 'levels')->name('levels');
                Route::get('goals', 'goals')->name('goals');
                Route::get('challenges', 'challenges')->name('challenges');
            }
        );

        Route::controller(NutritionController::class)->prefix('nutritions/')->as('nutritions.')->group(
            function () {
                Route::get('', 'index')->name('index');
                Route::get('recipes', 'recipes')->name('recipes');
                Route::get('food-types', 'foodTypes')->name('food-types');
                Route::get('food-exchanges', 'foodExchanges')->name('food-exchanges');
                Route::get('meals', 'meals')->name('meals');
                Route::get('meal-types', 'mealTypes')->name('meal-types');
                Route::get('measurement-units', 'measurementUnits')->name('measurement-units');
                Route::get('meal-plans', 'mealPlans')->name('meal-plans');
            }
        );

        Route::controller(InformationController::class)->prefix('information/')->as('information.')->group(
            function () {
                Route::get('tags', 'tags')->name('tags');
                Route::get('tips', 'tips')->name('tips');
                Route::get('posts', 'posts')->name('posts');
            }
        );

        Route::controller(SettingsController::class)->prefix('settings/')->as('settings.')->group(
            function () {
                Route::get('', 'index')->name('index');
                Route::get('users', 'users')->name('users');
                Route::get('goals', 'goals')->name('goals');
                Route::get('questions', 'questions')->name('questions');
                Route::get('answers', 'answers')->name('answers');
            }
        );
    }
);

Route::get('testing', function () {
    return view('panel.testing', ['title' => 'testing']);
});
