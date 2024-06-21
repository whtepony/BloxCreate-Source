<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileView extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'viewer_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function viewer()
    {
        return $this->belongsTo(User::class, 'viewer_id');
    }

    public function views()
    {
        return $this->hasMany(ProfileView::class, 'user_id');
    }    
}