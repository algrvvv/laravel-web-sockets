<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static create(mixed $data)
 */
class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'body'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
