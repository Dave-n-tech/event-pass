<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'location',
        'image_url',
        'image_file',
        'capacity',
        'event_date',
        'time',
        'category',
        'price',
    ];

    public function getDisplayImageAttribute()
    {
        return $this->image_file
            ? asset('storage/' . $this->image_file)
            : $this->image_url;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
