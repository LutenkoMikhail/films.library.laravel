<?php

namespace App\Models;

use App\Http\Traits\ModelPaginateTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory,
        ModelPaginateTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'poster',
        'published',
    ];

    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }
}
