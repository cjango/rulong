<?php

namespace RuLong\Panel\Controllers;

use Illuminate\Http\Request;
use RuLong\Panel\Models\AdminOperationLog;

class LogController extends Controller
{

    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $logs = AdminOperationLog::when($keyword, function ($query) use ($keyword) {
            return $query->whereHas('user', function ($query) use ($keyword) {
                return $query->where('username', $keyword);
            });
        })->with('admin')->orderBy('id', 'desc')->paginate();
        return view('RuLong::logs.index', compact('logs'));
    }
}
