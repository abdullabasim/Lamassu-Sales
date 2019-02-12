<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Invoice_Transaction extends Model
{
    protected $table = "invoice_transaction";

    protected $fillable = [
        'invoice_id',
        'amount',
        'note',
        'user_id'
    ];


    public function invoice()
    {
        return $this->belongsTo(Sales::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
