<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Team\IndexTeamController;
use App\Http\Controllers\Form\IndexFormSettingsController;
use App\Http\Controllers\Collection\EditCollectionController;
use App\Http\Controllers\Collection\ShowCollectionController;
use App\Http\Controllers\Submission\ShowSubmissionController;
use App\Http\Controllers\Collection\IndexCollectionController;
use App\Http\Controllers\Collection\StoreCollectionController;
use App\Http\Controllers\Submission\StoreSubmissionController;
use App\Http\Controllers\Collection\UpdateCollectionController;
use App\Http\Controllers\Collection\DestroyCollectionController;
use App\Http\Controllers\Company\IndexCompanySettingsController;
use App\Http\Controllers\Collection\SelectWinnerCollectionController;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/giveaways/{collection}', ShowCollectionController::class)->name('giveaways.show');

Route::middleware(['auth', 'verified'])->prefix('/admin')->group(function () {
    Route::get('/giveaways', IndexCollectionController::class)->name('giveaways');
    Route::post('/giveaways/store', StoreCollectionController::class)->name('giveaways.store');
    Route::get('/giveaways/{collection}/edit', EditCollectionController::class)->name('giveaways.edit');
    Route::post('/giveaways/{collection}/update', UpdateCollectionController::class)->name('giveaways.update');
    Route::post('/giveaways/{collection}/select-winner', SelectWinnerCollectionController::class)->name('giveaways.select-winner');
    Route::delete('/giveaways/{collection}/destroy', DestroyCollectionController::class)->name('giveaways.destroy');

    Route::post('/giveaways/{collection}/submissions', StoreSubmissionController::class)->name('submissions.store');
    Route::get('/giveaways/{collection}/submissions/{submission}/show', ShowSubmissionController::class)->name('submissions.show');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/team', IndexTeamController::class)->name('team.index');
    Route::get('/company-settings', IndexCompanySettingsController::class)->name('company-settings');
    Route::get('/form-settings', IndexFormSettingsController::class)->name('form-settings');
});

require __DIR__ . '/auth.php';
