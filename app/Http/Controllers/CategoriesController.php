<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categorz = Category::where(function ($category) use($request){
            if($request->input('name'))
            {
                $category->where('name','like','%'.$request->name.'%');
            }
        })->get();

        return view('Admin.Categories.read')->with(['categories'=>$categorz]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.Categories.create');
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
            'category'=>'required|unique|max:255',
        ]);
        Category::create([
            'name' => $request->input('category'),
        ]);
        return redirect(route('categories.index'))->with('msg', 'saved new Category!');
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
        $category=Category::findOrFail($id);
        return view('Admin.Categories.update')->with(['category'=>$category]);
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
            'category'=>'required|unique|max:255',
        ]);
        $category=Category::findorfail($id);
        $category->update([
            'name'=>$request->input('category')
        ]);
        return redirect(route('categories.index'))->with('msg', 'update category!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category=Category::findorfail($id);
        $category->destroy($id);
        return redirect(route('categories.index'))->with('msg', 'delete done!');
    }
}
