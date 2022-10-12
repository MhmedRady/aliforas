<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Page;
use App\Models\Translations\PageTranslation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use mysql_xdevapi\Exception;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Facades\DataTables;

use Toaster;

class PagesController extends Controller
{
    public function __construct()
    {
        /* $this->middleware('permission:view_page');
        $this->middleware('permission:create_page', ['only' => ['create','store']]);
        $this->middleware('permission:edit_page', ['only' => ['edit','update']]);
        $this->middleware('permission:delete_page', ['only' => ['destroy']]); */
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index(\Illuminate\Http\Request $request)
    {
        if ($request->ajax() || $request->has('draw')) {
            /** @var EloquentDataTable $DataTables */
            $DataTables = DataTables::of(Page::query()->orderByDesc('id'));

            return created_at_filter($DataTables)
            ->filterColumn('Header', function ($q, $word) {
                $word = strtolower($word);
                $status = null;
                if (Str::contains('visible', $word) || Str::startsWith('v', $word) || Str::startsWith('vi', $word) || Str::startsWith('vis', $word) || Str::startsWith('visi', $word) || Str::startsWith('visib', $word) || Str::startsWith('visibl', $word) || Str::startsWith('visible', $word)) {
                    $status = 1;
                }
                if (Str::contains('visible', $word) || Str::startsWith('i', $word) || Str::startsWith('in', $word) || Str::startsWith('inv', $word) || Str::startsWith('invi', $word) || Str::startsWith('invis', $word) || Str::startsWith('invisi', $word) || Str::startsWith('invisib', $word) || Str::startsWith('invisibl', $word) || Str::startsWith('invisible', $word)) {
                    $status = 0;
                }
                $q->where('show_header', $status);
            })
            ->filterColumn('Footer', function ($q, $word) {
                $word = strtolower($word);
                $status = null;
                if (Str::contains('invisible', $word) || Str::startsWith('i', $word) || Str::startsWith('in', $word) || Str::startsWith('inv', $word) || Str::startsWith('invi', $word) || Str::startsWith('invis', $word) || Str::startsWith('invisi', $word) || Str::startsWith('invisib', $word) || Str::startsWith('invisibl', $word) || Str::startsWith('invisible', $word)) {
                    $status = 0;
                }
                if (Str::contains('visible', $word) || Str::startsWith('v', $word) || Str::startsWith('vi', $word) || Str::startsWith('vis', $word) || Str::startsWith('visi', $word) || Str::startsWith('visib', $word) || Str::startsWith('visibl', $word) || Str::startsWith('visible', $word)) {
                    $status = 1;
                }
                $q->where('show_footer', $status);
            })
            ->filterColumn('Visible', function ($q, $word) {
                $word = strtolower($word);
                $status = null;
                if (Str::contains('invisible', $word) || Str::startsWith('i', $word) || Str::startsWith('in', $word) || Str::startsWith('inv', $word) || Str::startsWith('invi', $word) || Str::startsWith('invis', $word) || Str::startsWith('invisi', $word) || Str::startsWith('invisib', $word) || Str::startsWith('invisibl', $word) || Str::startsWith('invisible', $word)) {
                    $status = 0;
                }
                if (Str::contains('visible', $word) || Str::startsWith('v', $word) || Str::startsWith('vi', $word) || Str::startsWith('vis', $word) || Str::startsWith('visi', $word) || Str::startsWith('visib', $word) || Str::startsWith('visibl', $word) || Str::startsWith('visible', $word)) {
                    $status = 1;
                }
                $q->where('is_active', $status);
            })
            ->filterColumn('name', function ($q, $word) {
                return $q->whereHas('translations', function ($q) use ($word) {
                    $q->where('name', 'like', [(config('datatables.search.smart') === true?'%':'') . "$word%"]);
                });
            })->editColumn('created_at', function (Page $Page) {
                return optional($Page->created_at)->toDayDateTimeString();
            })->addColumn('delete_url', function (Page $page) {
                return route('admin.page.destroy', $page);
            })->addColumn('Header', function (Page $page) {
                return $page->show_header ?
                    '<label class="badge rounded-pill bg-success">Visible</label>' :
                    '<label class="badge rounded-pill bg-danger">InVisible</label>';
            })->addColumn('Footer', function (Page $page) {
                return $page->show_footer ?
                    '<label class="badge rounded-pill bg-success">Visible</label>' :
                    '<label class="badge rounded-pill bg-danger">InVisible</label>';
            })->addColumn('Visible', function (Page $page) {
                return $page->is_active ?
                    '<label class="badge rounded-pill bg-success">Visible</label>' :
                    '<label class="badge rounded-pill bg-danger">InVisible</label>';
            })->addColumn('actions', function (Page $Page) {
                return [
                    ['url'=>route('admin.page.show', $Page->slug), 'icon'=>'eye'],
                    ['url'=>route('admin.page.edit', $Page), 'icon'=>'edit'],
                    [
                        'url' => route('admin.page-activate', $Page->id),
                        'icon' => $Page->is_active ? 'x-circle' : 'check-circle',
                    ],
                ];
            })->only([
                'id', 'name', 'actions', 'created_at', 'Header', 'Footer', 'Visible', 'delete_url', 'update_url'
            ])->rawColumns(['Header', 'Footer', 'Visible'])->make(true);
        }
        return view('admin.content.pages.index');
//        $pages = Page::all();
////        return $pages;
//        return view('admin.content.pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $len = Language::all();
        return view('admin.content.pages.create', compact('len'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $lan = Language::all();
            $page = new Page();
            $page->is_active = $request->get('active') == "on" ? 1 : 0;
            $page->show_footer = $request->get('footer') == "on" ? 1 : 0;
            $page->show_header = $request->get('header') == "on" ? 1 : 0;
            $page->save();
            foreach ($lan as $local) {
                $pageTran = new PageTranslation();
                $pageTran->page_id = $page->id;
                $pageTran->name = $request->get('title_' . $local->locale);
                $pageTran->slug = trim(str_replace(' ', "-", $request->get('title_' . $local->locale)));
                $pageTran->body = $request->get('body_' . $local->locale);
                $pageTran->meta_title = $request->get('meta_title_' . $local->locale);
                $pageTran->meta_keywords = $request->get('meta_keywords_' . $local->locale);
                $pageTran->meta_description = $request->get('meta_description_' . $local->locale);
                $pageTran->locale = $local->locale;
                $pageTran->save();
            }
            DB::commit();
            Toaster::Success('Slider Created Successfully', 'success');
        } catch (\Exception $e) {
            DB::rollBack();
            Toaster::Error('Error While Saving Data Try again Later', 'error');
        }
        return redirect()->back();
//        $logPayload = ['msg' => 'Page Added', 'model_id' => $page->id, 'user_id' => auth()->id()];
//        logToDatabase($logPayload);
//        return ['message' => "The page was added successfully", 'status' => true];
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        try {
            $page = PageTranslation::query()->where([['slug',$slug],['locale',app()->getLocale()]])->first();
            if (!$page) {
                return redirect(404);
            }
        } catch (\Exception $e) {
            return redirect(404);
        }

        return view('root.layouts.custom-page', compact('page'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = Page::find($id);
        $len = Language::all();
//        return $page ;
        return view('admin.content.pages.edit', compact('page', 'len'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $lan = Language::all();
            $page = Page::find($id);
            $page->is_active = $request->get('active') == "on" ? 1 : 0;
            $page->show_footer = $request->get('footer') == "on" ? 1 : 0;
            $page->show_header = $request->get('header') == "on" ? 1 : 0;
            $page->save();

            foreach ($lan as $local) {
                $pageTran = PageTranslation::where(['page_id' => $id, "locale" => $local->locale])->first();
                $pageTran->page_id = $id;
                $pageTran->name = $request->get('title_' . $local->locale);
                $pageTran->slug = trim(str_replace(' ', "-", $request->get('title_' . $local->locale)));
                $pageTran->body = $request->get('body_' . $local->locale);
                $pageTran->meta_title = $request->get('meta_title_' . $local->locale);
                $pageTran->meta_keywords = $request->get('meta_keywords_' . $local->locale);
                $pageTran->meta_description = $request->get('meta_description_' . $local->locale);
                $pageTran->locale = $local->locale;
                $pageTran->save();
            }
            DB::commit();
            Toaster::Success('Slider Created Successfully', 'success');
        } catch (\Exception $e) {
            DB::rollBack();
            Toaster::Error('Error While Saving Data Try again Later', 'error');
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $page = Page::query()->find($id);
            if ($page) {
                DB::beginTransaction();
                PageTranslation::query()->where('page_id', $id)->delete();
                $page->delete();
                DB::commit();
                return response()->json(['success' => true]);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 401);
        }
    }

    public function uploadImage(Request $request)
    {
        if ($request->method() == 'GET') {
            return [];
        }

        $photo = $request->file('file');
        $img_new_name = Str::random();
        $image_extension = $photo->getClientOriginalExtension();

        $path = strtolower("media/pages/" . Str::slug($img_new_name) . "." . $image_extension);
        $image = file_get_contents($photo);
        Storage::put($path, $image);
//        return (new Response(json_encode(['fileName'=>$path , 'uploaded'=>1 , 'url' => $photoPath ]
//            , JSON_PRETTY_PRINT), 200))
//            ->header('Content-Type', 'application/json');
        return [
            "uploaded" => true,
            "default" => url('/' . $path)
        ];
    }

    public function pageActivate($id)
    {
        $page = Page::query()->find($id);
        if ($page) {
            $page->update(['is_active'=>!$page->is_active]);
        }
        return redirect()->route('admin.page.index');
    }
}
