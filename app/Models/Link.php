<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use HasUuids;

    protected $fillable = [
        'target_url',
        'short_url'
    ];
}
