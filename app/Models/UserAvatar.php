<?php

namespace App\Models;

use App\Models\Item;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

$GLOBALS['tempavcache'] = [];

class UserAvatar extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'user_avatars';

    protected $fillable = [
        'user_id',
        'angle'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function hat($num)
    {
        if (isset($GLOBALS['tempavcache']['hat_' . $num]))
            return $GLOBALS['tempavcache']['hat_' . $num];

        $item = Item::where('id', '=', $this->{"hat_{$num}"})->first();
        $tempcache['hat_' . $num] = $item;

        return $item;
    }

    public function face()
    {
        if (isset($GLOBALS['tempavcache']['face']))
            return $GLOBALS['tempavcache']['face'];

        $item = Item::where('id', '=', $this->face)->first();
        $tempcache['face'] = $item;

        return $item;
    }

    public function tool()
    {
        if (isset($GLOBALS['tempavcache']['tool']))
            return $GLOBALS['tempavcache']['tool'];

        $item = Item::where('id', '=', $this->tool)->first();
        $tempcache['tool'] = $item;

        return $item;
    }

    public function tshirt()
    {
        if (isset($GLOBALS['tempavcache']['tshirt']))
            return $GLOBALS['tempavcache']['tshirt'];

        $item = Item::where('id', '=', $this->tshirt)->first();
        $tempcache['tshirt'] = $item;

        return $item;
    }

    public function shirt()
    {
        if (isset($GLOBALS['tempavcache']['shirt']))
            return $GLOBALS['tempavcache']['shirt'];

        $item = Item::where('id', '=', $this->shirt)->first();
        $tempcache['shirt'] = $item;

        return $item;
    }

    public function pants()
    {
        if (isset($GLOBALS['tempavcache']['pants']))
            return $GLOBALS['tempavcache']['pants'];

        $item = Item::where('id', '=', $this->pants)->first();
        $tempcache['pants'] = $item;

        return $item;
    }

    public function head()
    {
        if (isset($GLOBALS['tempavcache']['head']))
            return $GLOBALS['tempavcache']['head'];

        $item = Item::where('id', '=', $this->head)->first();
        $tempcache['head'] = $item;

        return $item;
    }

    public function figure()
    {
        if (isset($GLOBALS['tempavcache']['figure']))
            return $GLOBALS['tempavcache']['figure'];

        $item = Item::where('id', '=', $this->figure)->first();
        $tempcache['figure'] = $item;

        return $item;
    }

    public function reset()
    {
        $thumbnail = "thumbnails/{$this->image}.png";

        $this->timestamps = false;
        $this->image = 'default';
        $this->hat_1 = null;
        $this->hat_2 = null;
        $this->hat_3 = null;
        $this->hat_4 = null;
        $this->hat_5 = null;
        $this->head = null;
        $this->face = null;
        $this->tool = null;
        $this->tshirt = null;
        $this->shirt = null;
        $this->pants = null;
        $this->figure = null;
        $this->color_head = '#f3b700';
        $this->color_torso = '#c60000';
        $this->color_left_arm = '#f3b700';
        $this->color_right_arm = '#f3b700';
        $this->color_left_leg = '#650013';
        $this->color_right_leg = '#650013';
        $this->save();

        if (Storage::exists($thumbnail))
            Storage::delete($thumbnail);
    }
}