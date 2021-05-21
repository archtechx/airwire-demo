<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Report extends Model
{
    use HasFactory;

    public static function booted()
    {
        static::saving(function (self $report) {
            // $report->status ??= collect(['pending', 'resolved', 'invalid'])->random();
            $report->status ??= 'pending';
        });
    }

    public function assignee(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
