<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'target_type',
        'target_id',
        'points',
        'meta',
    ];

    protected $casts = [
        'meta' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Convenience static helper
    public static function log(int $userId, string $type, int|null $targetId = null, int $points = 0, array $meta = [])
    {
        return self::create([
            'user_id' => $userId,
            'type' => $type,
            'target_type' => $meta['target_type'] ?? null,
            'target_id' => $targetId,
            'points' => $points,
            'meta' => $meta,
        ]);
    }
}
