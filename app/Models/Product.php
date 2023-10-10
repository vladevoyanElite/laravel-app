<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    protected $attributes = [
        'quantity' => 1,
    ];

    public function feedbacks(): HasMany
    {
        return $this->hasMany(Feedback::class);
    }
}
