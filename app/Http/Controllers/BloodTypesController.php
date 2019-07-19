<?php

namespace App\Http\Controllers;

use App\Models\BloodType;
use Illuminate\Http\Request;

class BloodTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $bloodtypez = BloodType::where(function ($bloodtype) use($request){
            if($request->input('name'))
            {
                $bloodtype->where('name','like','%'.$request->name.'%');
            }
        })->get();

        return view('Admin.BloodTypes.read')->with(['bloodtypes'=>$bloodtypez]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.BloodTypes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'bloodtype'=>'required|unique|max:5',
        ]);
         BloodType::create([
            'name' => $request->input('bloodtype'),
        ]);
        return redirect(route('blood-type.index'))->with('msg', 'saved new bloodtype!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bloodtype=BloodType::findOrFail($id);
        return view('Admin.BloodTypes.update')->with(['bloodtype'=>$bloodtype]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'bloodtype'=>'required|unique|max:5',
        ]);
        $bloodtype=BloodType::findorfail($id);
        $bloodtype->update([
            'name'=>$request->input('bloodtype')
        ]);
        return redirect(route('blood-type.index'))->with('msg', 'update bloodtype!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bloodtype=BloodType::findorfail($id);
        $bloodtype->destroy($id);
        return redirect(route('blood-type.index'))->with('msg', 'delete done!');
    }
}
