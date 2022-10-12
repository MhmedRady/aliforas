<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Review;
use App\Rules\UniqueReview;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Facades\DataTables;

class ReviewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    public function __construct()
    {
        $this->languages = Language::all();
        view()->share('languages', $this->languages);
    }

    /**
     * @throws Exception
     */
    public function index(Request $request)
    {
        if ($request->ajax() || $request->has('draw')) {
            /** @var EloquentDataTable $DataTables */
            $DataTables = DataTables::of(Review::query()->orderBy('id'));

            return created_at_filter($DataTables)->editColumn('created_at', function (Review $review) {
                return optional($review->created_at)->toDayDateTimeString();
            })->addColumn('update_url', function (Review $review) {
                return route('admin.reviews.edit', $review);
            })->addColumn('delete_url', function (Review $review) {
                return route('admin.reviews.destroy', $review);
            })->addColumn('options', function (Review $review) {
                $back = '';
                if ($review->approved == 0) {
                    $back .= Form::open(['url' => route('admin.reviews.approve', 'id=' . $review->id), 'class' => 'd-inline', 'onclick' => 'return confirm("Are you sure?")']);
                    $back .= method_field('GET');
                    $back .= Form::submit('Approve', ['class' => 'btn btn-outline-success sa-success']);
                } else {
                    $back .= Form::open(['url' => route('admin.reviews.disapprove', 'id=' . $review->id), 'class' => 'd-inline', 'onclick' => 'return confirm("Are you sure?")']);
                    $back .= method_field('GET');
                    $back .= Form::submit('Refuse', ['class' => 'btn btn-outline-danger sa-warning']);
                }
                $back .= Form::close();
                return $back;
            })->only([
                'id', 'item_id', 'review_title', 'review', 'rate', 'options', 'created_at', 'update_url', 'delete_url',
            ])->rawColumns(['options'])->make(true);
        }
        return view('admin.content.reviews.index');
    }

    public function data($controller = false)
    {

        $reviews = Review::query();
        $product_reviews = Review::query()
            ->select('item_id')
            ->get();


        // if (!\request()->get('length')) {
        //     $reviews->limit(10);
        // }

        if ($controller) {
            $reviews->limit(10)->orderBy('id', 'DESC');
        }


        return DataTables::eloquent($reviews)
            ->addColumn('review_title', function (Review $Review) {
                return $Review->review_title;
            })
            ->addColumn('review', function (Review $Review) {
                return $Review->review;
            })
            ->addColumn('stars', function (Review $Review) {
                return $Review->rate;
            })
            ->addColumn('options', function (Review $Review) {
                $back = '';
                if ($Review->approved == 0) {
                    $back .= Form::open(['url' => route('admin.reviews.approve', 'id=' . $Review->id), 'class' => 'd-inline', 'onclick' => 'return confirm("Are you sure?")']);
                    $back .= method_field('GET');
                    $back .= Form::submit('Approve', ['class' => 'btn btn-outline-success sa-success']);
                    $back .= Form::close();
                } else {
                    $back .= Form::open(['url' => route('admin.reviews.disapprove', 'id=' . $Review->id), 'class' => 'd-inline', 'onclick' => 'return confirm("Are you sure?")']);
                    $back .= method_field('GET');
                    $back .= Form::submit('Refuse', ['class' => 'btn btn-outline-danger sa-warning']);
                    $back .= Form::close();
                }


                return $back;

            })->rawColumns(['options'])
            ->make();
    }

    // public function destroy(Review $Review)
    // {
    //     $Review->delete();
    //     return redirect()->route('admin.reviews.index');
    // }
    public function approve(Review $Review, Request $request)
    {
        $review = Review::find($request->input('id'));
        $review->approved = 1;
        $review->save();
        return redirect()->route('admin.reviews.index');
    }

    public function disapprove(Review $Review, Request $request)
    {
        $review = Review::find($request->input('id'));
        $review->approved = 0;
        $review->save();
        return redirect()->route('admin.reviews.index');
    }
}
