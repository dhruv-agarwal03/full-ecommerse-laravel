<?php

namespace App\Http\Controllers;


use App\Models\products;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\CatImage;
use App\Http\Controllers\Controller;

class CategoryController
{
    public function __construct()
    {
        if (!session()->has('id')) {
            return redirect('/')->send(); // Prevent unauthorized access
        }
    }
    public function categery()
    {
        $ans1 = Category::all();
        $ans=[];
        foreach ($ans1 as $category) {
            $id=$category->catId;
            $imgrow = CatImage::where('cat_id', $id)->first();
            $tempAns = [
                'image' => $imgrow ? $imgrow->image : null,
                'CID' => $category->catId,
                'name' => $category->name,  
            ];
            array_push($ans, $tempAns);
        }
    
        return view('categery', ['categories' => $ans]); // Ensure correct variable name
    } 


}
