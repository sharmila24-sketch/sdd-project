<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inquiry;
use App\Models\InquiryAuditLog;

class ReportController extends Controller
{
    public function viewHistory($inquiryId)
    {
        $inquiry = Inquiry::findOrFail($inquiryId);
        $history = InquiryAuditLog::where('InquiryID', $inquiryId)
            ->orderBy('AssignmentDate', 'desc')
            ->get();


        return view('inquiry.ViewInquiryHistory', compact('inquiry', 'history'));
    }
}
