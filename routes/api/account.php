<?php

use Illuminate\Http\Request;

Route::prefix('account')->middleware('auth')->namespace('Account')->group(function () {
    Route::post('email', 'MyAccountController@postEmail');

    Route::post('password', 'MyAccountController@postPassword');

    Route::post('info', 'MyAccountController@postInfo');

    Route::post('upgrade', 'MyAccountController@upgrade');
    Route::post('upgrade/pro', 'MyAccountController@upgradeToPro');
    Route::post('downgrade', 'MyAccountController@downgrade');
    Route::post('downgrade/pro', 'MyAccountController@downgradeToArtist');

    Route::prefix('notifications')->group(function() {
        Route::get('/', 'MyAccountController@getNotifications');
        Route::post('/', 'MyAccountController@postNotifications');
    });

    Route::prefix('billing')->group(function() {
        Route::post('/', 'BillingController@store');
    //    Route::post('update', 'BillingController@update');
       Route::post('remove', 'BillingController@remove');
        Route::get('/method', 'BillingController@getPaymentMethod');
    });

    Route::prefix('subscription')->group(function() {
        Route::get('plans', 'SubscriptionController@getPlans');
        Route::get('subscriptions', 'SubscriptionController@getSubscriptions');
        Route::get('plan/subscribe', 'SubscriptionController@subscribeToPlan');
        Route::get('plan/{planid}/unsubscribe', 'SubscriptionController@unsubscribeFromPlan');
        Route::get('plan/{planid}/resume', 'SubscriptionController@resumeSubscription');
        Route::get('plan/{planid}/restart', 'SubscriptionController@restartSubscription');
    });

    Route::prefix('stats')->group(function() {
        Route::get('revenue/releases/all', 'StatsController@getRevenueForAllReleases');
        Route::get('revenue/tracks/all', 'StatsController@getRevenueForAllTracks');

        Route::get('volume/releases/all', 'StatsController@getVolumeForAllReleases');
        Route::get('volume/tracks/all', 'StatsController@getVolumeForAllTracks');

        Route::get('likes/releases/all', 'StatsController@getLikesForAllReleases');
        Route::get('likes/tracks/all', 'StatsController@getLikesForAllTracks');
    });

    Route::prefix('releases')->group(function() {
        Route::get('mine', 'MyReleases@index');
        Route::delete('/mine/delete/{release}', 'MyReleases@destroy');
        Route::patch('/mine/{release}', 'MyReleases@update');
    });

    Route::prefix('marketplace')->group(function () {
        Route::get('bank_accounts', 'MyAccountMarketplaceController@getBankAccounts');
        Route::post('remove_bank_account', 'MyAccountMarketplaceController@removeBankAccount');
        Route::post('add_new_bank_account', 'MyAccountMarketplaceController@addBankAccount');
        Route::post('set_default_bank', 'MyAccountMarketplaceController@setDefaultBankAccount');
        Route::get('account', 'MyAccountMarketplaceController@account');
        Route::post('update', 'MyAccountMarketplaceController@update');
        Route::post('update/file', 'MyAccountMarketplaceController@updateFile');
        Route::post('create', 'MyAccountMarketplaceController@store');

        Route::post('subscription-checkout', 'MyAccountMarketplaceController@subsCheckout');

//        Route::get('files', 'MyAccountMarketplaceController@getFiles');
//        Route::get('get_file/{id}', 'MyAccountMarketplaceController@getFile');
    });

    Route::prefix('invoices')->group(function () {
        Route::get('/', 'InvoicesController@index');
    });
});

Route::get('fetch-captcha-credentials', function () {
    return config("services.recaptcha");
});
