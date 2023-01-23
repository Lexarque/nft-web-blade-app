<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LikedNft extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nft_id'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    
    public function nft () {
        return $this->belongsTo(NftEntities::class, 'nft_id', 'id');
    }
}
