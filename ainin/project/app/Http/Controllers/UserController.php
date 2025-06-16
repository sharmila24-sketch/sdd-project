<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\InquiryAssignment;

class UserController extends Controller
{
    // This method will show the dashboard based on the logged-in user role
    public function dashboard()
    {
        $user = Auth::user();       // Get logged-in user info
        $role = $user->UserRole;    // Get the user role from your user table
        
        // Pass user and role data to the dashboard view
        return view('dashboard.index', compact('role', 'user'));
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
                ['label' => 'Agency Assignment', 'url' => route('public.assignments')],
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

public function mcmcDashboard()
{
    $sidebarItems = [
        ['label' => '<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="none" stroke="white" stroke-width="2.5" viewBox="0 0 24 24" style="vertical-align:middle; margin-right:8px;"><path d="M3 13h18M3 6h18M3 18h18"/></svg>Dashboard', 'url' => route('mcmcStaff.dashboard')],
        ['label' => '<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="none" stroke="white" stroke-width="2.5" viewBox="0 0 24 24" style="vertical-align:middle; margin-right:8px;"><path d="M4 4h16v16H4z"/><polyline points="4,4 12,13 20,4"/></svg>Inbox', 'url' => '#'],
        ['label' => '<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="none" stroke="white" stroke-width="2.5" viewBox="0 0 24 24" style="vertical-align:middle; margin-right:8px;"><path d="M12 2a10 10 0 1 0 0 20 10 10 0 0 0 0-20z"/><path d="M8 12h8M12 8v8"/></svg>Agency Registration', 'url' => '#'],
        ['label' => '<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="none" stroke="white" stroke-width="2.5" viewBox="0 0 24 24" style="vertical-align:middle; margin-right:8px;"><path d="M4 4h16v16H4z"/><polyline points="4,4 12,13 20,4"/></svg>User Data', 'url' => '#',
            'children' => [
                ['label' => 'View All User', 'url' => '#'],
            ],
        ],
        ['label' => '<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="none" stroke="white" stroke-width="2.5" viewBox="0 0 24 24" style="vertical-align:middle; margin-right:8px;"><path d="M4 4h16v16H4z"/><path d="M8 16v-4M12 16v-6M16 16v-2"/></svg>Generate Report', 'url' => '#'],
        ['label' => '<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="none" stroke="white" stroke-width="2.5" viewBox="0 0 24 24" style="vertical-align:middle; margin-right:8px;"><path d="M12 20h9"/><path d="M16.5 3.5l4 4L8 20H4v-4L16.5 3.5z"/></svg>Inquiry', 'url' => '#',
            'children' => [
                ['label' => 'View Inquiry', 'url' => '#'],
                ['label' => 'Filter Inquiry', 'url' => '#'],
                ['label' => 'Previous Inquiry', 'url' => '#'],
                ['label' => 'Review & Assign Inquiry', 'url' => '#'],
            ],
        ],
        ['label' => '<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="none" stroke="white" stroke-width="2.5" viewBox="0 0 24 24" style="vertical-align:middle; margin-right:8px;"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>Status', 'url' => '#',
            'children' => [
                ['label' => 'Inquiry Progress', 'url' => '#'],
            ],
        ],
    ];

    $sidebarClass = 'mcmc-staff';

    return view('mcmcStaff.dashboard', compact('sidebarItems', 'sidebarClass'));
}


public function agencyDashboard()
{
    $sidebarItems = [
       
        ['label' => '<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="none" stroke="white" stroke-width="2.5" viewBox="0 0 24 24" style="vertical-align:middle; margin-right:8px;"><path d="M3 13h18M3 6h18M3 18h18"/></svg>Dashboard', 'url' => route('agency.dashboard')],
        ['label' => '<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="none" stroke="white" stroke-width="2.5" viewBox="0 0 24 24" style="vertical-align:middle; margin-right:8px;"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>Verify News', 'url' => '#'],       
        ['label' => '<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24" style="vertical-align:middle; margin-right:8px;"><circle cx="12" cy="7" r="4"/><path d="M5 21c0-4 3-6 7-6s7 2 7 6"/></svg>Profile', 'url' => '#',
            'children' => [
                ['label' => 'View Profile', 'url' => '#'],
                ['label' => 'Edit Profile', 'url' => '#'],
            ],
        ],
        ['label' => '<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="none" stroke="white" stroke-width="2.5" viewBox="0 0 24 24" style="vertical-align:middle; margin-right:8px;"><path d="M12 20h9"/><path d="M16.5 3.5l4 4L8 20H4v-4L16.5 3.5z"/></svg>Inquiry', 'url' => '#',
            'children' => [
                ['label' => 'History Inquiry', 'url' => '#'],
                ['label' => 'Previous Inquiry', 'url' => '#'],
                ['label' => 'Assigned Inquiry', 'url' => '#'],
                ['label' => 'Jurisdiction Review', 'url' => '#'],
            ],
        ],
        ['label' => '<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="none" stroke="white" stroke-width="2.5" viewBox="0 0 24 24" style="vertical-align:middle; margin-right:8px;"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>Status', 'url' => '#',
            'children' => [
                ['label' => 'Update Status', 'url' => '#'],
            ],
        ],
        
    ];

    $sidebarClass = 'agency-user';

    return view('agency.dashboard', compact('sidebarItems', 'sidebarClass'));
}
}