<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BidHistory extends Model
{
    use HasFactory;

    protected $table = 'nft_bids';

    protected $fillable = [
        'bidder_id',
        'nft_id',
        'total',
        'type'
    ];

    public function user () {
        return $this->belongsTo(User::class, 'bidder_id', 'id');
    }
}
