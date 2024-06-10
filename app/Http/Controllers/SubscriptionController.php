<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class SubscriptionController extends Controller
{
    public function checkout()
    {
        $user = Auth::user();
        return $user->newSubscription('default', env('STRIPE.PRICE_ID'))->checkout([
            'success_url' => route('checkout.success'),
            'cancel_url' => route('mypage'),
        ]);
    }
    
    public function success()
    {
        return view('checkout.success');
    }

    public function changeCard()
    {
        $user = Auth::user();

        $customer = $user->asStripeCustomer();
        
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $session = Session::create([
            'payment_method_types' => ['card'],
            'mode' => 'setup',
            'customer' => $customer->id,
            'success_url' => route('change.card.success'),
            'cancel_url' => route('mypage'),
            'client_reference_id' => $user->id,
        ]);

        return redirect()->to($session->url);
    }

    public function changeCardSuccess(Request $request)
    {
        $user = Auth::user();
        $customer = $user->asStripeCustomer();

        // 新しいカードのIDを取得する
        $newCardId = $request->get('payment_method');

        // デフォルトの支払い方法を更新する
        $customer->invoice_settings = [
            'default_payment_method' => $newCardId,
        ];
        $customer->save();
        return view('change-card.success');
    }

    public function cancelSubscription()
    {
        $user = Auth::user();
        // Stripeのサブスクリプションを解約する
        $user->subscription('default')->cancel();

        // データベースのサブスクリプション情報を更新する
        $user->updateDefaultPaymentMethod(null);
        $user->subscription_status = 'canceled';
        $user->save();

        // 成功メッセージを表示する
        session()->flash('success', 'サブスクリプションを解約しました。');

        return redirect()->route('mypage');
    }   
}