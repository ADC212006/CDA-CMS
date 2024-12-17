<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Table name associated with the model
    protected $table = 'categories';

    // Primary key of the table
    protected $primaryKey = 'id';

    // Indicates if the primary key is auto-incrementing
    public $incrementing = true;

    // Indicates if the primary key type is an integer (default)
    protected $keyType = 'int';

    // Indicates if the model should use timestamps (created_at, updated_at)
    public $timestamps = true;

    // Attributes that are mass assignable
    protected $fillable = [
        'category_name',
        'description',
        'file'
    ];

    /**
     * Get the image path for the category.
     *
     * @return string
     */
    public function imagePath()
    {
        return 'category/';
    }

    /**
     * Define the relationship with SubCategory.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subCategories()
    {
        return $this->hasMany(SubCategory::class, 'category_id');
    }
}
