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
            $sub =$req->user()->newSubscription(
                    // (string)$req->name
                    'TView-1',$req->pr 
                )->create($req->paymentMethodId);
            $done = true;    
        } 
        
        return ['cus'=> $stripeCustomer,'sub',$sub, 'pay'=> $req->card, 'done'=>$done];
    }

    public function update(Request $req){
        $upd = $req->user()->subscription('TView-1')->swap($req->pr );
        return ['upd'=>$upd];
    }
    
    public function delete(Request $req){
        $can = $req->user()->subscription('TView-1')->cancelNow(); 
        return ['can'=>$can];
    }
    
    public function paymethod(Request $req){
        $upd =$req->user()->updateDefaultPaymentMethod($req->paymethod);
         
        return ['upd'=>$upd];
    }
    
    public function getall(Request $req){
        $stripe = new \Stripe\StripeClient(
           env('STRIPE_SECRET') 
          );
          $subs = $stripe->subscriptions->all();

          dd($subs);
    }

}
