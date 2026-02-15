<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AboutMeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

// Language switcher
Route::get('/lang/{locale}', function (string $locale) {
    if (in_array($locale, ['en', 'th'])) {
        session()->put('locale', $locale);
    }
    return redirect()->back();
})->name('lang.switch');

Route::get('/', [App\Http\Controllers\PortfolioController::class , 'index']);


Route::get('/dashboard', function () {
    return redirect('/admin');
})->middleware(['auth'])->name('admin');
;


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class , 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class , 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class , 'destroy'])->name('profile.destroy');
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

require __DIR__ . '/auth.php';