<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use App\Models\Language;
use App\Models\User;
use App\Rules\UniqueCity;
use Auth;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CathController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->languages = Language::all();
        view()->share('languages', $this->languages);
    }

    public function chat($user_id)
    {
        $user = User::find($user_id);
        $chat = Complaint::where('from', $user_id)->orWhere('to', $user_id)->orderBy('id', 'desc')->get();
        return view('admin.content.complaints.show')->with(compact('chat', 'user'));
    }

    public function newChat()
    {
        return view('admin.content.complaints.create');
    }

    public function _newComplaint(Request $req)
    {

        $seller = User::where("name", $req->toUser)->select("id")->first();

        if (!$seller) {
            return redirect()->back()->withErrors("Seller Name Is Not Exist.!")->withInput();
        } else {
            try {
                $complaint = new Complaint();
                $complaint->from = auth()->id();
                $complaint->to = $seller->id;
                $complaint->title = $req->title;
                $complaint->body = $req->body;
                DB::beginTransaction();
                $complaint->save();
                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
                return redirect()->back()->withErrors("error while saving the data, please try again.!")->withInput();
            }
            return redirect()->back()->with("success", "The notification has been successfully sent to {$req->toUser}");
        }
    }

    function getSeller(Request $user)
    {
        $seller = User::where([["name", "like", $user->user . "%"], ["is_seller", 1]])->select("id", "name")->limit(7)->get();
        return $seller;
    }
}

