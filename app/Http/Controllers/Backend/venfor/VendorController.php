<?php

namespace App\Http\Controllers\Backend\venfor;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class VendorController extends Controller
{
    public function dashboard(): View
    {
        return view('vendor.dashboard.dashboard');
    }
}
