<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class BillController extends Controller
{
    public function __construct()
    {

    }
    public function show()
    {
      return view('admin.page.bills.import-bill');
    }
    public function importBill(Request $request)
    {
        
    	dd($request->all());
    }
}
