<?php

namespace App\Models;

use the;
use Illuminate\Database\Eloquent\Model;
use Alfa6661\AutoNumber\AutoNumberTrait;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pesanan extends Model
{
    use AutoNumberTrait;

    protected $guarded = ['id'];

    public function items(): HasMany
    {
        return $this->hasMany(DetailPesanan::class, 'id_pesanan', 'id');
    }

    public function getAutoNumberOptions()
    {
        return [
            'kode_pesanan' => [
                'format' => function () {
                    return 'PO/' . date('Y.m.d') . '/?';
                },
                'length' => 4,
            ]
        ];
    }

    public  static function boot()
    {
        parent::boot();
        static::deleting(function ($order) {
            $order->items()->delete(); //
            return true;
        });
    }
}
