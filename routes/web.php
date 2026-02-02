<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AboutMeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

Route::get('/', fn () => redirect('/login'));

Route::get('/test-auth', function () {
    dd(auth()->user());
});

require __DIR__.'/auth.php';

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::post('/admin/ckeditor/upload', function (Request $request) {
    if ($request->hasFile('upload')) {
        $path = $request->file('upload')->store('ckeditor', 'public');

        return response()->json([
            'url' => asset('storage/' . $path),
        ]);
    }

    return response()->json(['error' => 'No file uploaded'], 400);
});