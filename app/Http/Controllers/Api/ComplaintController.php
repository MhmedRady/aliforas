<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiHelpers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ComplaintRequest;
use App\Http\Resources\ComplaintResource;
use App\Models\Complaint;
use App\Models\Seller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ComplaintController extends Controller
{

    public function index(Request $request) {

//        return Complaint::query()->where('from', auth()->id())->groupBy(['from'])->orderByDesc('created_at')->get();

        $messages = Complaint::query()->where('from', \auth()->id())->orWhere(['to' => auth()->id()])->groupBy(['to', 'from'])->orderByDesc('created_at')->get();
        return ApiHelpers::apiResponse('success', ComplaintResource::collection($messages));
    }

    public function show(Request $request){
        $seller = $request->get('seller', 0);
        $user = \auth()->user();
        $from = Complaint::query()->where('to' , $user->id)->where('from' , $seller)->get();
        $to = Complaint::query()->where('from' , $user->id)->where('to' , $seller)->get();
        $messages = $to->merge($from)->sortBy('id', SORT_REGULAR, false);
        return ApiHelpers::apiResponse('success', ComplaintResource::collection($messages));
    }

    public function store(ComplaintRequest $request)
    {
        try {
            DB::beginTransaction();
            $msg = Complaint::query()->create([
                'from' => auth()->id(),
                'to' => $request->input('seller_id'),
                'title' => $request->input('title'),
                'body' => $request->input('body'),
            ]);
            DB::commit();
            return ApiHelpers::apiResponse('success', new ComplaintResource($msg));
        }catch (\Exception $e){
            DB::rollBack();
        }
        return ApiHelpers::apiResponse('error', 'error while saving data try again');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $msg = Complaint::query()->where('from', auth()->id())->find($id);
        try {
            if ($msg):
                DB::beginTransaction();
                    $msg->delete();
                DB::commit();
                return ApiHelpers::apiResponse('success',[], 'The message has been deleted successfully!');
            endif;
        }catch (\Exception $e){
            DB::rollBack();
        }
        return ApiHelpers::apiResponse('error',[], "Sorry Can't Deleted this Message!");
    }
}
