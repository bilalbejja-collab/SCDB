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
        'note',
        'user',
        'payment_date',
    ];
}
