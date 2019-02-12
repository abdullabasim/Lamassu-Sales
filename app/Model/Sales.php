<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Client;
use App\User;
class Sales extends Model
{
    protected $table = "sales";

    protected $fillable = [
        'client_id',
        'sales_type_id',
        'discount',
        'total_amount',
        'paid_amount',
        'remaining_amount',
        'paid_date',
        'payment_id',
        'sales_employee_id',
        'user_id',
        'date_issue'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function sales_type()
    {
        return $this->hasOne(Sales_Type::class, 'id', 'sales_type_id');
    }

    public function item()
    {
        return $this->hasMany(Item::class, 'sales_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payment_method()
    {
        return $this->hasOne(Payment_Method::class, 'id', 'payment_id');
    }

    public function transaction()
    {
        return $this->hasMany(Invoice_Transaction::class, 'invoice_id', 'id');
    }
}
