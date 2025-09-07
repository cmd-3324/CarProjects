<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ChartController;

// Public Routes
Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/all', [PageController::class, 'show_all_cars'])->name('all-cars');
Route::get('/contact', [ContactController::class, 'show_contanct_page'])->name('contact');
Route::post('/search', [PageController::class, 'search'])->name('cars.search');
// Route::get('/fix-cars', [PageController::class, 'emergencyFixCarCounts'])->name('fix-em');
// Authentication Routes
Route::get("/search-carpage", [PageController::class, 'searchCarPage'])->name("Search_car_page");
Route::post("/add-to-favorites-", [PageController::class, 'addTofavorites'])->name("Add-To-Fav");
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store'])->name('register.store');
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login.store');
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
// Chart Routes - WITH YOUR CUSTOM NAME
Route::post('/chart/add', [PageController::class, 'addToChart'])->name("Add-Chart")->middleware(['auth']);
Route::post('/chart/remove', [PageController::class, 'removeFromChart'])->name('chart.remove');


Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/change-password', [ProfileController::class, 'showChangePasswordForm'])->name('password.change');
    Route::post('/profile/change-password', [ProfileController::class, 'updatePassword'])->name('password.update');
    Route::get("/profile/privacy", [ProfileController::class, 'privacy'])->name("profile.privacy");
    Route::get("/profile/email-preferences", [ProfileController::class, 'emailPreferences'])->name("profile.email-preferences");


    Route::post('/delete-car', [PageController::class, 'deleteCar'])->name('delete.car');
    Route::post('/delete-all', [PageController::class, 'deleteAll'])->name('delete.all');
    Route::get('/cars/sorted', [PageController::class, 'sortedCars'])->name('sort-cars');

    Route::get("/profile/{user_id}", [PageController::class, 'gotoProfile'])->name("profile-go");
    Route::post("/change-account-details", [PageController::class, 'changeAccount'])->name("account-change"); // Changed to match form action
    Route::post("/change-password", [PageController::class, 'change_password'])->name("change-password"); // Changed to match method name
    Route::post("/delete-account", [PageController::class, 'deleteaccount'])->name("delete.account"); // Changed to match method name


    Route::get('/chart', [PageController::class, 'viewChart'])->name('chart.view');
    Route::post('/chart/clear', [PageController::class, 'clearChart'])->name('chart.clear');

    Route::get("/about",[PageController::class, "GetAboutPage"])->name("aboutpage");
    Route::get("/dashboard", [PageController::class, 'sendDashboard'])->name("dashboard.send");
});

require __DIR__.'/auth.php';
