<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inquiry;
use Illuminate\Support\Facades\Auth;

class AgencyInquiryController extends Controller
{
    public function viewAllInquiries()
    {
        // Fetch all inquiries (including private ones)
        $inquiries = Inquiry::latest('InquiryDate')->paginate(10);

        return view('public.ViewPastInquiry', compact('inquiries'));
    }



public function viewAssignedInquiries(Request $request)
    {
        // ✅ Get agency ID from URL query (?agency_id=3)
        $agencyId = $request->query('agency_id');

        if (!$agencyId) {
            abort(400, 'Agency ID is required.');
        }

        $query = Inquiry::where('AssignedAgency', $agencyId);

        // ✅ Filter ikut status
        if ($request->filled('status')) {
            $query->where('InquiryStatus', $request->status);
        }

        // ✅ Filter ikut kategori
        if ($request->filled('category')) {
            $query->where('InquiryCategory', 'LIKE', '%' . $request->category . '%');
        }

        // ✅ Filter ikut tarikh
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('InquiryDate', [$request->start_date, $request->end_date]);
        }

        $inquiries = $query->latest('InquiryDate')->paginate(10);

        return view('agency.ViewAssignInquiry', compact('inquiries'));
    }
}
