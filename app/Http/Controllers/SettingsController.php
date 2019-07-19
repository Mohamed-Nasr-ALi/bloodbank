<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Admin.Settings.read');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       // return view('Admin.Settings.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        $request->validate([
//            'phone'=>'required|max:11|unique:settings,phone',
//            'email'=>'required|email|unique:settings,email',
//            'about_app'=>'required|max:200',
//            'fb_link'=>'required|url',
//            'tw_link'=>'required|url',
//            'tub_link'=>'required|url',
//            'insta_link'=>'required|url',
//            'whatsapp_link'=>'required|url',
//        ]);
//        Setting::create([
//            'phone' => $request->input('phone'),
//            'email' => $request->input('email'),
//            'about_app' => $request->input('about_app'),
//            'fb_link' => $request->input('fb_link'),
//            'tw_link' => $request->input('tw_link'),
//            'tub_link' => $request->input('tub_link'),
//            'insta_link' => $request->input('insta_link'),
//            'whatsapp_link' => $request->input('whatsapp_link'),
//        ]);
//        return redirect(route('settings.index'))->with('msg', 'saved new Setting!');
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
        $setting=Setting::findOrFail($id);
        return view('Admin.Settings.update')->with(['setting'=>$setting]);
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
        $setting=Setting::findorfail($id);
        $request->validate([
            'phone'=>'required|max:11|unique:settings,phone,'.$setting->id,
            'email'=>'required|email|unique:settings,email,'.$setting->id,
            'about_app'=>'required|max:200',
            'fb_link'=>'required|url',
            'tw_link'=>'required|url',
            'tub_link'=>'required|url',
            'insta_link'=>'required|url',
            'whatsapp_link'=>'required|url',
        ]);
        $setting->update([
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'about_app' => $request->input('about_app'),
            'fb_link' => $request->input('fb_link'),
            'tw_link' => $request->input('tw_link'),
            'tub_link' => $request->input('tub_link'),
            'insta_link' => $request->input('insta_link'),
            'whatsapp_link' => $request->input('whatsapp_link'),
        ]);
        return redirect(route('settings.index'))->with('msg', 'update setting!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
