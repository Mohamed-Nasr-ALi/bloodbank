<?php

namespace App\Http\Controllers\Api;

use App\Models\Client;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPassword;
use App\Models\Token;
class AuthController extends Controller
{
    /////////////////////////register////////////////////////////////
    public function register(Request $request){
        $validator= validator()->make($request->all(),[
            'name'=>'required',
            'email'=>'required|unique:clients',
            'blood_type_id'=>'required',
            'city_id'=>'required',
            'phone'=>'required|unique:clients',
            'b_o_d'=>'required|date',
            'password'=>'required|confirmed',
            'order_last_date'=>'required|date'
        ]);
        if ($validator->fails()){
            return responseJson(0,$validator->errors()->first(),$validator->errors());
        }
        $request->merge(['password'=>bcrypt($request->password)]);

        $client=Client::create($request->all());
        $client->api_token=str_random(60);
        $client->save();

        return responseJson('1','register ok',['api_token'=>$client->api_token,'client'=>$client]);
    }

    /////////////////////////login/////////////////////////////////////////////
    public function login(Request $request){
        $validator= validator()->make($request->all(),[
            'phone'=>'required',
            'password'=>'required'
        ]);
        if ($validator->fails()){
            return responseJson(0,$validator->errors()->first(),$validator->errors());
        }
            $client=Client::where('phone',$request->phone)->first();
            if ($client){
              if(Hash::check($request->password,$client->password)){
                  return responseJson(1,'login success',[
                      'api_token'=>$client->api_token,
                      'client'=>$client]);
              }else{
                  return responseJson(0,'login failed','fail');
              }
        }else{
            return responseJson(0,'login failed','fail');
        }
    }


    /////////////////////////////resetPassword/////////////////////////////////////
    public function resetPassword(Request $request)
    {
        $validator = validator()->make($request->all(),[
            'phone'=>'required',
        ]);
        if($validator->fails())
        {
            return responseJson(0, $validator->errors()->first(), $validator->errors());
        }
        $user = Client::where('phone',$request->phone)->first();
        if($user)
        {
            $code = rand(1111,9999);
            $update = $user->update(['pin_code' => $code]);
            if($update){
                //smsMisr($request->phone, "Your Reset Code Is : ". $code);


                Mail::to($user->email)
                    ->bcc("mohamednasrali101293@gmail.com")
                    ->send(new ResetPassword($user));
                return responseJson(1, 'برجاء فحص هاتفك',
                    [
                        'pin_code_for_test' => $code,
                        'mail_fails' => Mail::failures(),
                        'email' => $user->email,
                    ]);
            }else
            {
                return responseJson(0,  'حدث خطأ , حاول مرة أخرى');
            }
        }else
        {
            return responseJson(0,  'لا يوجد حساب مرتبط بهذا الهاتف');
        }
    }

    ////////////////////////////newPassword/////////////////////////////////////
    public function newPassword(Request $request)
    {
        $validator = validator()->make($request->all(),[
            'phone' => 'required',
            'password' => 'required|confirmed',
            'pin_code' => 'required',
        ]);
        if($validator->fails())
        {
            return responseJson(0, $validator->errors()->first(), $validator->errors());
        }
        $client = Client::where('pin_code',$request->pin_code)->where('pin_code','!=',0)->where('phone',$request->phone)->first();
        if($client)
        {
            $client->password = bcrypt($request->password);
            $client->pin_code = null;
            if($client->save())
            {
                return responseJson(1, 'تم تغيير كلمة المرور بنجاح');
            }else
            {
                return responseJson(0, 'حدث خطأ , حاول مرة أخرى');
            }
        }else{
            return responseJson(0, 'هذا الكود غير صالح');
        }
    }

    ////////////////////////profile/////////////////////////////////
    public function profile(Request $request){

        $validator= validator()->make($request->all(),[
            'name'=>'required',
            'email' => 'unique:clients,email,'.$request->user()->id,
            'blood_type_id'=>'required',
            'city_id'=>'required',
            'phone'=>'required|unique:clients,phone,'.$request->user()->id,
            'b_o_d'=>'required|date',
            'password'=>'confirmed',
            'order_last_date'=>'required|date'
        ]);
        if ($validator->fails()){
            return responseJson(0,$validator->errors()->first(),$validator->errors());
        }

        $client=$request->user();
        if ($client){
            if ($request->has('password')){
                $request->merge(['password'=>bcrypt($request->password)]);
            }
            $client->update($request->all());
            $client->api_token=str_random(60);


            return responseJson('1','update_ok',['api_token'=>$client->api_token,'client'=>$client]);

        }else{
            return responseJson(0,'update failed','fail');
        }
    }
    public function profileById(Request $request){
        $profile=$request->user();
        return responseJson('1','profile data',$profile);
    }
    ////////////////////////////registerToken////////////////////////////

    public function registerToken(Request $request)
    {
        $validator = validator()->make($request->all(),[
            'token' => 'required',
            'platform' => 'required|in:ios,android',
            'api_token'=>'required'
        ]);
        if($validator->fails())
        {
            return responseJson(0, $validator->errors()->first(), $validator->errors());
        }
        Token::where('token',$request->token)->delete();
        $request->user()->tokens()->create($request->all());
        return responseJson(1, 'تم التسجيل بنجاح');
    }

    ////////////////////////////removeToken////////////////////////////
    public function removeToken(Request $request)
    {
        $validator = validator()->make($request->all(),[
            'token' => 'required','api_token'=>'required'
        ]);
        if($validator->fails())
        {
            return responseJson(0, $validator->errors()->first(), $validator->errors());
        }
        Token::where('token',$request->token)->delete();
        return responseJson(1, 'تم الحذف بنجاح');
    }


    //////////////////////////////notificationSettings///////////////////////////////////
    public function notificationSettings(Request $request)
    {
        if (($request->input('action')=='save')){
            $validator = validator()->make($request->all(),[
                'governorates.*' => 'exists:governorates,id',
                'bloodtypes.*' => 'exists:blood_types,id',
            ]);
            if($validator->fails())
            {
                return responseJson(0, $validator->errors()->first(), $validator->errors());
            }
            if($request->has('governorates'))
            {
                $request->user()->governorates()->sync($request->governorates);
            }
            if($request->has('bloodtypes'))
            {
                $request->user()->bloodtypes()->sync($request->bloodtypes);
            }
    }


        $data = [
            'governorates' => $request->user()->governorates()->pluck('governorates.id')->toArray(),
            'bloodtypes' => $request->user()->bloodtypes()->pluck('blood_types.id')->toArray(),
        ];
        return responseJson(1, 'تم التحديث',$data);

    }

}
