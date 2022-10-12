<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use App\Models\Seller\Branch;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Facades\DataTables;

class ComplaintController extends Controller
{

    const VIEW = "seller.content.complaints.";

    public function index(Request $request)
    {

        if ($request->ajax() || $request->has('draw')) {
            /** @var EloquentDataTable $DataTables */
            $DataTables = DataTables::of(Complaint::query()->where('to', \auth()->id())->groupBy('from')->orderByDesc('created_at'));
            return created_at_filter($DataTables)
//                ->addColumn('update_url', function (Complaint $complaint) {
//                return route('admin.complaints.edit', $complaint);
//            })
                ->addColumn('sender', function (Complaint $complaint) {
                    return $complaint->sender->name;
                })->addColumn('recipient', function (Complaint $complaint) {
                    return $complaint->recipient->name;
                })
//                ->addColumn('delete_url', function (Complaint $complaint) {
//                    return route('seller.complaints.destroy', $complaint);
//                })
                ->addColumn('created_at', function (Complaint $complaint) {
                    return $complaint->created_at;
                })->addColumn('actions', function (Complaint $complaint) {
                    return [
                        ['url' => route('seller.complaints.show', $complaint->from == \auth()->id()?$complaint->to:$complaint->from), 'icon' => 'message-circle'],
                    ];
                })->only([
                    'id', 'sender', 'recipient', 'created_at', 'actions',
                ])->make(true);
        }
        $withoutCreated = true;
        return view(self::VIEW.".index", compact('withoutCreated'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string',
            'body' => 'required|string',
        ],[
            'title.required' => __('auth.error_Emp', ['var'=>__('layouts.msgTitle')]),
            'body.required' => __('auth.error_Emp', ['var'=>__('layouts.msgBody')]),
        ]);

        try {
            DB::beginTransaction();
            Complaint::query()->create([
                'from' => auth()->id(),
                'to' => $request->input('user_id'),
                'title' => $request->input('title'),
                'body' => $request->input('body'),
            ]);
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
//     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show($id)
    {
//        return $id;
//        return Complaint::query()->where('to', \auth()->id())->count();
        $user = \auth()->user();
//        return $user->id. '   ' . $id;
        $from = Complaint::query()->where('to' , $user->id)->where('from' , $id)->get();
        $to = Complaint::query()->where('from' , $user->id)->where('to' , $id)->get();
        $from->where('seller_read', false)->map(function ($item){
            $item->update(['seller_read' => true]);
        });
        $messages = $to->merge($from)->sortBy('id', SORT_REGULAR, false);
//        $messages = DB::select("SELECT * from complaints WHERE `to` = 3 and `from` = 2 OR `to` = 2 and `from` = 3");
        return view(self::VIEW.'show', compact('messages', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $msg = Complaint::query()->where('from', auth()->guard('seller')->id())->find($id);

            try {
                if ($msg):
                    DB::beginTransaction();
                        $msg->delete();
                    DB::commit();
                    return response()->json(true);
                endif;
            }catch (\Exception $e){
                DB::rollBack();
            }

            return response()->json(false);

    }
}
