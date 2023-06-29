<?php
namespace App\Http\Controllers;

ini_set('memory_limit', '4096M');

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Purchase;

use Session;
use Stripe;

   
class StripePaymentController extends Controller
{
    public function stripe(Request $request)
    {
    	$contents = file_get_contents('https://pay.stripe.com/receipts/payment/CAcaFwoVYWNjdF8xQVV3RHVLTm44dTM2MjhvKOD49KQGMga2s1LMhXA6LBZL6YX1AxwxqcDhTeotIQkg83CEQB1UF8SYAtts2kIu2eFxf5Lqu5C4f2Fl');
		\Storage::disk('public')->put('filename.pdf', $contents);
        return view('layouts.stripe3');
    }

    public function stripePost(Request $request)
    {
    	$product_detail = Product::find($_POST['product_id']);
    	
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        
        $payment = Stripe\Charge::create ([
                "amount" => ($product_detail->price * $_POST['quantity']) * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Test payment from Manoj for the product - ".$product_detail->name, 
        ]);
        
        //Product Quantity Update
        $product_detail->quantity = $product_detail->quantity - $_POST['quantity'];
        $product_detail->update();

        //Purchase Details Capture part
        $purchase  				=	new Purchase();
        $purchase->stripe_id 	=	$payment->id;
        $purchase->user_id 		=	auth()->user()->id;
        $purchase->product_id 	=	$_POST['product_id'];
        $purchase->amount 		=	$product_detail->price;
        $purchase->quantity 	=	$_POST['quantity'];
        $purchase->invoice 		=	$payment->receipt_url;
        $purchase->save();
  
        return redirect()->route('home')->with('success','Payment  successful');
    }
}