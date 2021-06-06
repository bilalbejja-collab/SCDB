<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoicesDetails extends Model
{
    protected $fillable = [
        'invoice_id',
        'invoice_number',
        'product',
        'section',
        'status',
        'value_status',
        'payment_date',
        'remaining_amount',
        'note',
        'user'
    ];
}
