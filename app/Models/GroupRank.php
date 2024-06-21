<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupRank extends Model
{
    protected $table = 'group_ranks';

    protected $fillable = [
        'group_id',
        'name',
        'rank',
    ];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function count()
    {
        return GroupMember::where('group_id', $this->group_id)->where('rank', $this->rank)->count();
    }
}