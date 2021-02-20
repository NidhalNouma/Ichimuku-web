<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class StripeController extends Controller
{
    //

    public function index(Request $req) {
        $done = false;
        $stripeCustomer = $req->user()->createOrGetStripeCustomer();

        if ($req->user() && ! $req->user()->subscribed((string)$req->name)) {
            // This user is not a paying customer...
            $req->user()->newSubscription(
                    (string)$req->name,$req->pr 
                )->create($req->paymentMethodId);
            $done = true;    
        } 
            
        
        return ['cus'=> $stripeCustomer, 'pay'=> $req->card, 'done'=>$done];
    }
}
