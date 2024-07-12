<?php

use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\PageHomeController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\AjaxController;

    Route::group(['middleware'=>'sitesetting'],function(){

    Route::get('/',[PageHomeController::class,'anasayfa'])->name('anasayfa');

    Route::get('/hakkimizda',[PageController::class,'hakkimizda'])->name('hakkimizda');

    Route::get('/iletisim',[PageController::class,'iletisim'])->name('iletisim');

    Route::post('/iletisim/kaydet',[AjaxController::class,'iletisimkaydet'])->name('iletisim.kaydet');

    Route::get('/urunler',[PageController::class,'urunler'])->name('urunler');

    Route::get('/erkek/{slug?}',[PageController::class,'urunler'])->name('erkekurunler');

    Route::get('/kadin/{slug?}',[PageController::class,'urunler'])->name('kadinurunler');

    Route::get('/cocuk/{slug?}',[PageController::class,'urunler'])->name('cocukurunler');

    Route::get('/indirimdekiler',[PageController::class,'indirimdekiurunler'])->name('indirimdekiurunler');

    Route::get('/urun/{slug}',[PageController::class,'urundetay'])->name('urundetay');

    Route::get('/sepet',[CartController::class,'index'])->name('sepet');

    Route::post('/sepet/ekle',[CartController::class,'add'])->name('sepet.add');

});
