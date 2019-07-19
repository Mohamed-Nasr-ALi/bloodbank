<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles=Role::paginate(10);
        return view('Admin.Roles.read')->with(['roles'=>$roles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.Roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules=[
            'name'=>'required|unique:roles,name',
            'permission_list'=>'required|array',
        ];
        $messages=[
            'name.required'=>'الاسم مطلوب',
            'permission_list.required'=>'الصلاحية مطلوبة'
        ];
        $this->validate($request,$rules,$messages);
        $recored=Role::create($request->all());
        $recored->permissions()->attach($request->permission_list);
        return redirect(route('roles.index'))->with('msg', 'saved new Role!');
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
        $role=Role::findOrFail($id);
        return view('Admin.Roles.update')->with(['role'=>$role]);
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
        $rules=[
            'name'=>'required|unique:roles,name,'.$id,
            'permission_list'=>'required|array',
        ];
        $messages=[
            'name.required'=>'الاسم مطلوب',
            'permission_list.required'=>'الصلاحية مطلوبة'
        ];
        $this->validate($request,$rules,$messages);
        $role=Role::findorfail($id);
        $role->update($request->all());
        $role->permissions()->sync($request->permission_list);
        return back()->with('msg', 'update role!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role=Role::findorfail($id);
        $role->destroy($id);
        $role->perms()->sync([]); // Delete relationship data;
        return redirect(route('roles.index'))->with('msg', 'delete done!');
    }
}
