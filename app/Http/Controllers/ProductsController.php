<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {
        return Products::all();
    }

    public function create()
    {
        return 'create';
    }

    public function store()
    {
        return 'store';
    }

    public function show()
    {
        return 'show';
    }

   public function edit()
   {
        return 'edit';
   }

   public function update()
   {
      return 'update';
   }
   
   public function destory()
   {
      return 'destory';
   }
   
}
