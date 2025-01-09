<?php

namespace App\Modules\Admin\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\StaffType;

class IndexController extends Controller
{
    public function dashboard(Request $request)
    {
        $data = StaffType::query()->get();

        return view('dashboard',compact('data'));
    }

}
