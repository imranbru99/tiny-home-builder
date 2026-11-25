<?php

use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SiteController::class, 'home'])->name('home');
Route::get('/about', [SiteController::class, 'about'])->name('about');
Route::get('/services', [SiteController::class, 'services'])->name('services.index');
Route::get('/services/{service}', [SiteController::class, 'serviceShow'])->name('services.show');
Route::get('/blog', [SiteController::class, 'blog'])->name('blog.index');
Route::get('/blog/{post}', [SiteController::class, 'blogShow'])->name('blog.show');
Route::get('/knowledge-base', [SiteController::class, 'knowledge'])->name('kb.index');
Route::get('/knowledge-base/{article}', [SiteController::class, 'knowledgeShow'])->name('kb.show');
Route::get('/contact', [SiteController::class, 'contact'])->name('contact');
Route::post('/contact', [SiteController::class, 'contactStore'])->name('contact.store');
Route::post('/ai/chat', [SiteController::class, 'chat'])->name('ai.chat');
