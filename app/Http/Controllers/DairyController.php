<?php

namespace App\Http\Controllers;

use App\Models\dairy;
use App\Models\classification;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\products;
use App\Models\bills;
use App\Models\billItem;
use App\Models\Catimage;
use App\Models\customer;
use App\Models\image;


class DairyController
{
    public function __construct()
    {
        if (!session()->has('id')) {
            return redirect('/')->send(); // Prevent unauthorized access
        }
    }
    public function update_dairy(Request $request,$id)
    {
        if(isset($request["deposit"])) {
            $this->transition($request["amount"],'Deposit',$id,$request["information"]);
            return redirect()->back();
        }
        if(isset($request["Withdraw"])){
                $this->transition($request["amount"],'Withdraw',$id,$request["information"]);
            return redirect()->back();
        }

    }
    public function transition($amount,$t,$id,$info){
        $tran=new dairy();
        $tran->customerID=$id;
        $tran->action=$t;
        $tran->amount=$amount;
        $tran->information=$info;
        $tran->save();
    }

    
}
