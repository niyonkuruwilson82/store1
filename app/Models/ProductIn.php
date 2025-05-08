<?php
/// app/Models/ProductIn.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductIn extends Model
{
    // Force the correct table name
    protected $table = 'product_in';

    // Set the primary key if it's not 'id'
    protected $primaryKey = 'ProductIn_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'PCode',
        'prIn_Date',
        'prIn_Quantity',
        'prIn_Unit_Price',
        'prIn_TotalPrice',
    ];

    // Define the relationship to the Product model
    public function product()
    {
        return $this->belongsTo(Product::class, 'PCode', 'PCode');
    }
}
