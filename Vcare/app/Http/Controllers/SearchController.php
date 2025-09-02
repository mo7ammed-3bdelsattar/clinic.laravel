<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    public function index()
    {
        return view('site.pages.search');
    }
    public function suggestions(Request $request)
    {

        $q = trim($request->query('query', ''));
        if ($q === '') {
            return response()->json([]);
        }

        $results = User::query()
            ->where('name', 'like', "%{$q}%")
            ->where('type', 3)
            ->orderBy('name')
            ->limit(7)
            ->get(['id', 'name']);
        
        return response()->json($results);
    }
}
