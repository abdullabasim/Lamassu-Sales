<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Promotion_Item extends Model
{
    protected $table = "promotion_item";

    protected $fillable = [
        'amount',
        'exchange_date',
        'note',
        'promotion_item_company_id',
    ];

    public function promotion_item_company()
    {
        return $this->hasOne(PromotionItemCompany::class, 'id', 'promotion_item_company_id');
    }
}
