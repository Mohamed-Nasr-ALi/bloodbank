<?php

namespace App\Http\Controllers;


use App\Models\BloodType;
use App\Models\City;
use App\Models\Client;
use App\Models\Contact;
use App\Models\Order;
use App\Models\Post;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function contacts(Request $request)
    {
        $contactz = Contact::where(function ($contact) use($request){

            if($request->input('keyword')) {

                $contact->where(function ($contact)use($request){
                    $contact->where('email','like','%'.$request->keyword.'%');
                    $contact->orWhere('phone','like','%'.$request->keyword.'%');
                });

            }

        })->latest()->paginate(20);

        return view('Admin.Contacts.read')->with(['contacts'=>$contactz]);
    }
    public function clients(Request $request)
    {
        $clients = Client::with('cities')->where(function ($client) use($request){
            if($request->input('city_id'))
            {
                $client->where('city_id',$request->city_id);
            }
            if($request->input('keyword')) {

                    $client->where('phone','like','%'.$request->keyword.'%');
                    $client->orWhere('name','like','%'.$request->keyword.'%');

            }
        })->latest()->paginate(20);

        return view('Admin.Clients.read')->with(['clients'=>$clients]);
    }

    public function clientUpdateStatus($id){

        $client=Client::findOrFail($id);
        $msg="تم التفعيل";
        if ($client->is_active){
            $msg="تم الغاءالتفعيل";
            $client->update(['is_active'=>0]);
        }else{
            $client->update(['is_active'=>1]);
        }

        return back()->with(['msg'=> $msg]);
    }
    public function orders(Request $request)
    {
        $orders = Order::with('city')->where(function ($order) use($request){
            if ($request->input('keyword') && $request->action =="all"){
                $order->where('patient_name','like','%'.$request->keyword.'%');
                $order->orWhere('phone','like','%'.$request->keyword.'%');
            }elseif ($request->input('city_id'))
            {
                $order->where('city_id',$request->city_id);
            }

            if($request->input('keyword')&& $request->action =="") {

                $order->where(function ($order) use ($request) {
                    $order->where('patient_name', 'like', '%' . $request->keyword . '%');
                    $order->orWhere('phone', 'like', '%' . $request->keyword . '%');
                });
            }
        })->latest()->paginate(10);
        return view('Admin.Orders.read')->with(['orders'=>$orders]);
    }




}
