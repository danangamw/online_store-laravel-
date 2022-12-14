<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $viewData = [];
        $viewData['title'] = 'Home Page - Online Store';
        return view('home.index', compact('viewData'));
    }

    public function about()
    {
        $viewData = [];
        $viewData['title'] = 'About us - Online Store';
        $viewData['subtitle'] = 'About Us';
        $viewData['description'] = 'This is an about page';
        $viewData['author'] = 'Developed by me';
        return view('home.about', compact('viewData'));
    }
}
