<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'full_name',
        'email',
        'phone',
        'address',
        'birth_place',
        'birth_date',
        'gender',
        'education_background',
        'school_name',
        'gpa',
        'motivation',
        'attachment_path',
        'status',
        'admin_notes',
    ];

    protected $casts = [
        'birth_date' => 'date',
        'gpa' => 'decimal:2',
    ];

    /**
     * Get the user that owns this registration
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
