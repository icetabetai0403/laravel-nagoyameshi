<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Cashier\Billable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'postal_code',
        'address',
        'phone'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function favorite_stores()
    {
        return $this->belongsToMany(Store::class)->withTimeStamps();
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    /*
    public function updateDefaultPaymentMethod($paymentMethodId)
{
    $this->updateDefaultPaymentMethodFromStripe($paymentMethodId);
    $this->subscription()->updateDefaultPaymentMethod($paymentMethodId);
} */
    public function paymentMethods()
    {
        return $this->hasMany(PaymentMethod::class);
    }

    public function addPaymentMethod($paymentMethodId)
    {
        $stripeCustomer = $this->asStripeCustomer();

        $paymentMethod = \Stripe\PaymentMethod::retrieve($paymentMethodId);

        // 支払い方法がまだ顧客にアタッチされていない場合にのみ、アタッチを実行
        if ($paymentMethod->customer !== $stripeCustomer->id) {
            $paymentMethod->attach(['customer' => $stripeCustomer->id]);
        }

        $this->updateDefaultPaymentMethodFromStripe($paymentMethodId);
    }
}
