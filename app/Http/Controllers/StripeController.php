<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class StripeController extends Controller
{
    //

    public function index(Request $req) {

        $stripeCustomer = $req->user()->createOrGetStripeCustomer();
        // $stripeCharge = $req->user()->charge(
        //     100, $req->paymentMethodId
        // );
        // $req->user()->createSetupIntent();

        $req->user()->newSubscription(
            'default', env('MIX_PRICE_M') 
        )->create($req->paymentMethodId);
    

        
        return ['bb'=> $req->user(), 'cus'=> $stripeCustomer, 'pay'=> $req->card];
    }
}
