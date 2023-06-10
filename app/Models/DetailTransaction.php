<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaction extends Model
{
    use HasFactory;

    protected $table = 'detail_transaksi';
    protected $fillable = [
        'transaksi_id',
        'paket_id',
        'qty',
        'harga',
        'berat',
        'total',
    ];

}
