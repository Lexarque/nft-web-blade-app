<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class NftEntities extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'nft_number',
        'description',
        'contract_id',
        'likes',
        'price',
        'image',
        'status',
        'created_by',
        'owned_by'
    ];

    public function scopeFilter ($query, array $filters) {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('name', 'like', '%'.$search.'%')
                ->orWhere('nft_number', 'like', '%'.$search.'%')
                ->orWhere('description', 'like', '%'.$search.'%');
        });
    }

    public function creator () {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function owner () {
        return $this->belongsTo(User::class, 'owned_by', 'id');
    }

    public function bidHistory () {
        return $this->hasMany(BidHistory::class, 'nft_id', 'id')->orderByDesc('created_at');
    }
}
