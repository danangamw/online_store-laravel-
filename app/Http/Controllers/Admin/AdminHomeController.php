<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminHomeController extends Controller
{
    public function home()
    {
        $viewData = [];
        $viewData['title'] = 'Admin Page - Admin - Online Store';
        return view('admin.index', compact('viewData'));
    }
}
