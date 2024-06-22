<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Sale;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Stripe\Subscription;

class SubscriptionController extends Controller
{
    public function checkout()
    {
        $user = Auth::user();

        $stripeCustomer = $user->createOrGetStripeCustomer();

        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $checkoutSession = \Stripe\Checkout\Session::create([
            'customer' => $stripeCustomer->id,
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price' => env('STRIPE.PRICE_ID'),
                'quantity' => 1,
            ]],
            'mode' => 'subscription',
            'success_url' => route('checkout.success', [], true) . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('mypage', [], true),
        ]);

        return redirect($checkoutSession->url);
    }
    
    public function success(Request $request)
    {
        $sessionId = $request->get('session_id');

        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $session = \Stripe\Checkout\Session::retrieve($sessionId);
        $subscriptionId = $session->subscription;

        // サブスクリプションの詳細をデータベースに保存
        $user = Auth::user();
        $user->subscriptions()->create([
            'stripe_id' => $subscriptionId,
            'name' => $user->name,
            'stripe_status' => 'active',
            'stripe_price' => env('STRIPE.PRICE_ID'),
            'quantity' => 1,
        ]);

        Sale::create([
            'user_id' => $user->id,
            'amount' => 300,
        ]);
        
        return view('checkout.success');
    }

    public function changeCard()
    {
        $user = Auth::user();
        $stripeCustomer = $user->createOrGetStripeCustomer();

        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $checkout_session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'mode' => 'setup',
            'customer' => $stripeCustomer->id,
            'success_url' => route('change.card.success', [], true) . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('mypage', [], true),
        ]);

        return redirect($checkout_session->url);
    }

    public function changeCardSuccess(Request $request)
    {
        $user = Auth::user();
        $stripeCustomer = $user->createOrGetStripeCustomer();
    
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $checkout_session = \Stripe\Checkout\Session::retrieve($request->get('session_id'));
        $setup_intent = \Stripe\SetupIntent::retrieve($checkout_session->setup_intent);

        $payment_method = \Stripe\PaymentMethod::retrieve($setup_intent->payment_method);

        // サブスクリプションの支払い方法を更新
        $subscriptions = $user->subscriptions;
        foreach ($subscriptions as $subscription) {
            if ($subscription->stripe_status !== 'canceled') {
                try {
                    \Stripe\Subscription::update($subscription->stripe_id, [
                        'default_payment_method' => $payment_method->id,
                    ]);
                } catch (\Exception $e) {
                    // エラーハンドリング
                    return back()->withErrors(['error' => 'サブスクリプションの支払い方法の更新に失敗しました。']);
                }
            }
        }

        return view('change-card.success');
    }

    public function cancelSubscription()
    {
        $user = Auth::user();

        $subscriptions = $user->subscriptions;

        if ($subscriptions->isNotEmpty()) {
            foreach ($subscriptions as $subscription) {
                try {
                    \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

                    $stripeSubscription = \Stripe\Subscription::retrieve($subscription->stripe_id);
                    $stripeSubscription->cancel();

                    // サブスクリプションの状態を更新
                    $subscription->update(['stripe_status' => 'canceled']);
                } catch (\Exception $e) {
                    // エラーハンドリング
                    return back()->withErrors(['error' => 'サブスクリプションのキャンセルに失敗しました。']);
                }
            }
        }

        return redirect()->route('mypage')->with('success', 'サブスクリプションをキャンセルしました。');
    }   
}