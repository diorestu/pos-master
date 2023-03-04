<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MetodePembayaran extends Model
{
    protected $guarded = ['id'];

    public function payment(): HasMany
    {
        return $this->hasMany(Pembayaran::class, 'id_pembayaran', 'id');
    }
}
