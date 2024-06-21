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

namespace App\Http\Controllers\Account;

use App\Models\Item;
use App\Jobs\RenderUser;
use App\Models\Inventory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CharacterController extends Controller
{
    public function index()
    {
        return view('account.character');
    }

    public function src()
    {
        if (!settings('character_enabled')) {
            return response()->json(['success' => false, 'message' => 'Character Customization is currently disabled.']);
        }

        return response()->json([
            'avatar' => Auth::user()->thumbnail(),
            'headshot' => Auth::user()->headshot()
        ]);
    }

    public function update(Request $request)
    {
        if (!settings('character_enabled')) {
            return response()->json(['success' => false, 'message' => 'Character Customization is currently disabled.']);
        }

        $allowedActions = ['wear', 'unwear', 'color', 'angle'];

        if (!in_array($request->action, $allowedActions)) {
            return response()->json(['success' => false, 'message' => 'Invalid action.']);
        }

        $user = Auth::user()->avatar();

        if ($request->action == 'wear') {
            if (!isset($request->item_id)) {
                return response()->json(['success' => false, 'message' => 'No item ID provided.']);
            }

            if (!Item::where('id', '=', $request->item_id)->exists()) {
                return response()->json(['success' => false, 'message' => 'Item does not exist.']);
            }

            if (!Inventory::where([['item_id', '=', $request->item_id], ['user_id', '=', Auth::user()->id]])->exists()) {
                return response()->json(['success' => false, 'message' => 'You do not own this item.']);
            }

            $item = Item::where('id', '=', $request->item_id)->first();

            if ($item->status != 'accepted') {
                return response()->json(['success' => false, 'message' => 'This item is not approved.']);
            }

            switch ($item->type) {
                case 'hat':
                    if (empty($user->hat_1)) {
                        $column = 'hat_1';
                    } else if (empty($user->hat_2)) {
                        $column = 'hat_2';
                    } else if (empty($user->hat_3)) {
                        $column = 'hat_3';
                    } else {
                        $column = 'hat_1';
                    }
                    break;
                case 'face':
                    $column = 'face';
                    break;
                case 'accessory':
                    $column = 'tool';
                    break;
                case 'tshirt':
                    $column = 'tshirt';
                    break;
                case 'shirt':
                    $column = 'shirt';
                    break;
                case 'pants':
                    $column = 'pants';
                    break;
                case 'head':
                    $column = 'head';
                    break;
            }

            if ($column == 'hat_1' || $column == 'hat_2' || $column == 'hat_3') {
                if ($user->hat_1 == $request->item_id || $user->hat_2 == $request->item_id || $user->hat_3 == $request->item_id) {
                    return response()->json(['success' => true]);
                }
            }

            if ($user->{$column} == $request->item_id) {
                return response()->json(['success' => true]);
            }

            $user->{$column} = $request->item_id;
            $user->save();

            RenderUser::dispatch(Auth::user()->id);

            return response()->json(['success' => true]);
        } else if ($request->action == 'unwear') {
            $allowedTypes = ['hat_1', 'hat_2', 'hat_3', 'face', 'tool', 'accessory', 'tshirt', 'shirt', 'pants', 'head'];

            if (!in_array($request->type, $allowedTypes)) {
                return response()->json(['success' => false, 'message' => 'Invalid type.']);
            }

            if (!isset($request->type)) {
                return response()->json(['success' => false, 'message' => 'No type provided.']);
            }

            if ($request->type == 'accessory') {
                $user->tool = null;
            } else {
                $user->{$request->type} = null;
            }

            $user->save();

            RenderUser::dispatch(Auth::user()->id);

            return response()->json(['success' => true]);
        } else if ($request->action == 'color') {
            $allowedParts = ['head', 'torso', 'left_arm', 'right_arm', 'left_leg', 'right_leg'];

            $allowedColors = [
                'brown'                         => '#8d5524',
                'light-brown'                   => '#c68642',
                'lighter-brown'                 => '#e0ac69',
                'lighter-lighter-brown'         => '#f1c27d',
                'lighter-lighter-lighter-brown' => '#fce1d5',

                'salmon'                        => '#f19d9a',
                'blue'                          => '#769fca',
                'light-blue'                    => '#a2d1e6',
                'purple'                        => '#a08bd0',
                'dark-purple'                   => '#312b4c',

                'dark-green'                    => '#046306',
                'green'                         => '#1b842c',
                'yellow'                        => '#f7b155',
                'orange'                        => '#f79039',
                'red'                           => '#ff0000',

                'light-pink'                    => '#f8a3d5',
                'pink'                          => '#ff0e9a',
                'white'                         => '#f1efef',
                'gray'                          => '#7d7d7d',
                'black'                         => '#000000'
            ];

            if (!in_array($request->part, $allowedParts)) {
                return response()->json(['success' => false, 'message' => 'Invalid part.']);
            }

            if (!array_key_exists($request->color, $allowedColors)) {
                return response()->json(['success' => false, 'message' => 'Invalid color.']);
            }

            if ($user->{'rgb_' . $request->part} == $allowedColors[$request->color]) {
                return response()->json(['success' => true]);
            }

            $user->{'color_' . $request->part} = $allowedColors[$request->color];
            $user->save();

            RenderUser::dispatch(Auth::user()->id);

            return response()->json(['success' => true]);
        } else if ($request->action == 'angle') {
            $allowedAngles = ['left', 'right'];

            if (!in_array($request->angle, $allowedAngles)) {
                return response()->json(['success' => false, 'message' => 'Invalid angle.']);
            }

            if ($user->angle == $request->angle) {
                return response()->json(['success' => true]);
            }

            $user->angle = $request->angle;
            $user->save();

            RenderUser::dispatch(Auth::user()->id);

            return response()->json(['success' => true]);
        }
    }

    public function inventory(Request $request)
    {
        if (!settings('character_enabled')) {
            return response()->json(['success' => false, 'message' => 'Character Customization is currently disabled.']);
        }

        $user = Auth::user();

        $allowedCategories = ['hat' => 'hats', 'face' => 'faces', 'accessory' => 'accessories', 'tshirt' => 't-shirts', 'shirt' => 'shirts', 'pants' => 'pants', 'heads' => 'heads'];

        if (!in_array($request->category, $allowedCategories)) {
            return response()->json(['success' => false, 'message' => 'Invalid category.']);
        }

        $type = array_search($request->category, $allowedCategories);
        $items = Item::where([['type', '=', $type], ['status', '=', 'accepted']])
            ->join('inventories', 'inventories.item_id', '=', 'items.id')
            ->where('inventories.user_id', '=', Auth::user()->id)
            ->orderBy('inventories.created_at', 'DESC')
            ->paginate(8);

        if ($items->count() == 0) {
            return response()->json(['success' => false, 'message' => 'No ' . $allowedCategories[$type] . ' found.']);
        }

        $json = [
            'current_page' => $items->currentPage(),
            'total_pages' => $items->lastPage(),
            'items' => []
        ];

        foreach ($items as $item) {
            $json['items'][] = [
                'id' => $item->item_id,
                'name' => $item->name,
                'thumbnail_url' => $item->thumbnail()
            ];
        }

        return response()->json($json);
    }

    public function wearing()
    {
        if (!settings('character_enabled')) {
            return response()->json(['success' => false, 'message' => 'Character Customization is currently disabled.']);
        }

        $user = Auth::user()->avatar();

        if (empty($user->hat_1) && empty($user->hat_2) && empty($user->hat_3) && empty($user->face) && empty($user->tool) && empty($user->tshirt) && empty($user->shirt) && empty($user->pants) && empty($user->head)) {
            return response()->json(['success' => false, 'message' => 'You are not wearing any items.']);
        }

        $json = [];

        if (!empty($user->hat_1)) {
            $item = Item::where('id', '=', $user->hat_1)->first();
            $json[] = ['id' => $user->hat_1, 'name' => $item->name, 'thumbnail_url' => $item->thumbnail(), 'type' => 'hat_1'];
        }

        if (!empty($user->hat_2)) {
            $item = Item::where('id', '=', $user->hat_2)->first();
            $json[] = ['id' => $user->hat_2, 'name' => $item->name, 'thumbnail_url' => $item->thumbnail(), 'type' => 'hat_2'];
        }

        if (!empty($user->hat_3)) {
            $item = Item::where('id', '=', $user->hat_3)->first();
            $json[] = ['id' => $user->hat_3, 'name' => $item->name, 'thumbnail_url' => $item->thumbnail(), 'type' => 'hat_3'];
        }

        if (!empty($user->face)) {
            $item = Item::where('id', '=', $user->face)->first();
            $json[] = ['id' => $user->face, 'name' => $item->name, 'thumbnail_url' => $item->thumbnail(), 'type' => 'face'];
        }

        if (!empty($user->tool)) {
            $item = Item::where('id', '=', $user->tool)->first();
            $json[] = ['id' => $user->tool, 'name' => $item->name, 'thumbnail_url' => $item->thumbnail(), 'type' => 'accessory'];
        }

        if (!empty($user->tshirt)) {
            $item = Item::where('id', '=', $user->tshirt)->first();
            $json[] = ['id' => $user->tshirt, 'name' => $item->name, 'thumbnail_url' => $item->thumbnail(), 'type' => 'tshirt'];
        }

        if (!empty($user->shirt)) {
            $item = Item::where('id', '=', $user->shirt)->first();
            $json[] = ['id' => $user->shirt, 'name' => $item->name, 'thumbnail_url' => $item->thumbnail(), 'type' => 'shirt'];
        }

        if (!empty($user->pants)) {
            $item = Item::where('id', '=', $user->pants)->first();
            $json[] = ['id' => $user->pants, 'name' => $item->name, 'thumbnail_url' => $item->thumbnail(), 'type' => 'pants'];
        }

        if (!empty($user->head)) {
            $item = Item::where('id', '=', $user->head)->first();
            $json[] = ['id' => $user->head, 'name' => $item->name, 'thumbnail_url' => $item->thumbnail(), 'type' => 'head'];
        }

        return response()->json($json);
    }
}