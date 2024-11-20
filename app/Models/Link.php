<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use HasUuids, HasFactory;

    protected $fillable = [
        'target_url',
        'slug',
        'redirect_url'
    ];
}
