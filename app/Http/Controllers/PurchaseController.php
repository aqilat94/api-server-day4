<?php

namespace App\Http\Controllers;

use App\Models\Phone;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PurchaseController extends Controller
{
    
    public function store(Request $request, Phone $phone)
    {
        // store purchase
       
        // create bill @ Toyyibpay

        $purchase = Purchase::create([
            'user_id' => auth()->user()->id,
            'phone_id' => $phone->id,
            'price' => $phone->price,
            'toyyibpay_bill_code'=>'',
        ]);
        
        // update purchase with toyyibpay bill code
        $response = Http::asForm()->post('https://dev.toyyibpay.com/index.php/api/createBill',[
            'userSecretKey' => 'hi30uhpi-knyn-zbgm-08rw-fmwjlczdrk38',
            'categoryCode' => 'uq0fco43',
            'billName' => $phone->model,
            'billDescription' => $phone->brand,
            'billPriceSetting' => 1,
            'billPayorInfo' => 1,
            'billAmount' => $phone->price,
            'billReturnUrl' => 'http://api-server.test/return-url',
            'billCallbackUrl' => 'http://api-server.test/callback-url',
            'billExternalReferenceNo' => $purchase->id,
            'billTo' => auth()->user()->name,
            'billEmail' => auth()->user()->email,
            'billPhone' => '0123123231',
            'billContentEmail' => 'Thank you for purchasing our product!',
            'billChargeToCustomer' => 1,
        ]);

        
        $bill_code = $response->json()[0]['BillCode'];

        $purchase->update(['toyyibpay_bill_code'=>$bill_code]);
        
        // dd($response->json()[0]);
        // $bill_code = $response->json()[0];
        // return to show purchase
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function showBill(Purchase $purchase)
    {
        // show purchase detail
        $url = 'https://dev.toyyibpay.com/'.$purchase->toyyibpay_bill_code;

        $response = Http::get($url);

        return $response;

    }
}
