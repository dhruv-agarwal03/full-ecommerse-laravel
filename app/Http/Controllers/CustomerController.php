<?php
namespace App\Http\Controllers;
use App\Models\customer;
use App\Models\Category;
use Illuminate\Http\Request;

class CustomerController
{
    
    public function index(Request $request)
    {
        if(session()->has('id')){
            return redirect('/home');
        }
        return view('login',['msg'=>""]);
    }
    public function indexCheck(Request $request)
    {   
        $id=$request->email;
        $pass=$request->password;
        $user=customer::where('email',$id)->first();
        if($user) {
            if($pass==$user["password"])   {
                session()->put(['id'=>$user->id]);
                return redirect('/home');
            } 
            
            else return view('login',['msg'=>"Wrong id and password"]);  
        }
        else if($id=='admin@admin.com' && $pass=='admin'){
                session()->put(['id'=>'admin']);
                return redirect('/admin');
            }
        else return view('login',['msg'=>"User not found"]);
    }
    public function register()
    {
        return view('register');
    }
    public function logout(){
        session()->flush();

    return redirect('/')->withHeaders([
        'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0',
        'Pragma' => 'no-cache',
        'Expires' => 'Sat, 01 Jan 2000 00:00:00 GMT',
    ]);
    }
         public function registerit(Request $request)
    {
        // Validation rules
       
        // Create new customer record
        $customer = new customer();
        $customer->fname = $request->fname;
        $customer->lname = $request->lname;
        $customer->number = $request->number;
        $customer->email = $request->email;
        $customer->password = $request->password; // 👉 Or use Hash::make if password is hashed
        $customer->address = $request->address;
        $customer->city = $request->city;
        $customer->state = $request->state;
        $customer->pincode = $request->pincode;
        $customer->save();

       
        return redirect('/');
   }
}