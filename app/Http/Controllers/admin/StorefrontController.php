<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StorefrontController extends Controller
{
    public function StorefrontPage()
    {
        return view('admin.storefront');
    }
}
