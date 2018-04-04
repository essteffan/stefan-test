<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'DomainController@index')->name("home");
Route::post('/saveDomains', 'DomainController@save')->name("domain.save");
Route::get('/dns/{id}', 'FrontController@dnsView')->name("dns");
Route::post('/dns/{id}', 'FrontController@dnsSave')->name("dns.save");
Route::delete('/dns/{id}', 'FrontController@dnsDelete')->name("dns.delete");

Route::group(['prefix' => 'api/v1', 'middleware' => 'api'], function() {
    Route::post('/saveDNS', 'FrontController@saveNewDNS')->name("saveDNS");
    Route::delete('/deleteItem', 'FrontController@dnsDelete');

    Route::post('/saveDomain', 'DomainController@saveDomain')->name("saveDomain");
    Route::delete('/deleteDomain', 'DomainController@Delete');
});