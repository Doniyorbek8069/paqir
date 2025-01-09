<?php

namespace App\Modules\Admin\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Staff;
use App\Models\StaffType;
use App\Models\Table;

class StaffController extends Controller
{
    public function index(Request $request)
    {
        $staffes = Staff::query();
        if($request->type_id != ""){
            $staffes = $staffes->where('type_id','=',$request->type_id);
        }
        $staffes = $staffes->get();
        $types = StaffType::query()->get();

        return view('people.index',compact('staffes','types'));
    }

    public function types(Request $request)
    {
        $types = StaffType::query()->get();
        
        return view('people.types',compact('types'));
    }

    public function typestore(Request $request)
    {
        StaffType::query()->create([
            'name'  => $request->name,
        ]);

        return redirect()->back();
    }

    public function typeupdate(Request $request,StaffType $type)
    {
        StaffType::query()->where('id','=',$type->id)->update([
            'name'  => $request->name,
        ]);

        return redirect()->back();
    }

    public function store(Request $request)
    {
        $staff = Staff::query()->create([
            'name'          => $request->name,
            'type_id'       => $request->type_id,
            'balance'       => $request->balance,
            'tg_chat_id'    => $request->tg_chat_id ?? NULL
        ]);

        Table::query()->create([
            'custom_id' => $staff->id,
            'input'     => 0,
            'output'    => 0,
            'debt'      => $request->balance,
            'type'      => Table::START,
            'object_id' => 0,
            'date'      => date('Y-m-d'),
            'comment'   => NULL
        ]);
        return redirect()->back();
    }

    public function update(Request $request,Staff $staff)
    {
        Staff::query()->where('id','=',$staff->id)->update([
            'name'  => $request->name,
            'type_id'   => $request->type_id,
            'tg_chat_id'    => $request->tg_chat_id ?? NULL
        ]);

        return redirect()->back();
    }
}
