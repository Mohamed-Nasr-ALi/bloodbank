<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Governorate;
use Illuminate\Http\Request;

class CitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cities = City::where(function ($q) use ($request) {

            return $q->when($request->name, function ($query) use ($request) {

                return $query->where('name', 'like', '%' . $request->name . '%');

            });

        })->paginate(10);
        return view('Admin.Cities.read')->with(['cities'=>$cities]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.Cities.create');
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
            'city'=>'required|unique|max:200',
            'governorate'=>'required|numeric'
        ]);
        City::create([
            'name' => $request->input('city'),
            'governorate_id'=>$request->input('governorate')
        ]);
        return redirect(route('cities.index'))->with('msg', 'saved new city!');
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
        $city=City::findOrFail($id);
        return view('Admin.Cities.update')->with(['city'=>$city]);
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
            'city'=>'required|unique|max:200',
            'governorate_id'=>'required|numeric'
        ]);
        $city=City::where('id',$id)->first();
        $city->update([
            'name'=>$request->input('city'),
            'governorate_id'=>$request->input('governorate_id')
        ]);
        return redirect(route('cities.index'))->with('msg', 'update city!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $city=City::findorfail($id);
        $city->destroy($id);
        return redirect(route('cities.index'))->with('msg', 'delete done!');
    }
}
