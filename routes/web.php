<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;

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

// --- Welcome page ---
Route::get('/', function () {
    return view('welcome');
});

// --- Auth routes ---
Route::get("/login", [AuthController::class, "login"])->name("auth.login");
Route::post("/login", [AuthController::class, "signIn"]);

Route::get("/register", [AuthController::class, "register"])->name("auth.register");
Route::post("/register", [AuthController::class, "signUp"]);

Route::delete("/logout", [AuthController::class, "logout"])->name("auth.logout");

// --- Blog routes ---
Route::prefix('/blog')->name("blog.")->controller(BlogController::class)->group(function () {
    Route::get("/", "index")->name("index");

    Route::get('/new', "create")->name("create")->middleware(["auth", "admin"]);
    Route::post('/new', "store")->middleware(["auth", "admin"]);

    Route::get('/{post}/edit', "edit")->name("edit")->middleware(["auth", "admin"]);
    Route::patch('/{post}/edit', "update")->middleware(["auth", "admin"]);

    Route::get("/{slug}-{post}", "show")->where([
        "post" => "[0-9]+",
        "slug" => "[a-z0-9-]+"
    ])->name("show");
});
