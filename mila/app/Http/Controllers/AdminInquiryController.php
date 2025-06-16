<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inquiry;
use App\Models\Agency;

class AdminInquiryController extends Controller
{
    public function viewPrevious(Request $request)
    {
        $query = Inquiry::with('agency');

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('InquiryDate', [$request->start_date, $request->end_date]);
        }

        if ($request->filled('InquiryStatus')) {
            $query->where('InquiryStatus', $request->InquiryStatus);
        }

        if ($request->filled('AssignedAgency')) {
            $query->where('AssignedAgency', $request->AssignedAgency);
        }

        $inquiries = $query->orderBy('InquiryDate', 'desc')->get();
        $agencies = Agency::all();

        return view('inquiry.InquiryPreviousAssign', compact('inquiries', 'agencies'));
    }

    public function viewPending()
{
    $inquiries = Inquiry::whereNull('InquiryStatus')
                ->orWhere('InquiryStatus', 'Pending')
                ->get();

    return view('inquiry.ViewSubmitInquiry', compact('inquiries')); // ✅ This sends $inquiries to the view
}


    public function processValidation(Request $request, $id)
    {
        $request->validate([
            'InquiryStatus' => 'required|in:Valid,Rejected',
        ]);

        $inquiry = Inquiry::findOrFail($id);
        $inquiry->InquiryStatus = $request->InquiryStatus;
        $inquiry->save();

        return redirect()->route('inquiries.pending')->with('success', 'Inquiry has been updated successfully.');
    }

    public function showUnvalidated()
    {
        $inquiries = Inquiry::where('InquiryStatus', 'Pending')->get();
       return view('inquiry.ViewSubmitInquiry'); // This will work

    }

    public function validateInquiry(Request $request, $id)
    {
        $request->validate([
            'InquiryStatus' => 'required|in:Valid,Rejected',
        ]);

        $inquiry = Inquiry::findOrFail($id);
        $inquiry->InquiryStatus = $request->InquiryStatus;
        $inquiry->save();

        return redirect()->route('inquiries.submit.view')->with('success', 'Inquiry status updated.');
    }
}
