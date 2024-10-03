<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Material_Categories extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'material_categories';

    protected $fillable = [
        'nama',
        'author',
        'description'
    ];

    /**
     * Get all of the material for the Material_Categories
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function material(): HasMany
    {
        return $this->hasMany(Material::class, 'material_categories_id');
    }

    /**
     * Get the authorId that owns the Material_Categories
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function authorId(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($materialCategories){
            $materialCategories->material()->delete();
        });
    }
}
