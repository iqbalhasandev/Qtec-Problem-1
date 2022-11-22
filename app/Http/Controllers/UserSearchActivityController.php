<?php

namespace App\Http\Controllers;

use App\Models\User;
use Hamcrest\Arrays\IsArray;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\UserSearchActivity;

class UserSearchActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collections = UserSearchActivity::all();
        return \view('search-activity.index', ['collections' => $collections]);
    }


    public function getActivities(Request $request)
    {
        $userSearchActivity = new UserSearchActivity();
        // Search by date range
        if ($request->has('date_range') && \is_array($request->date_range)) {
            if (\in_array('last_month', $request->date_range)) {
                $userSearchActivity = $userSearchActivity->whereDate('created_at', '>=', date('Y-m-d', strtotime('-30 days')));
            } elseif (\in_array('last_week', $request->date_range)) {
                $userSearchActivity = $userSearchActivity->whereDate('created_at', '>=', date('Y-m-d', strtotime('-7 days')));
            } elseif (\in_array('today', $request->date_range)) {
                $userSearchActivity = $userSearchActivity->whereDate('created_at', date('Y-m-d'));
            } elseif (\in_array('yesterday', $request->date_range)) {
                $userSearchActivity = $userSearchActivity->whereDate('created_at', date('Y-m-d', strtotime('-1 days')));
            }
        }
        // Search by user
        if ($request->has('users')) $userSearchActivity = $userSearchActivity->whereIn('user_id', $request->users);
        // Search by keyword
        if ($request->has('keywords'))  $userSearchActivity = $userSearchActivity->whereIn('search_term', $request->keywords);
        // Search by Start Date
        if ($request->has('start_date')) {
            $userSearchActivity = $userSearchActivity->whereDate('created_at', '<=', Carbon::make($request->start_date));
        }
        // Search by End Date
        if ($request->has('end_date'))  $userSearchActivity = $userSearchActivity->whereDate('created_at', '>=', Carbon::make($request->end_date));
        // Get Filter Data
        $collections = $userSearchActivity->get();
        // Return Response
        return \response()->json($collections);
    }

    public function filters()
    {
        $filters = [];
        // get all repeated search terms
        $filters['keywords'] = UserSearchActivity::select('search_term')
            ->selectRaw('count(search_term) as count')
            ->groupBy('search_term')
            ->orderBy('count', 'DESC')
            ->get();
        // get all User
        $filters['users'] = User::all();
        // return response
        return \response()->json($filters);
    }
}
