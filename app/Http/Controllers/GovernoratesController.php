<?php

namespace App\Http\Controllers;

use App\Models\Governorate;
use Illuminate\Http\Request;

class GovernoratesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $governoratz = Governorate::where(function ($governorate) use($request){
            if($request->input('name'))
            {
                $governorate->where('name','like','%'.$request->name.'%');
            }
        })->get();
        return view('Admin.Governorates.read')->with(['governorates'=>$governoratz]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.Governorates.create');
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
            'governorate'=>'required|unique|max:200',
        ]);
        Governorate::create([
            'name' => $request->input('governorate'),
        ]);
        return redirect(route('governorates.index'))->with('msg', 'saved new governorate!');
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
        $governorate=Governorate::findOrFail($id);
        return view('Admin.Governorates.update')->with(['governorate'=>$governorate]);
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
            'governorate'=>'required|unique|max:5',
        ]);
        $governorate=Governorate::findorfail($id);
        $governorate->update([
            'name'=>$request->input('governorate')
        ]);
        return redirect(route('governorates.index'))->with('msg', 'update governorate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $governorate=Governorate::findorfail($id);
        $governorate->destroy($id);
        return redirect(route('governorates.index'))->with('msg', 'delete done!');
    }
}
