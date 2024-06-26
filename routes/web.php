<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return redirect('/admin');
})->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/send-test-email', function () {
    $details = [
        'title' => 'Mail from Laravel App',
        'body' => 'This is a test email'
    ];

    \Mail::to('eronax59@gmail.com')->send(new \App\Mail\TestEmail($details));

    return 'Email sent!';
});
require __DIR__.'/auth.php';
