<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inquiry;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\InquiryReportExport;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class InquiryController extends Controller
{
    // PUBLIC USER - View form
    public function create()
    {
        return view('inquiry.InquiryForm');
    }

    // PUBLIC USER - Submit form
    public function store(Request $request)
    {
   // Validasi asas
$request->validate([
    'InquiryTitle' => 'required|string',
    'InquiryDescription' => 'required|string',
    'InquiryEvidance' => 'nullable|file|mimes:jpg,jpeg,png,pdf,docx|max:2048',
    'is_public' => 'required|in:0,1',
    'InquiryCategory' => 'required|string',
]);

// Simpan fail evidence jika ada
$evidencePath = null;
if ($request->hasFile('InquiryEvidance')) {
    $evidencePath = $request->file('InquiryEvidance')->store('evidence', 'public');
}

// Simpan ke dalam database
Inquiry::create([
    'UserID' => session('UserID') ?? 1, // fallback user ID
    'InquiryTitle' => $request->InquiryTitle,
    'InquiryDescription' => $request->InquiryDescription,
    'InquiryEvidance' => $evidencePath,
    'InquiryDate' => now(),
    'InquiryStatus' => 'Pending',
    'AssignedAgency' => null,
    'is_public' => $request->is_public,
    'InquiryCategory' => $request->InquiryCategory, // ✅ Ini betul
]);


       return redirect()->route('inquiries.create')->with('success', 'Inquiry submitted successfully!');
    }

    // MCMC - View new (pending) inquiries
    public function viewPending()
    {
        $inquiries = Inquiry::where('InquiryStatus', 'Pending')
                            ->orderBy('InquiryDate', 'desc')
                            ->get();

        return view('inquiry.ViewSubmitInquiry', compact('inquiries'));
    }

    // MCMC - Accept or reject inquiries
    public function validateInquiry(Request $request, $InquiryID)
    {
        $request->validate([
            'action' => 'required|in:valid,non-serious',
        ]);

        $inquiry = Inquiry::findOrFail($InquiryID);
        $inquiry->InquiryStatus = $request->action === 'valid' ? 'Valid' : 'Rejected';
        $inquiry->save();

        return back()->with('success', 'Inquiry status updated successfully.');
    }

    // AGENCY - View assigned inquiries
    public function viewAssignedInquiries(Request $request)
    {
        $agencyId = 3; // Simulated agency user ID

        $query = Inquiry::where('AssignedAgency', $agencyId);

        if ($request->filled('status')) {
            $query->where('InquiryStatus', $request->status);
        }

        $inquiries = $query->get();

        return view('inquiry.ViewAssignInquiry', compact('inquiries'));
    }

    // PUBLIC USER - View past inquiries
    public function viewPast()
    {
        $userID = session('UserID') ?? 1;

        $inquiries = Inquiry::where('UserID', $userID)
                            ->orderBy('InquiryDate', 'desc')
                            ->get();

        return view('inquiry.ViewPastInquiry', compact('inquiries'));
    }

    // MCMC - View filtered inquiries
    public function viewFiltered(Request $request)
    {
        $query = Inquiry::where('InquiryStatus', '!=', 'Pending');

        if ($request->filled('status')) {
            $query->where('InquiryStatus', $request->status);
        }

        if ($request->filled('agency')) {
            $query->where('AssignedAgency', $request->agency);
        }

        if ($request->filled('date')) {
            $query->whereDate('InquiryDate', $request->date);
        }

        $inquiries = $query->latest()->paginate(10);
        return view('inquiry.ViewPreviousInqury', compact('inquiries'));
    }

    // PUBLIC - View public inquiries
    public function viewPublic(Request $request)
    {
        $query = Inquiry::where('is_public', true);

        if ($request->filled('title')) {
            $query->where('InquiryTitle', 'like', '%' . $request->title . '%');
        }

        if ($request->filled('date')) {
            $query->whereDate('InquiryDate', $request->date);
        }

        if ($request->filled('status')) {
            $query->where('InquiryStatus', $request->status);
        }

        $inquiries = $query->orderBy('InquiryDate', 'desc')->paginate(10);
        return view('inquiry.ViewPublicInquiry', compact('inquiries'));
    }

    // REPORT - PDF
    public function exportPdf(Request $request)
    {
        $filter = $request->filter ?? 'monthly';

        $inquiries = Inquiry::selectRaw("
                DATE_FORMAT(InquiryDate, '".($filter === 'yearly' ? '%Y' : '%Y-%m')."') as period,
                COUNT(*) as total
            ")
            ->groupBy('period')
            ->get();

        $pdf = PDF::loadView('inquiry.ReportPdf', compact('inquiries', 'filter'));
        return $pdf->download('inquiry_report_'.$filter.'.pdf');
    }

    // REPORT - Web view
    public function report(Request $request)
    {
        $filter = $request->input('filter', 'monthly');

        $inquiries = Inquiry::selectRaw('COUNT(*) as total, DATE_FORMAT(InquiryDate, ?) as period', [$filter == 'yearly' ? '%Y' : '%Y-%m'])
            ->groupBy('period')
            ->orderBy('period')
            ->get();

        return view('inquiry.InquiryReport', compact('inquiries', 'filter'));
    }

    // REPORT - Excel
    public function exportExcel(Request $request)
    {
        $filter = $request->input('filter', 'monthly');
        return Excel::download(new InquiryReportExport($filter), 'inquiry_report_' . now()->format('Ymd') . '.xlsx');
    }

    public function publicDashboard()
{
    $sidebarItems = [
        ['label' => '<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="none" stroke="white" stroke-width="2.5" viewBox="0 0 24 24" style="vertical-align:middle; margin-right:8px;"><path d="M3 13h18M3 6h18M3 18h18"/></svg>Dashboard', 'url' => route('public.dashboard')],
        ['label' => '<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="none" stroke="white" stroke-width="2.5" viewBox="0 0 24 24" style="vertical-align:middle; margin-right:8px;"><path d="M4 4h16v16H4z"/><polyline points="4,4 12,13 20,4"/></svg>Inbox', 'url' => '#'],
        ['label' => '<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24" style="vertical-align:middle; margin-right:8px;"><circle cx="12" cy="7" r="4"/><path d="M5 21c0-4 3-6 7-6s7 2 7 6"/></svg>Profile', 'url' => '#',
            'children' => [
                ['label' => 'View Profile', 'url' => '#'],
                ['label' => 'Edit Profile', 'url' => '#'],
            ]
        ],
        ['label' => '<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="none" stroke="white" stroke-width="2.5" viewBox="0 0 24 24" style="vertical-align:middle; margin-right:8px;"><path d="M12 20h9"/><path d="M16.5 3.5l4 4L8 20H4v-4L16.5 3.5z"/></svg>Inquiry', 'url' => '#',
            'children' => [
                ['label' => 'Inquiry Submission', 'url' => '#'],
                ['label' => 'Inquiry History', 'url' => '#'],
                ['label' => 'Agency Assignment', 'url' => '#'],
            ]
        ],

        ['label' => '<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="none" stroke="white" stroke-width="2.5" viewBox="0 0 24 24" style="vertical-align:middle; margin-right:8px;"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>Status', 'url' => '#',
            'children' => [
                ['label' => 'Submitted Inquiry', 'url' => '#']
            ]
        ],

        
    ];
    $sidebarClass = 'public-user';

    return view('public.dashboard', compact('sidebarItems', 'sidebarClass'));
}

}
