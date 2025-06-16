<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InquiryController;

Route::get('/public/dashboard', [UserController::class, 'publicDashboard'])->name('public.dashboard');
Route::get('/mcmc/dashboard', [UserController::class, 'mcmcDashboard'])->name('mcmcStaff.dashboard');
Route::get('/agency/dashboard', [UserController::class, 'agencyDashboard'])->name('agency.dashboard');
Route::get('/public/assignments', [InquiryController::class, 'assignmentList'])->name('public.assignments');
