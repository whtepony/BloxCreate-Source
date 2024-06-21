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

namespace App\Http\Controllers\Admin;

use App\Models\Item;
use Illuminate\Http\Request;
use App\Jobs\RenderItem;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AssetApprovalController extends Controller
{
    public function index()
    {
        if (Auth::user()->power < 2) {
            abort(404);
        }

        $total = Item::where('status', '=', 'pending')->count();
        $items = Item::where('status', '=', 'pending')->with(['creator'])->orderBy('id', 'DESC')->get();

        return view('admin.asset-approval')->with([
            'total' => $total,
            'items' => $items
        ]);
    }

    public function update(Request $request)
    {
        $allowedActions = ['accept', 'decline'];

        if (!isset($request->item_id)) {
            abort(404);
        }

        if (!Item::where([['id', '=', $request->item_id], ['status', '=', 'pending']])->exists()) {
            abort(404);
        }

        if (!in_array($request->action, $allowedActions) || Auth::user()->power < 2) {
            abort(404);
        }

        $item = Item::where('id', '=', $request->item_id)->first();
        $item->timestamps = false;

        if ($request->action == 'accept') {
            RenderItem::dispatch($item->id);

            $item->status = 'accepted';
            $item->update();

            return back()->with('success_message', 'Item has been accepted.');
        } else if ($request->action == 'decline') {
            $item->status = 'declined';
            $item->update();

            return back()->with('success_message', 'Item has been declined.');
        }
    }
}
