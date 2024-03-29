<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentDetail extends Model
{
    use HasFactory;

    protected $table ="payment_details";

    protected $fillable =[
        'user_id',
        'email',
        'card_number',
        'cart_holder_name',
        'exp_month',
        'exp_year',
        'status'
    ];
}
