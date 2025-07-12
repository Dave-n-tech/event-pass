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
        'image',
        'capacity',
        'event_date',
        'price',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
