<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    use HasFactory;

    protected $guarded = false;

    public function brand(): BelongsTo {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }

    public function chars(): BelongsToMany {
        return $this->belongsToMany(Char::class, 'product_chars', 'product_id', 'char_id');
    }
    public function images(): HasMany {
        return $this->hasMany(ProductImages::class);
    }

    public function params(): BelongsToMany {
        return $this->belongsToMany(Param::class, 'product_params', 'product_id', 'param_id');
    }

    public function categories(): BelongsToMany {
        return $this->belongsToMany(Category::class, 'product_to_categories', 'product_id', 'category_id');
    }

    public function siteData(): HasOne {
        return $this->hasOne(ProductSiteData::class);
    }
}
