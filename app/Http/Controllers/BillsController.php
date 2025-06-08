<?php

namespace App\Http\Controllers;
use App\Models\bills;
use App\Models\products;
use App\Models\billItem;
use App\Models\dairy;
use Illuminate\Http\Request;
use App\Models\customer;
use Illuminate\Support\Facades\Cookie;
class BillsController
{
    //
//   customerID paymentMethod	information	Dilevery	updated_at	created_at	orderplaced	
//id	billId	productId	qty	sellprice	gst	created_at	updated_at	
    public function __construct()
    {
        if (!session()->has('id')) {
            return redirect('/')->send(); // Prevent unauthorized access
        }
    }
    public function billgenerate(Request $request){
        $custPrio=customer::where('id',session()->get('id'))->first()["prioty"];
        $json=$_COOKIE["cart"];
        $cart = json_decode($json, true);
        $bill= new bills();
        $bill->customerID = session()->get('id');
        $bill->information="cash";
        if($request["payment"]=='Cash on Delivery') $request["payment"]="COD";
        $bill->paymentMethod=$request["payment"];
        $bill->Dilevery='P';
        $bill->orderplaced='P';
        $amt=0;
        $bill->save();  
        foreach($cart as $prod){
            $row=products::where('productId',$prod['id'])->first();
            $sp=99999999999;
            if($custPrio == '0')    $sp=$row["sell1"];
            else if($custPrio== '1')    $sp=$row["sell2"];
            else    $sp=$row["sellingPrice"];   
            $item=new billItem();
            $item->billId=$bill['id'];
            $item->productId=$prod['id'];
            $item->qty=$prod['quantity'];
            $item->sellprice=$sp;
            $item->gst=$row["gst"];
            $amt += ((float)$prod['quantity'] *$sp) * (1 + ((float) $row["gst"] / 100));
         $item->save();
        }
        $dairy=new dairy();
        $dairy->customerID=session()->get('id');
        $dairy->action="Bill Generated";
        $dairy->amount=$amt;
        $dairy->information=$bill['id'];
        $dairy->save();
        if($bill->paymentMethod=='cash'){
            $dairy=new dairy();
        $dairy->customerID=session()->get('id');
        $dairy->action="Bill Payment";
        $dairy->amount=$amt;
        $dairy->information=$bill['id'];
        $dairy->save();
        }
        
        $_COOKIE["cart"]="";
        return redirect('/history')->withCookie(Cookie::forget('cart'));

    }
    public function allbills(){
        $bills=bills::where('customerId',session()->get('id'))->orderBy('id','desc')->get();
        return view('history',["data"=>$bills]);
    }
    public function billDetails($id)
{
    $bill = bills::findOrFail($id);
    $items = billItem::where('billId', $id)->get();
    $cust=customer::where('id',session()->get('id'))->first();
    $prod=[];
    foreach($items as $item){
        $pro=products::where('productId',$item['id'])->first();
        array_push($prod,$pro);
    }

    return view('bill_details', ['bill' => $bill, 'items' => $items, 'customer'=>$cust,'product'=>$pro]);
}

}
