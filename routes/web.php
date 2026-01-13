<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MemberController;
use App\Http\Controllers\SuccessStoryController;
use App\Http\Controllers\EventController;

Route::get('/', function () {
    return redirect()->route('members.index');
});

Route::get('members/export', [MemberController::class, 'export'])->name('members.export');
Route::get('members/{member}/success-stories', [SuccessStoryController::class, 'index'])
    ->name('members.success-stories.index');
Route::post('members/{member}/success-stories', [SuccessStoryController::class, 'store'])
    ->name('members.success-stories.store');

Route::get('events', [EventController::class, 'index'])->name('events.index');
Route::post('events', [EventController::class, 'store'])->name('events.store');

Route::resource('members', MemberController::class);
