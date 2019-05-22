<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Charge;
use Stripe\Stripe;
use Auth;

class PaymentController extends Controller
{
    public function getStripeForm()
    {
        $total_f = request('total_f');
        $totalPriceInEuro = $total_f * 0.1;
        return view('shop.payment', compact('total_f', 'totalPriceInEuro'));
    }

    public function postStripePayment(Request $r)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $currentUser = Auth::user();
        $price = $r->cost;

   
        $description = "User " . $currentUser->name . ' Bought';
        
        $charge = Charge::create([
            'amount' 	=>$price*100,
            'currency' 	=> 'eur',
            'source' 	=> $r->stripeToken,
            'description' => $description
        ]);
     
        if ($charge->status == 'succeeded') {
            $total_f = (request("total_f")) ? request('total_f') : null;
            $total_user_f = $total_f + $currentUser->credits;
    
            $currentUser->credits = $total_user_f;
    
            $currentUser->save();
    

            $r->session()->flash(
                'success',
                'Je hebt succesvol ' . $r->credits . ' credits aangekocht'
            );
        } else {
            $r->session()->flash('error', 'Aj aj aj');
        }


        

        return view('shop.confirmed', compact('total_f', 'total_user_f'));
    }
}
