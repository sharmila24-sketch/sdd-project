<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InquiryAssignment;

class InquiryController extends Controller
{
    public function assignmentList()
    {
        // Fetch the assignments for the logged-in user with related inquiry and agency
    $inquiryIds = ['IQ01', 'IQ02'];

    $assignments = InquiryAssignment::with('inquiry', 'agency')
    ->whereIn('InquiryID', $inquiryIds)
    ->get();
        // Define the sidebar items array (can copy from UserController publicAssignments)
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
                    ['label' => 'Agency Assignment', 'url' => route('public.assignments')],
                ]
            ],
            ['label' => '<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="none" stroke="white" stroke-width="2.5" viewBox="0 0 24 24" style="vertical-align:middle; margin-right:8px;"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>Status', 'url' => '#',
                'children' => [
                    ['label' => 'Submitted Inquiry', 'url' => '#']
                ]
            ],
        ];

        // Define sidebar CSS class to style the sidebar accordingly
        $sidebarClass = 'public-user';
        // Return the view with the assignments, sidebar items, and sidebar class
        return view('public.AgencyAssignment', compact('assignments', 'sidebarItems', 'sidebarClass'));

    }
}
