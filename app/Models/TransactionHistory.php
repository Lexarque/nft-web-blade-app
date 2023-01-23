<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionHistory extends Model
{
    use HasFactory;

    protected $table = 'nft_transactions';

    protected $fillable = [
        'nft_id',
        'buyer_id',
        'contract_id'
    ];
}
