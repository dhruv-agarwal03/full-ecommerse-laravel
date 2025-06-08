<?php

namespace App\Http\Controllers;
use App\Models\classification;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\products;
use App\Models\bills;
use App\Models\billItem;
use App\Models\Catimage;
use App\Models\customer;
use App\Models\image;
use App\Models\dairy;

class AdminController

{
    //
    public function __construct()
    {
        if (!session()->has('id')) {
            return redirect('/')->send(); // Prevent unauthorized access
        }
        if (session()->get('id')!='admin') {
            return redirect('/')->send(); // Prevent unauthorized access
        }
    }
    public function billplaced($id){
         $bill=bills::find($id);
            $bill->orderplaced='D';
            $bill->save();
            return redirect('admin');
    }
     public function billinfo($id)
{
    $bill = bills::findOrFail($id);
    $items = billItem::where('billId', $id)->get();
    $cust=customer::where('id',$bill['customerID'])->first();

    return view('adminviews.bill_details', ['bill' => $bill, 'items' => $items, 'customer'=>$cust]);
}
    public function admin(){
        $bills = bills::orderBy('id', 'desc')->get(); 
        foreach($bills as $b){
            $cus=customer::where('id',$b['customerID'])->first();
            $b["name"]=$cus["fname"]." ".$cus["lname"];
        }
        return view('adminviews.admin',["data"=>$bills]);
    }
    public function billdilevery($id){
            $bill=bills::find($id);
            $bill->Dilevery='D';
            $bill->orderplaced='D';
            $bill->save();
            return redirect('admin');
    }
    public function new(){
        $class=classification::all();
        $data=Category::all();
        return view('adminviews.addnew',["cat"=>$data,"class"=>$class]);
    }
     public function newadd(Request $request){
       if($request->submit=='categery'){
            $request->validate([
            'name' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        $category = new Category();
        $max = Category::max('catId')+1;
        $category->catId=$max;
        $category->name = $request->name;
        $category->class=$request->classification;
        $id=$category->catId;
        $imageData = file_get_contents($request->image->getRealPath());
        $img=new Catimage();
        $img->cat_id=$id;
        $img->id=$max;
        $img->image=base64_encode($imageData);
        $category->save(); 
        $img->save(); 
        return redirect()->back()->with('status','C');
       }
       else if ($request->submit=='product'){
         $max = products::max('productId')+1;
        $product=new products();
        $product->productId = $max;
        $product->name = $request->name;
        $product->HSNcode = $request->HSNcode;
        $product->qualityNo = $request->qualityNo;
        $product->gst = $request->gst;
        $product->MRP = $request->MRP;
        $product->category = $request->category;
        $product->expirs = $request->expirs;
        $product->priorty = $request->priorty;
        $product->costprice = $request->costprice;
        $product->sellingPrice = $request->sellingPrice;
        $product->sell1 = $request->sell1;
        $product->sell2 = $request->sell2;
        $product->Available = $request->Available;
        $imagedata=file_get_contents($request->image->getRealPath());
        $img=new image();
        $img->id=$max;
        $img->product_id=$max;
        $img->image=base64_encode($imagedata);
        $product->save();
        $img->save();
            return redirect()->back()->with('status','P');
       }
       
            return redirect()->back()->with('status','E');
    }
    public function products(){
        $data=products::all();
        $cata=[];
        foreach($data as $dat){
            $cat=Category::where('catId',$dat['category'])->first();
            array_push($cata,$cat['name']);
        }
        return view('adminviews.productsAdmin',["data"=>$data,"cata"=>$cata,"status"=>'N']);

    }
public function productsupdate(Request $request)
{
    $product = products::where('productId',$request->productId)->first();

    if (!$product) {
        return redirect()->back()->with('status', 'E'); // E = Error / Not Found
    }

    if ($request->action === 'update') {
        $product->name = $request->name;
        $product->HSNcode = $request->HSNcode;
        $product->qualityNo = $request->qualityNo;
        $product->gst = $request->gst;
        $product->expirs = $request->expires;
        $product->priorty = $request->priority;
        $product->costprice = $request->costprice;
        $product->sellingPrice = $request->sellingPrice;
        $product->sell1 = $request->sell1;
        $product->sell2 = $request->sell2;
        $product->Available = $request->available;

        $product->save();

        return redirect()->back()->with('status', 'U'); // U = Updated
    }

    if ($request->action === 'delete') {
        $product->delete();
        return redirect()->back()->with('status', 'D'); // D = Deleted
    }

    return redirect()->back()->with('status', 'E'); // E = Error
}

    public function dairy(){
        $cust=customer::all();
        return view('adminviews.dairy',["data"=>$cust]);
    }

    public function dairyget($id){
        $bills=bills::where('customerID',$id)->get();
        $cust=customer::find($id);
        $dairy=dairy::where('customerID',$id)->orderby('id','desc')->get();
        return view('adminviews.customer',["customer"=>$cust,"dairy"=>$dairy]);
    }
}
