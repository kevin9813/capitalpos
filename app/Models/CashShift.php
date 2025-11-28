<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CashShift extends Model
{
    use HasFactory;
    protected $table = "cash_shifts";
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'opening_amount',
        'closing_amount',
        'total_sales',
        'total_cash',
        'total_transfer',
        'total_card',
        'total_expenses',
        'status',
        'opened_at',
        'closed_at'
    ];

    protected $casts = [
        'opened_at' => 'datetime',
        'closed_at' => 'datetime',
    ];

    public function sales() {
        return $this->hasMany(Sale::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
