<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\UserController;
use App\Exports\InquiriesExport;
use Maatwebsite\Excel\Facades\Excel;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Dashboard routes for different user roles
Route::get('/public/dashboard', [UserController::class, 'publicDashboard'])->name('public.dashboard');
Route::get('/mcmc/dashboard', [UserController::class, 'mcmcDashboard'])->name('mcmcStaff.dashboard');
Route::get('/agency/dashboard', [UserController::class, 'agencyDashboard'])->name('agency.dashboard');


//public user
//InquiryForm
Route::get('/submit-inquiry', [InquiryController::class, 'create'])->name('inquiries.create');
Route::post('/submit-inquiry', [InquiryController::class, 'store'])->name('inquiries.store');
//view past inquiry submit
Route::get('/inquiries/past', [InquiryController::class, 'viewPast'])->name('inquiries.past');

// Public view for all public inquiries
//belum buat css
Route::get('/inquiries/public', [InquiryController::class, 'viewPublic'])->name('inquiries.public');




// MCMC: View all new inquiries (Pending)
//viewsubmitinquiry
Route::get('/mcmc/inquiries/pending', [InquiryController::class, 'viewPending'])->name('inquiries.viewPending');

// MCMC: Validate or reject inquiry
Route::post('/mcmc/inquiries/{id}/validate', [InquiryController::class, 'validateInquiry'])->name('inquiries.validate');

//viewPreviusInquiry
//selek agency x setel 
Route::get('/mcmc/previous-inquiries', [InquiryController::class, 'viewFiltered'])
    ->name('inquiries.previous');

   
//report
Route::get('/mcmc/inquiry-reports', [InquiryController::class, 'report'])->name('inquiries.report');

Route::get('/mcmc/inquiry-reports', [InquiryController::class, 'report'])->name('inquiries.report');
Route::get('/mcmc/inquiry-reports/export/pdf', [InquiryController::class, 'exportPdf'])->name('inquiries.export.pdf');
Route::get('/mcmc/inquiry-reports/export/excel', [InquiryController::class, 'exportExcel'])->name('inquiries.export.excel');

use App\Http\Controllers\AgencyInquiryController;

Route::get('/agency/inquiries', [AgencyInquiryController::class, 'viewAssignedInquiries'])->name('agency.inquiries');
//http://localhost:8000/agency/inquiries?agency_id=1

use App\Http\Controllers\ReportController;

Route::get('/inquiries/{id}/history', [ReportController::class, 'viewHistory'])->name('inquiries.history');
//http://localhost:8000/inquiries/5/history