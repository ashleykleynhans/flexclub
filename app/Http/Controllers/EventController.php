<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Event Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handing the /events API endpoints
    |
    */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function searchEvents(Request $request)
    {
        $venue_uuid = trim($request->input('venue_uuid'));
        $category_uuid = trim($request->input('category_uuid'));
        $start_date = trim($request->input('start_date'));

        // Validation
        if ($venue_uuid && !is_numeric($venue_uuid)) {
            return response()->json([
                'error' => 'Invalid venue_uuid provided',
            ], 400, ['Content-Type' => 'application/json']);
        }

        if ($category_uuid && !is_numeric($category_uuid)) {
            return response()->json([
                'error' => 'Invalid category_uuid provided',
            ], 400);
        }

        if ($start_date && !preg_match('/^\d{4}(-\d{2}){2}T\d{2}(:\d{2}){2}$/', $start_date)) {
            return response()->json([
                'error' => 'Invalid start_date provided',
            ], 400);
        }

        $query = DB::table('events');

        if ($venue_uuid) {
            $query->where('venue_id', $venue_uuid);
        }

        if ($category_uuid) {
            $query->where('category_id', $category_uuid);
        }

        if ($start_date) {
            $query->where('started_at', '>=', \Carbon\Carbon::parse($start_date)->format('Y-m-d H:i:s'));
        }

        $events = $query->get();

        if ($events->count()) {
            return response()->json([
                json_encode($events)
            ], 200);
        } else {
            return response()->json([
                'error' => 'No events found matching the provided criteria.',
            ], 404);
        }
    }
}
