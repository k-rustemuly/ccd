<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\ParseJWTToken;

Route::group([
    'prefix' => '{locale}', 
    'where' => ['locale' => '[a-zA-Z]{2}']], function() {

        Route::group(['prefix' => 'admin', 'as' => 'admin.'], function() {

            Route::post('/sign-in', \App\Ccd\Admin\Actions\SignInAction::class);

            Route::middleware([ParseJWTToken::class])->group(function () {

            });

        });

    });