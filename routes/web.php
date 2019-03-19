<?php

use App\Restaurant;

Route::get('/laravel', function () {
/*
    $restaurants=Restaurant::all();
        foreach($restaurants as $restaurant){
            echo $restaurant->name.'<br>';
            echo $restaurant->category->name.'<br>';

            foreach($restaurant->dishes as $dishe){
                echo'----'.$dishe->name.'<br>';
            }
        }
        die();
*/
    return view('welcome');
});


Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
