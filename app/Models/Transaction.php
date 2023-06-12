<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $table = 'transaksi';
    protected $fillable = [
        'no_transaksi',
        'user_id',
        'tanggal',
        'sub_total',
        'diskon',
        'total',
        'status',
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function detail(){
        return $this->hasMany(DetailTransaction::class,'transaksi_id');
    }

}
