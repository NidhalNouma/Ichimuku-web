<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $customer = Auth::user()->createOrGetStripeCustomer()->toJson();
        $payment = Auth::user()->defaultPaymentMethod(); //->paymentMethod();
        if($payment !== null){
            $payment = json_encode(["card"=> $payment->card, 'id'=>$payment->id]);
        }
        
        // dd($payment);
        return view('home', compact('customer', 'payment')); //->with('customer', $customer)->with('payment',  $payment);
    }
}
