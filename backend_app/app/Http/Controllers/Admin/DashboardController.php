<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function index()
    {

        return view('admin.dashboard');
    }

    public function form()
    {
        return view('admin.form');
    }

    public function checkAdmin()
    {
        return redirect()->to(url()->full().'/login')->send();
    }
}
