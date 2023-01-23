<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TopupBalances extends Model
{
    use HasFactory;

    protected $table = 'topup_balances';

    protected $fillable = [
        'status',
        'total',
        'user_id'
    ];

    public function user () {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
