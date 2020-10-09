<?php

use Ombimo\LarawebCore\Controller\PageController;
use Illuminate\Support\Facades\Route;
use Ombimo\LarawebCore\Controller\ContactController;

if (config('laraweb.multilang')) {
    $prefix = '{locale}';
} else {
    $prefix = '';
}

Route::group([
    'middleware' => 'web',
    'prefix' => $prefix,
], function() {

    Route::get('page/{slug}', [PageController::class, 'index'])->name('page');
    Route::get('contact', [ContactController::class, 'get'])->name('contact');
    Route::post('contact', [ContactController::class, 'post']);

});
