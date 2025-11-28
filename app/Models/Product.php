<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = "products";
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'company_id',
        'code',
        'name',
        'unit_type',
        'description',
        'price',
        'tax_percent',
        'status',
    ];
}
