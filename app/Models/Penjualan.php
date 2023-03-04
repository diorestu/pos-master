<?php

namespace App\Models;

use App\Models\Pembayaran;
use Illuminate\Database\Eloquent\Model;
use Alfa6661\AutoNumber\AutoNumberTrait;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Penjualan extends Model
{
    use AutoNumberTrait;

    protected $guarded = ['id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function detail(): HasMany
    {
        return $this->hasMany(DetailPenjualan::class, 'id_penjualan', 'id');
    }

    public function payment(): HasMany
    {
        return $this->hasMany(Pembayaran::class, 'id_penjualan', 'id');
    }

    public function getAutoNumberOptions()
    {
        return [
            'kode_penjualan' => [
                'format' => function () {
                    return 'SO/' . date('Y.m.d') . '/?';
                },
                'length' => 4,
            ]
        ];
    }

    public  static function boot()
    {
        parent::boot();
        static::deleting(function ($order) {
            $order->detail()->delete();
            $order->payment()->delete();
            return true;
        });
    }
}
