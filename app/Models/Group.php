<?php
/**
 * MIT License
 *
 * Copyright (c) 2021-2024 FoxxoSnoot, Hurricane
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

namespace App\Models;

use App\Models\GroupRank;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $table = 'groups';

    protected $fillable = [
        'owner_id',
        'name',
        'status'
    ];

    public function owner()
    {
        return $this->belongsTo('App\Models\User', 'owner_id');
    }

    public function members()
    {
        return $this->hasMany('App\Models\GroupMember', 'group_id');
    }

    public function membersCount()
    {
        return $this->members()->count();
    }

    public function ranks()
    {
        return $this->hasMany(GroupRank::class);
    }

    public function thumbnail()
    {
        $url = config('blox.domains.storage');

        if ($this->status == 'pending') {
            return "{$url}/web-img/pending.png";
        } elseif ($this->status == 'declined') {
            return "{$url}/web-img/declined.png";
        } else {
            return "{$url}/thumbnails/groups/{$this->thumbnail_url}.png";
        }
    }    
}
