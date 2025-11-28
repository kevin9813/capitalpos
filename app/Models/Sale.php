<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;
    protected $table = "sales";
    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'cash_shift_id',
        'total',
        'payment_method',
    ];

    /**
     * Relación: una venta pertenece a un turno.
     */
    public function cashShift()
    {
        return $this->belongsTo(CashShift::class);
    }

    /**
     * Relación: una venta tiene muchos detalles.
     */
    public function details()
    {
        return $this->hasMany(SaleDetail::class);
    }
}
