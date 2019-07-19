<?php

namespace App\Http\Controllers\Api;

use App\Models\BloodType;
use App\Models\Category;
use App\Models\City;
use App\Models\Contact;
use App\Models\Governorate;
use App\Models\Order;
use App\Models\Post;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactUs;
use App\Models\Token;

use Illuminate\Contracts\Auth\User;

use Illuminate\Database\Eloquent\Relations\Pivot;
class MainController extends Controller
{
    ////////////////governorates/////////////////
    public function governorates(){
        $governorates= Governorate::all();
        return responseJson(1,'success',$governorates);
    }
    //////////////////cities///////////////
    public function cities()
    {
        $cities = City::all();
        return responseJson(1, 'success', $cities);
    }

    //////////////////settings//////////////////
    public function settings(){
        $settings=Setting::first();
        return responseJson('1','success',$settings);
    }

    //==========================================================================//
    /////////////////// Categories //////////////////
    public function categories()
    {
        $categories = Category::all();
        return responseJson(1, 'success', $categories);
    }
    /////////////////////////////////////////////////////////
    public function getPosts(Request $request){
        $posts = Post::with('category')->where(function ($post) use($request){
            if($request->input('category_id'))
            {
                $post->where('category_id',$request->category_id);
            }
            if($request->input('keyword'))
            {
                $post->where(function ($post)use($request){

                });
                $post->where('title','like','%'.$request->keyword.'%');
                $post->orWhere('body','like','%'.$request->keyword.'%');

            }
        })->get();
        return responseJson('1','success',$posts);
    }

    //////////////////////////posts/////////////////////////////
    public function posts(){
        $posts= Post::latest('id')->paginate(5);
        return responseJson(1,'success',$posts);
    }
    //////////////////////////post/////////////////////////////
    public function post($id){
        $posts= Post::find($id);
        return responseJson(1,'success',$posts);
    }


    //=========================================================================//
    ///////////////////clientfavoratePost/////////////////////////
    public function clientfavPost(Request $request){
        $validator = validator()->make($request->all(),[
            'post_id' =>'required|exists:posts,id',

        ]);
        if($validator->fails())
        {
            $data = $validator->errors();
            return responseJson('0',$validator->errors()->first(),$data);
        }
        $toggle = $request->user()->posts()->toggle($request->post_id);
        return responseJson('1','success',$toggle);

    }

    ///////////////////listOfFavourites//////////////////////////////
    public function listOfFavourites(Request $request){
        //by api_token user will get all his fav posts for this user
        $favourites = $request->user()->posts()->with('category')->latest()->paginate(20);
        return responseJson(1, 'success', $favourites);
    }
    //=============================================================================//

    ///////////////////////////contactUs//////////////////////////////
    public function contactUS(Request $request){
        $validator = validator()->make($request->all(),[
            'phone'=>'required',
            'name'=>'required',
            'email'=>'required',
            'subject'=>'required|max:100',
            'message'=>'required|min:3|max:1000',
            'api_token'=>'required'
        ]);
        if($validator->fails()) {
            return responseJson(0, $validator->errors()->first(), $validator->errors());
        }
        $user = $request->user();
        if($user)
        {
            $contact=Contact::create($request->all());
            if ($contact){
                Mail::to("mohamednasrali101293@gmail.com")
                    ->send(new ContactUs($contact));
                return responseJson(1, 'برجاء فحص البريد الالكتروني',
                    [
                        'msg' => $request->message,
                        'mail_fails' => Mail::failures(),
                        'email' => $contact->email,
                    ]);
            }else{
                return responseJson(0,  'حدث خطأ , حاول مرة أخرى');
            }
        } else {
        return responseJson(0,  'لا يوجد حساب مثل هذا لدينا');
        }
    }

    //=====================================================================//
    ///////////////////////////bloodTypes//////////////////////////
    public function bloodTypes(){
        $bloodTypes= BloodType::all();
        return responseJson(1,'success',$bloodTypes);
    }

