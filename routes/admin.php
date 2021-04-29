<?php

use Illuminate\Support\Facades\Route;


Route::group(['prefix'=>'dashboard','middleware'=>'auth'],function (){
    Route::get('/',[\App\Http\Controllers\Admin\DashdoardController::class,'index'])->name('admin.dashboard');
    Route::get('/profile',[\App\Http\Controllers\Admin\DashdoardController::class,'profile'])->name('admin.profile');

    Route::group(['prefix'=>'post'],function (){

        Route::view('/','admin.posts')->name('admin.post');
        Route::post('/postdatatable',[\App\Http\Controllers\Admin\PostsController::class,'datatable'])->name('admin.datatable');
        Route::post('/store',[\App\Http\Controllers\Admin\PostsController::class,'store'])->name('admin.store.post');
        Route::get('/edit/{id}',[\App\Http\Controllers\Admin\PostsController::class,'store'])->name('admin.edit.post');
        Route::put('/update/{id}',[\App\Http\Controllers\Admin\PostsController::class,'store'])->name('admin.update.post');
        Route::delete('/destroy/{id}',[\App\Http\Controllers\Admin\PostsController::class,'destroy'])->name('admin.delete.posts');

    });

    Route::group(['prefix'=>'project'],function (){
        Route::view('/','admin.projects')->name('admin.project');
        Route::post('/postdatatable',[\App\Http\Controllers\Admin\ProjectsController::class,'datatable'])->name('admin.project.datatable');
        Route::post('/store',[\App\Http\Controllers\Admin\ProjectsController::class,'store'])->name('admin.store.project');
        Route::get('/edit/{id}',[\App\Http\Controllers\Admin\ProjectsController::class,'store'])->name('admin.edit.project');
        Route::put('/update/{id}',[\App\Http\Controllers\Admin\ProjectsController::class,'store'])->name('admin.update.project');
        Route::delete('/destroy/{id}',[\App\Http\Controllers\Admin\ProjectsController::class,'destroy'])->name('admin.delete.project');
    });
});

Route::get('/test',[\App\Http\Controllers\Admin\PostsController::class,'test']);
