<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Subscriptions;
use App\Models\User;
use Exception;

class StripeController extends Controller
{
    //
    public function index(Request $req)
    {
        $sub = null;
        $err = null;
        try {
            if ($req->user() && !$req->user()->subscribed('TView-1')) {
                // This user is not a paying customer...
                $sub = $req->user()->newSubscription(
                    // (string)$req->name
                    'TView-1',
                    $req->pr
                )->create($req->paymentMethodId);
            }
        } catch (Exception $e) {
            $err = $e;
        }

        return ['sub' => $sub, 'err' => $err];
    }

    public function update(Request $req)
    {
        $upd = null;
        $err = null;

        try {
            $upd = $req->user()->subscription('TView-1')->swap($req->pr);
        } catch (Exception $e) {
            $err = $e;
        }
        return ['upd' => $upd, 'err' => $err, 'req' => $req->pr];
    }

    public function delete(Request $req)
    {
        $err = null;
        $can = null;
        try {
            $can = $req->user()->subscription('TView-1')->cancelNow();
        } catch (Exception $e) {
            $err = $e;
        }
        return ['can' => $can, 'err' => $err];
    }

    public function paymethod(Request $req)
    {
        $upd = $req->user()->updateDefaultPaymentMethod($req->paymethod);

        return ['upd' => $upd];
    }

    public function getall(Request $req)
    {
        $stripe = new \Stripe\StripeClient(
            env('STRIPE_SECRET')
        );
        //   $subs = $stripe->subscriptions->all();

        $sublist = [];
        $subs = Subscriptions::all("user_id");
        foreach ($subs as $su) {
            $sublist[] =  User::find($su->user_id)->name;
        }

        dd($sublist);
    }

    public function updateUserTV(Request $req)
    {
        $newusr = $req->user()->update(["name" => $req->TVuserName, "TVuser" => $req->TVuserName]);
        return ["user" => $newusr];
    }
}
