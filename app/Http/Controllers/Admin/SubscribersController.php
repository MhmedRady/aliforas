<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminUsersRequest;
use App\Jobs\SendOffersEmail;
use App\Models\Subscribers;
use Illuminate\Http\Request;
use Mail;

class SubscribersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {

        /* $this->middleware('permission:view_admin');
        $this->middleware('permission:create_admin', ['only' => ['create','store']]);
        $this->middleware('permission:edit_admin', ['only' => ['edit','update']]);
        $this->middleware('permission:delete_admin', ['only' => ['destroy']]); */

    }

    public function index(\Illuminate\Http\Request $request)
    {
        $subscribers = Subscribers::all();
        $data = ['rows' => $subscribers];
        return view('admin.content.subscribers.index')->with($data);
    }

    public function sendProductsOffers()
    {
        $subscribers = Subscribers::all()->pluck('email');
        foreach ($subscribers as $subscriber) {
            dispatch(new SendOffersEmail($subscriber));
        }
        return back()->with('success', 'تم ارسال العروض لجميع المشاركين');
    }

    public function create()
    {

    }


    public function store(AdminUsersRequest $request)
    {

    }

    public function show($id)
    {

    }

    public function edit($id)
    {

    }

    public function update(Request $request, $id)
    {

    }

    public function destroy($id)
    {

    }
}
