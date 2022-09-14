<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Comment extends Model
{
    use HasFactory;

    public function movie(): BelongsTo
    {
        return $this->belongsTo(Movie::class);
    }

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
