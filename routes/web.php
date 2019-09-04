<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index')->name("home");

/* Master Section */
Route::resource('guru', 'GuruController');
Route::resource('kriteria', 'KriteriaController');
Route::resource('sub', 'SubKriteriaController');


Route::get('keputusan/cetak', 'KeputusanGuru@cetak');
Route::post('keputusan/s', 'KeputusanGuru@session');
Route::resource('keputusan', 'KeputusanGuru');

Route::resource('perhitungan', 'PerhitunganController');
Route::post('perhitungan/hasil', 'PerhitunganController@HasilControl');
Route::get('/hasil', 'PerhitunganController@hasil');

Route::get('/laporanguru', 'LaporanController@indexGuru');
Route::post('/laporanguru/proses', 'LaporanController@laporanGuru');
Route::get('/laporanguru/output', 'LaporanController@PrintGuruTerbaik');

Route::get('/laporanranking', 'LaporanController@indexRanking');
Route::post('/laporanranking/proses', 'LaporanController@laporanRanking');
Route::get('/laporanranking/output', 'LaporanController@PrintRankGuru');

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
