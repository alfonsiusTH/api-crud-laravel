<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Material extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'material';

    protected $fillable = [
        'material_categories_id',
        'user_id',
        'code',
        'name',
        'brand',
        'expired_date',
        'is_toxic',
    ];

    /**
     * Get the categories that owns the Material
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function categories(): BelongsTo
    {
        return $this->belongsTo(Material_Categories::class, 'material_categories_id');
    }

    public function userId(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
