<?php

namespace App\Http\Controllers;

use App\Models\products;
use App\Models\image;
use App\Models\customer;
use Illuminate\Http\Request;

class ProductsController
{
    public function __construct()
    {
        if (!session()->has('id')) {
            return redirect('/')->send(); // Prevent unauthorized access
        }
    }
    public function products($id)
    {
        $data = products::where('category', $id)->get();
        return $this->show($data);
    }
    
    public function productsall()
    {
        $data = products::all();
        return $this->show($data);
    }
    
    public function show($data){
        $ans=[];
        
        $custPrio=customer::where('id',session()->get('id'))->first()["prioty"];
        foreach($data as $da){
            // 'product_id','image'
            $id=$da->productId;    
            $imgrow = image::where('product_id', $id)->first();
            $sp=99999999999;
            if($custPrio == '0')    $sp=$da["sell1"];
            else if($custPrio== '1')    $sp=$da["sell2"];
            else    $sp=$da["sellingPrice"];    
            array_push($ans,[
                'image' => $imgrow ? $imgrow->image : null,
                'product_id'=>$da->productId,
                'HSNcode'=>$da->HSNcode,
                'costprice'=>$da->costprice,
                'sellingPrice'=>$sp,
                'MRP'=>$da->MRP,
                'qualityNo'=>$da->qualityNo,
                'gst'=>$da->gst,
                'expirs'=>$da->expirs,
                'category'=>$da->category,
                'priorty'=>$da->priorty,
                'Available'=>$da->Available
            ]);
        }
        return view('products',['data'=>$ans]);
    }
    
    
public function cart(Request $request)
{
    if(isset($_COOKIE["cart"])){
        $json=$_COOKIE["cart"];
        $cart = json_decode($json, true);
        $custPrio=customer::where('id',session()->get('id'))->first()["prioty"];
        $data=[];
        foreach($cart as $c){
            $row=products::where('productId',$c['id'])->first();
            $imgrow = image::where('product_id', $c['id'])->first();
            $sp=99999999999;
            if($custPrio == '0')    $sp=$row["sell1"];
            else if($custPrio== '1')    $sp=$row["sell2"];
            else    $sp=$row["sellingPrice"];    
            array_push($data,[
                'name'=>$row->name,
                'qty'=>$c['quantity'],
                'price'=>$sp,
                'GST'=>$row->gst,
                'img'=>$imgrow->image
            ]);
        }
    }
    else{
        $data=[];
    }

    return view('cart',["cart"=>$data]);
}

}