<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
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
        if ($request->has('time_range')) {
            if ($request->time_range == 'today') {
                $collections = $userSearchActivity->whereDate('created_at', date('Y-m-d'));
            } elseif ($request->time_range == 'yesterday') {
                $collections = $userSearchActivity->whereDate('created_at', date('Y-m-d', strtotime('-1 days')));
            } elseif ($request->time_range == 'last_7_days') {
                $collections = $userSearchActivity->whereDate('created_at', '>=', date('Y-m-d', strtotime('-7 days')));
            } elseif ($request->time_range == 'last_30_days') {
                $collections = $userSearchActivity->whereDate('created_at', '>=', date('Y-m-d', strtotime('-30 days')));
            }
        }

        if ($request->has('user_ids')) $collections = $userSearchActivity->whereIn('user_id', $request->user_ids);
        if ($request->has('keywords')) $collections = $userSearchActivity->whereIn('search_term', $request->keywords);

        if ($request->has('start_date')) {
            $collections = $userSearchActivity->whereDate('created_at', '>=', $request->start_date);
        }
        if ($request->has('end_date')) {
            $collections = $userSearchActivity->whereDate('created_at', '<=', $request->end_date);
        }
        $collections = $userSearchActivity->get();
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
