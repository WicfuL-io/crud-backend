<?php

use App\Http\Controllers\CCTVController;
use App\Http\Controllers\viewdatacontroller;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('main');
});

Route::get('/crude', function () {
    return view('pages.crude');
});

Route::get('/viewdata',[viewdatacontroller::class,'viewdataall']);

// ini untuk tambah data
Route::get('/viewdata/crude',[viewdatacontroller::class,'crudedata']);
Route::post('/viewdata',[viewdatacontroller::class,'store']);


// ini untuk edit data
Route::get('/viewdata/{id}/edit',[viewdatacontroller::class,'edit']);
Route::put('/viewdata/{id}',[viewdatacontroller::class,'update']);

// penghapusan data
Route::delete('/viewdata/{id}',[viewdatacontroller::class,'destroy']);