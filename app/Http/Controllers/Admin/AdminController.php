<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Configuration;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $configuration = Configuration::first();
        return view('backend.admin.index', compact('configuration'));
    }
}
