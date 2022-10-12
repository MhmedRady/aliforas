<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ContactUsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax() || $request->has('draw')) {
            /** @var EloquentDataTable $DataTables */
            $DataTables = DataTables::of(Contact::query()->orderByDesc('id'));

            return created_at_filter($DataTables)
            ->editColumn('created_at', function (Contact $Contact) {
                return optional($Contact->created_at)->toDayDateTimeString();
            })->addColumn('delete_url', function (Contact $Contact) {
                return route('admin.contact-messages.destroy', $Contact);
            })->editColumn('email', function (Contact $Contact) {
                return $Contact->email;
            })->editColumn('phone', function (Contact $Contact) {
                return $Contact->phone;
            })->editColumn('actions', function (Contact $Contact) {
                return [
                    ['url'=>route('admin.contact-messages.show', $Contact), 'icon'=>'eye'],
                ];
            })->only([
                'id', 'name', 'email', 'phone', 'delete_url', 'created_at','actions'
            ])->make(true);
        }
        return view('admin.content.contactUs.index');
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $message = Contact::query()->findOrFail($id);
        return view('admin.content.contactUs.show', compact('message'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
        $message = Contact::query()->find($id);
        if ($message) {
            try {
                DB::beginTransaction();
                $message->delete();
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
            }
            return redirect()->route('admin.contact-messages.index');
        }
    }
}
