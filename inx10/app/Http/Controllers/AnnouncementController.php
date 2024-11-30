<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Log;

class AnnouncementController extends Controller
{

    
     /**
 * @SuppressWarnings(PHPMD.StaticAccess)
 */
public function getAnnouncements()
{
    try {
        // Fetch the latest announcements, limit the number if needed
        $announcements = Announcement::orderBy('date', 'desc')->take(4)->get();


        // Return the announcements as a JSON response
        return response()->json(['announcements' => $announcements]);
    } catch (\Exception $e) {
        Log::error('Error fetching announcements: ' . $e->getMessage());
        return response()->json(['announcements' => []], 500); // Return an empty array on error
    }
}

 /**
 * @SuppressWarnings(PHPMD.StaticAccess)
 */
public function getAllAnnouncements()
{
    try {
        // Fetch all announcements
        $announcements = Announcement::with('employee')->orderBy('date', 'desc')->get();

        // Return the announcements as a JSON response
        return response()->json(['announcements' => $announcements]);
    } catch (\Exception $e) {
        Log::error('Error fetching all announcements: ' . $e->getMessage());
        return response()->json(['announcements' => []], 500); // Return an empty array on error
    }
}
 /**
 * @SuppressWarnings(PHPMD.StaticAccess)
 */

 public function getAnnouncementsForEmployees()
{
    try {
        // Fetch latest announcements, you can limit if necessary
        $announcements = Announcement::orderBy('date', 'desc')->take(7)->get();

        return response()->json(['announcements' => $announcements]);
    } catch (\Exception $e) {
        Log::error('Error fetching announcements: ' . $e->getMessage());
        return response()->json(['announcements' => []], 500);
    }
}
    /**
 * @SuppressWarnings(PHPMD.StaticAccess)
 */
    public function store(Request $request)
    {
        $request->validate([
            'announce_subject' => 'required|max:100',
            'announce_body' => 'required',
        ]);
        // Set employee_ID to 1 for HR and Admin announcements
    $employeeID = 1; // Assuming the ID for HR and Admin is always 1

    // Create the announcement
    Announcement::create([
        'employee_ID' => $employeeID, // Set to 1 for HR and Admin
        'announce_subject' => $request->announce_subject,
        'announce_body' => $request->announce_body,
        'date' => now(),
    ]);

    return redirect()->back()->with('success', 'Announcement posted successfully!');

    }
}
