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

Route::get('/', function () {
    return view('welcome');
});
//import model
use App\Mahasiswa;
use App\Dosen;
use App\Hobi;

//Route One to One
Route::get('relasi1', function(){
    //memilih data mahasiswa yang memiliki nim '101010'
    $mhs = Mahasiswa::where('nim', '=', '1011010')->first();

    //Menampilkan data wali dari mahasiswa yang dipilih
    return $mhs->wali->nama;
});

Route::get('relasi2', function(){
    //memilih data mahasiswa yang memiliki nim '101010'
    $mhs = Mahasiswa::where('nim', '=', '1011010')->first();

    //Menampilkan data dosen dari mahasiswa yang dipilih
    return $mhs->dosen->nama;
});

Route::get('relasi3', function(){
    //mencari dosren dengan bernama abdul musthafa
    $dosen = Dosen::where('nama', '=', 'Abdul Musthafa')->first();

    //Menampilkan data mahasiswa dari dosen yang dipilih
    foreach ($dosen->mahasiswa as $temp) {
        echo '<li> Nama : '.$temp->nama . 
             '<strong>' . $temp->nim . '</strong></li>';
    }
});

Route::get('relasi4', function(){
    //mencari mahasiswa yang bernama Daadng
    $dadang = Mahasiswa::where('nama', '=', 'Dadang peloy')->first();

    //Menampilkan seluruh hobi dari dadang
    foreach ($dadang->hobi as $temp) {
        echo '<li>' .$temp->hobi . '</li>';
    }
});

Route::get('relasi5', function(){
    //mencari dosren dengan bernama abdul musthafa
    $dota = Hobi::where('hobi', '=', 'Game Mobile')->first();

    //Menampilkan semua mahasiswa yang mempunyai hobi MObile
    foreach ($dota->mahasiswa as $temp) {
        echo '<li> Nama : '.$temp->nama . 
             '<strong>' . $temp->nim . '</strong></li>';
    }
});

Route::get('relasi5', function(){
    //mencari dosren dengan bernama abdul musthafa
    $dota = Hobi::where('hobi', '=', 'Game Mobile')->first();

    //Menampilkan semua mahasiswa yang mempunyai hobi MObile
    foreach ($dota->mahasiswa as $temp) {
        echo '<li> Nama : '.$temp->nama . 
             '<strong>' . $temp->nim . '</strong></li>';
    }
});

Route::get('relasi-join', function(){
    //join Laravel
    $sql = DB::table('mahasiswas')
    ->select('mahasiswas.nama', 'mahasiswas.nim',
            'walis.nama as nama_wali')
    ->join('walis','walis.id_mahasiswa','=','mahasiswas.id')
    ->get();
    dd($sql);
});

Route::get('eloquent', function(){
    $mahasiswa = Mahasiswa::with('dosen','hobi','wali')->get();
    return view('eloquent',compact('mahasiswa'));
});

Route::get('eloquent1', function(){
    $mahasiswa = Mahasiswa::with('dosen','hobi','wali')->get()->take(1);
    return view('eloquent1',compact('mahasiswa'));
});