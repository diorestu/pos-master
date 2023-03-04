<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pembayaran extends Model
{
    protected $guarded = ['id'];

    public function payment(): BelongsTo
    {
        return $this->belongsTo(Penjualan::class, 'id_penjualan', 'id');
    }
    public function method(): BelongsTo
    {
        return $this->belongsTo(MetodePembayaran::class, 'id_pembayaran', 'id');
    }
}
