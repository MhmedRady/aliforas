<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use App\Models\Country;
use App\Models\Language;
use App\Models\State;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Facades\DataTables;

class ComplaintController extends Controller
{
    public function __construct()
    {
        $this->languages = Language::all();
        view()->share('languages', $this->languages);
    }

    public function index(Request $request)
    {

        if ($request->ajax() || $request->has('draw')) {
            /** @var EloquentDataTable $DataTables */
            $DataTables = DataTables::of(Complaint::query()->orderBy('id'));
            return created_at_filter($DataTables)->editColumn('created_at', function (Complaint $complaint) {
                return optional($complaint->created_at)->toDayDateTimeString();
            })
//                ->addColumn('update_url', function (Complaint $complaint) {
//                return route('admin.complaints.edit', $complaint);
//            })
            ->addColumn('sender', function (Complaint $complaint) {
                return $complaint->sender->name;
            })->addColumn('recipient', function (Complaint $complaint) {
                return $complaint->recipient->name;
            })->addColumn('delete_url', function (Complaint $complaint) {
                return route('admin.complaints.destroy', $complaint);
            })->addColumn('actions', function (Complaint $complaint) {
                return [
                    ['url' => route('admin.complaints.show', $complaint), 'icon' => 'eye'],
                ];
            })->only([
                'id', 'sender', 'recipient', 'created_at', 'delete_url',
            ])->make(true);
        }

        $users = [];
        $complaints = Complaint::all();
        foreach ($complaints as $complaint) {
            if ($complaint->to == Auth::id()) {
                $user = $complaint->from;
            } else {
                $user = $complaint->to;
            }
            if (!in_array($user, $users)) {
                array_push($users, $user);
            }
        }
        $users_obj = User::whereIn('id', $users)->get();
        return view('admin.content.complaints.index')->with(compact('users_obj'));
    }

    public function chat($user_id)
    {
        $user = User::find($user_id);
        $chat = Complaint::where('from', $user_id)->orWhere('to', $user_id)->orderBy('id', 'desc')->get();
        return view('admin.content.complaints.show')->with(compact('chat', 'user'));
    }

    public function data($controller = false)
    {

        $complaints = Complaint::query();

        // if (!\request()->get('length')) {
        //     $complaints->limit(10);
        // }

        if ($controller) {
            $complaints->limit(10)->orderBy('id', 'DESC');
        }

        return DataTables::eloquent($complaints)
            ->addColumn('user', function (Complaint $complaint) {
                if ($complaint->to == Auth::user()->id) {
                    $user = $complaint->get_user($complaint->from)->name;
                } else {
                    $user = $complaint->get_user($complaint->to)->name;
                }
                return $user;
            })
            ->addColumn('options', function (Complaint $complaint) {

                $back = "";
                # $back .= '<a href="'. route('admin.products.show', $product->id) .'" class="btn waves-effect waves-light btn-outline-warning" title="edit">Show</a>';
                $back .= '&nbsp;<a href="' . route('admin.complaints.edit', $complaint->id) . '" class="btn waves-effect waves-light btn-outline-info" title="edit">Edit</a>&nbsp;';

                $back .= Form::open(['url' => route('admin.complaints.destroy', $complaint->id), 'class' => 'd-inline', 'onclick' => 'return confirm("Are you sure?")']);
                $back .= method_field('DELETE');
                $back .= Form::submit('Delete', ['class' => 'btn btn-outline-danger sa-warning']);
                $back .= Form::close();

                return $back;

            })->rawColumns(['options'])
            ->make();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return "create";
        // $dbCity = Complaint::get();
        // $complaints = [];
        // $this->getcomplaints($dbCity, $complaints);
        $countries = Country::all();
        $states = State::all();
        $users = User::all();
        return view('admin.content.complaints.create', compact('countries', 'states', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function chat_store(Request $request)
    {
        $complaint = new Complaint();
        $complaint->from = auth()->id();
        $complaint->to = $request->to;
        $complaint->title = "-";
        $complaint->body = $request->body;
        $complaint->save();
        return redirect()->back();
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'to' => 'required',
            'title' => 'required',
            'body' => 'required'
        ]);

        $complaint = new Complaint();
        $complaint->from = auth()->id();
        $complaint->to = $request->to;
        $complaint->title = "-";
        $complaint->body = $request->body;
        $complaint->save();
        $logPayload = ['msg' => 'Complaints Added', 'model_id' => $complaint->id, 'user_id' => auth()->id()];
        logToDatabase($logPayload);
        return redirect()->back();

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit(Point $complaint, $id)
    {

        $countries = Country::all();
        $states = State::all();
        $row = Complaint::find($id);
        return view('admin.content.complaints.edit', compact('countries', 'states', 'row'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $shipping = Complaint::find($id);

        $this->validate($request, [
            'name' => 'required',
            'fuel' => 'required',
            'post' => 'required',
            'vat' => 'required',
            'cod' => 'required',
        ]);

        $shipping->name = $request->name;
        $shipping->fuel = $request->fuel;
        $shipping->post = $request->post;
        $shipping->vat = $request->vat;
        $shipping->cod = $request->cod;
        $shipping->save();


        $logPayload = ['msg' => 'Company Updated', 'model_id' => $shipping->id, 'user_id' => auth()->id()];
        logToDatabase($logPayload);
        return redirect()->route('admin.complaints.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy(Point $complaint, $id)
    {
        $complaint = Complaint::find($id);
        $complaint->delete();
        return redirect()->route('admin.complaints.index');
    }
}

