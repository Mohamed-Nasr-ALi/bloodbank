<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::paginate(20);
        return view('Admin.Users.read',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $model)
    {
        return view('Admin.Users.create',compact('model'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
           'name'=>'required|unique:users,name',
           'password'=>'required|confirmed',
           'email'=>'required|unique:users,email|email',
            'roles_list'=>'required'
        ]);
        $request->merge(['password'=>bcrypt($request->password)]);
        $user=User::create($request->except('roles_list'));
        $user->roles()->attach($request->input('roles_list'));
        return redirect(route('users.index'))->with(['msg'=>'add new user success']);
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
        $user=User::findOrFail($id);
        return view('Admin.Users.update',compact('user'));
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
        $this->validate($request,[
            'name'=>'required|unique:users,name,'.$id,
            'password'=>'required|confirmed',
            'email'=>'required|email|unique:users,email,'.$id,
            'roles_list'=>'required'
        ]);
        $user=User::findOrFail($id);
        $user->roles()->sync((array) $request->input('roles_list'));
        $request->merge(['password'=>bcrypt($request->password)]);
        $user->update($request->all());
        return redirect(route('users.index'))->with(['msg'=>'update success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user=User::findOrFail($id);
        $user->delete();
        return redirect(route('users.index'))->with(['msg'=>'delete success']);
    }
}
