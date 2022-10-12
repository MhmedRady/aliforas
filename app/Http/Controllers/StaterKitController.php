<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaterKitController extends Controller
{
    // home
    public function home()
    {
        $breadcrumbs = [
            ['link' => "home", 'name' => "Home"], ['name' => "Index"]
        ];
        return view('admin.content.home', ['breadcrumbs' => $breadcrumbs]);
    }

    // Layout collapsed menu
    public function collapsed_menu()
    {
        $pageConfigs = ['sidebarCollapsed' => true];
        $breadcrumbs = [
            ['link' => "home", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Layouts"], ['name' => "Collapsed menu"]
        ];
        return view('admin.content.layout-collapsed-menu', ['breadcrumbs' => $breadcrumbs, 'pageConfigs' => $pageConfigs]);
    }

    // layout boxed
    public function layout_full()
    {
        $pageConfigs = ['layoutWidth' => 'full'];

        $breadcrumbs = [
            ['link' => "home", 'name' => "Home"], ['name' => "Layouts"], ['name' => "Layout Full"]
        ];
        return view('admin.content.layout-full', ['pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs]);
    }

    // without menu
    public function without_menu()
    {
        $pageConfigs = ['showMenu' => false];
        $breadcrumbs = [
            ['link' => "home", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Layouts"], ['name' => "Layout without menu"]
        ];
        return view('admin.content.layout-without-menu', ['breadcrumbs' => $breadcrumbs, 'pageConfigs' => $pageConfigs]);
    }

    // Empty Layout
    public function layout_empty()
    {
        $breadcrumbs = [['link' => "home", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Layouts"], ['name' => "Layout Empty"]];
        return view('admin.content.layout-empty', ['breadcrumbs' => $breadcrumbs]);
    }

    // Blank Layout
    public function layout_blank()
    {
        $pageConfigs = ['blankPage' => true];
        return view('admin.content.layout-blank', ['pageConfigs' => $pageConfigs]);
    }
}