    //=======================================================================//
    //////////////////////////////createOrderRequest//////////////////////////////
    public function createOrderRequest(Request $request)
    {
        $validator = validator()->make($request->all(),[
                'patient_name' => 'required',
                'patient_age' => 'required',
                'blood_type_id' => 'required',
                'quantity' => 'required',
                'hospital_address' => 'required',
                'city_id' => 'required',
                'notes' => 'required',
                'phone' => 'required',
                'hospital_name'=>'required',
                'latitude'=>'required',
                'longitude'=>'required'
            ]
        );
        if($validator->fails())
        {
            return responseJson(0, $validator->errors()->first(), $validator->errors());
        }
        $orderRequest = $request->user()->orders()->create($request->all());

        $clientsIds = $orderRequest->city->governorate->clientnotifications()
            ->whereHas('BloodTypes',function($q)use($request,$orderRequest){
                $q->where('blood_type_client.blood_type_id',$orderRequest->blood_type_id);

            })->pluck('clients.id')->toArray();

        // Create A Notification
        if(count($clientsIds)){
            $bloodes=BloodType::where('id',$orderRequest->blood_type_id)->first();
            $notification = $orderRequest->notification()->create([
                'title' => 'احتاج متبرع لفصيلة ',
                'content' => $request->hospital_address .' في العنوان التالي :'. $bloodes->name . 'محتاج متبرع لفصيلة ',
                'order_id'=> $orderRequest->id,
            ]);
            // Attach Clients To This Notification
            $notification->clients()->attach($clientsIds);
            $tokens = Token::whereIn('client_id',$clientsIds)->where('token','!=',null)->pluck('token')->toArray();
            if(count($tokens)){
                {

                    $title = $notification->title;
                    $content = $notification->content;
                    $data = [
                        'order_id' => $orderRequest->id
                    ];
                    $send = notifyByFirebase($title,$content,$tokens,$data);
                    info("firebase result: ". $send);

                }
            }

            return responsejson(1, 'add ok' , $orderRequest);
        }
    }

    //////////////////////// Notifications /////////////////////////////
    public function notifications(Request $request)
    {
        $notifications = $request->user()->notifications()->latest()->paginate(10);
        return responseJson(1, 'loaded', $notifications);
    }
    ///////////////////////////NotificationsCount/////////////////////////////////
    public function notificationsCount(Request $request)
    {
        $count = $request->user()->notifications()->where(function($query) use ($request){
            $query->where('is_read','0');
        })->count();
        return responseJson('1','done',[
            'notifications-count' => $count,
        ]);
    }
    ////////////////////////////updateNotification////////////////////////////////
    public function updateNotification(Request $request){
        $order=Order::with('city','client','bloodtype')->find($request->donation_id);
        if (!$order){
            return responseJson(0,'404 no order found');
        }
        if ($request->user()->notifications()->where('notification_id',$order->id)->first()){
            $request->user()->notifications()->updateExistingPivot($order->notification->id,['is_read'=>1]);
        }
        return responseJson(1,'success',$order);
    }

    //////////////////////// all orders /////////////////////////////
    public function allOrdersBySpecific(Request $request){

        $allOrders = Order::where(function($query)use ($request){
            //with cat_id
            if($request->input('governorate_id')){
                $query->whereHas('city',function($query)use ($request){
                    $query->where('governorate_id',$request->governorate_id);
                });
                //with city_id
            }elseif($request->input('city_id')){
                $query->where('city_id',$request->city_id);
            }
            //with blood_type_id
            if($request->input('blood_type_id')){
                $query->where('blood_type_id',$request->blood_type_id);
            }
            //retrive all data belongs to this query
            //city,client,bloodtype are function in order model
        })->with('city','client','bloodtype')->latest()->paginate(10);

        return responseJson(1, 'success', $allOrders);
    }
    //////////////////////// specific order with details /////////////////////////////
    public function specificOrder($id){
        $order=Order::findorfail($id);
        return responseJson(1,'success',$order);
    }

}
