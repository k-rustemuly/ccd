<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\ParseJWTToken;

Route::group([
    'prefix' => '{locale}', 
    'where' => ['locale' => '[a-zA-Z]{2}']], function() {

        Route::group(['prefix' => 'admin', 'as' => 'admin.'], function() {

            Route::post('/sign-in', \App\Ccd\Admin\Actions\SignInAction::class);

            Route::middleware([ParseJWTToken::class])->group(function () {

                Route::group(['prefix' => 'person', 'as' => 'person.'], function() {

                    Route::get('/', \App\Ccd\Person\Actions\ListAction::class);

                    Route::post('/', \App\Ccd\Person\Actions\AddAction::class)->name('create'); 

                    Route::group(['prefix' => '/{person_id}', 'where' => ['person_id' => '[0-9]+']], function() {

                        Route::get('', \App\Ccd\Person\Actions\AboutAction::class)->name('view');

                        Route::put('', \App\Ccd\Person\Actions\EditAction::class)->name('update');

                    });

                });

                Route::group(['prefix' => 'email', 'as' => 'email.'], function() {

                    Route::group(['prefix' => '/{person_id}', 'where' => ['person_id' => '[0-9]+']], function() {

                        Route::get('/', \App\Ccd\Email\Actions\ListAction::class)->name('list');

                        Route::post('/', \App\Ccd\Email\Actions\AddAction::class)->name('create'); 

                    });

                });

                Route::group(['prefix' => 'bank-account', 'as' => 'bank_account.'], function() {

                    Route::group(['prefix' => '/{person_id}', 'where' => ['person_id' => '[0-9]+']], function() {

                        Route::get('/', \App\Ccd\BankAccount\Actions\ListAction::class)->name('list');

                        Route::post('/', \App\Ccd\BankAccount\Actions\AddAction::class)->name('create'); 

                    });

                });

                Route::group(['prefix' => 'bank-card', 'as' => 'bank_card.'], function() {

                    Route::group(['prefix' => '/{person_id}', 'where' => ['person_id' => '[0-9]+']], function() {

                        Route::get('/', \App\Ccd\BankCard\Actions\ListAction::class)->name('list');

                        Route::post('/', \App\Ccd\BankCard\Actions\AddAction::class)->name('create'); 

                    });

                });

                Route::group(['prefix' => 'imei', 'as' => 'imei.'], function() {

                    Route::group(['prefix' => '/{person_id}', 'where' => ['person_id' => '[0-9]+']], function() {

                        Route::get('/', \App\Ccd\Imei\Actions\ListAction::class)->name('list');

                        Route::post('/', \App\Ccd\Imei\Actions\AddAction::class)->name('create'); 

                    });

                });

                Route::group(['prefix' => 'ip_address', 'as' => 'ip_address.'], function() {

                    Route::group(['prefix' => '/{person_id}', 'where' => ['person_id' => '[0-9]+']], function() {

                        Route::get('/', \App\Ccd\IpAddress\Actions\ListAction::class)->name('list');

                        Route::post('/', \App\Ccd\IpAddress\Actions\AddAction::class)->name('create'); 

                    });

                });

                Route::group(['prefix' => 'phone', 'as' => 'phone.'], function() {

                    Route::group(['prefix' => '/{person_id}', 'where' => ['person_id' => '[0-9]+']], function() {

                        Route::get('/', \App\Ccd\Phone\Actions\ListAction::class)->name('list');

                        Route::post('/', \App\Ccd\Phone\Actions\AddAction::class)->name('create'); 

                    });

                });

                Route::group(['prefix' => 'social-network', 'as' => 'social_network.'], function() {

                    Route::group(['prefix' => '/{person_id}', 'where' => ['person_id' => '[0-9]+']], function() {

                        Route::get('/', \App\Ccd\SocialNetworkBook\Actions\ListAction::class)->name('list');

                        Route::post('/', \App\Ccd\SocialNetworkBook\Actions\AddAction::class)->name('create'); 

                    });

                });

                Route::group(['prefix' => 'social-network-id', 'as' => 'social_network_id.'], function() {

                    Route::group(['prefix' => '/{person_id}', 'where' => ['person_id' => '[0-9]+']], function() {

                        Route::get('/', \App\Ccd\SocialNetworkIdBook\Actions\ListAction::class)->name('list');

                        Route::post('/', \App\Ccd\SocialNetworkIdBook\Actions\AddAction::class)->name('create'); 

                    });

                });

                Route::group(['prefix' => 'edrd', 'as' => 'edrd.'], function() {

                    Route::group(['prefix' => '/{person_id}', 'where' => ['person_id' => '[0-9]+']], function() {

                        Route::get('/', \App\Ccd\Edrd\Actions\ListAction::class)->name('list');

                        Route::post('/', \App\Ccd\Edrd\Actions\AddAction::class)->name('create'); 

                    });

                });

            });

        });

        Route::group(['prefix' => 'reference'], function() {

            Route::get('/gender', \App\Ccd\Gender\Actions\ListAction::class);

            Route::get('/social-network', \App\Ccd\SocialNetwork\Actions\ListAction::class);

        });

    });