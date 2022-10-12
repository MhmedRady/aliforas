<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rlogger;

class LogsController extends Controller
{
    public function index(\Illuminate\Http\Request $request)
    {
        $logs = Rlogger::orderBy('created_at', 'desc')->get();
        $data = ['rows' => $logs];
        return view('admin.content.logs.index')->with($data);
    }
}
