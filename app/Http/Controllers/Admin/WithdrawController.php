<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Withdraw;

class WithdrawController extends Controller
{

    public function index(\Illuminate\Http\Request $request)
    {
        $withdraws = Withdraw::orderBy('id', 'desc')->get();
        return view('admin.content.withdraws.index', compact('withdraws'));
    }
}
