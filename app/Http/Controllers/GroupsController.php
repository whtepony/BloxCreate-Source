<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\GroupRank;
use App\Models\GroupMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use App\Http\Controllers\Controller;

class GroupsController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search ?? '';

        $groups = Group::where([
            ['name', 'LIKE', '%' . $search . '%'],
            ['disabled', '=', false]
        ])->orderBy('updated_at', 'ASC')->paginate(10);

        return view('groups.index')->with([
            'groups' => $groups
        ]);
    }

    public function show($id)
    {
        $group = Group::where('id', '=', $id)->firstOrFail();

        return view('groups.show')->with([
            'group' => $group
        ]);
    }

    public function createView()
    {
        return view('groups.create');
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => ['required', 'min:3', 'max:30', 'regex:/^[a-z0-9 .\-!,\':;<>?()\[\]+=\/]+$/i', 'unique:groups'],
            'description' => ['nullable', 'max:1024'],
            'image' => ['required', 'image', 'dimensions:min_width=100,min_height=100', 'mimes:png,jpg,jpeg', 'max:2048']
        ]);
    
        if (Auth::user()->currency_cash < 25) {
            return back()->withErrors(["You need 25 cash to create a group!"]);
        }
    
        $thumbnail_url = Str::random(25);
    
        $group = new Group;
        $group->owner_id = Auth::user()->id;
        $group->name = $request->name;
        $group->description = $request->description;
        $group->thumbnail_url = $thumbnail_url;
        $group->save();
    
        $groupRanks = [
            ['name' => 'Member', 'rank' => 1],
            ['name' => 'Moderator', 'rank' => 25],
            ['name' => 'Admin', 'rank' => 50],
            ['name' => 'Owner', 'rank' => 99]
        ];
    
        foreach ($groupRanks as $rank) {
            GroupRank::create([
                'group_id' => $group->id,
                'name' => $rank['name'],
                'rank' => $rank['rank']
            ]);
        }
    
        Auth::user()->currency_cash -= 25;
        Auth::user()->save();

        $member = new GroupMember;
        $member->user_id = Auth::user()->id;
        $member->group_id = $group->id;
        $member->rank = 99;
        $member->save();
    
        $image = Image::make($request->file('image'))->fit(420)->encode('png');
    
        if (!Storage::exists('thumbnails/groups/')) {
            Storage::makeDirectory('thumbnails/groups/');
        }
    
        $path = "thumbnails/groups/{$thumbnail_url}.png";
        Storage::put($path, $image);
    
        return redirect()->route('groups.show', $group->id)->with('success_message', 'Group created!');
    }

    public function updateStatus(Request $request)
    {
        $action = $request->input('action');
        $groupId = $request->input('id');
        $user = Auth::user();
    
        $group = Group::find($groupId);
    
        if (!$group) {
            return redirect()->back()->withErrors(['Group does not exist.']);
        }
    
        switch ($action) {
            case 'join':
                $memberAlready = GroupMember::where('group_id', $group->id)->where('user_id', $user->id)->exists();
                if ($memberAlready) {
                    return redirect()->back()->withErrors(['You are already in this group.']);
                }
    
                GroupMember::create([
                    'group_id' => $group->id,
                    'user_id' => $user->id,
                    'rank' => 1,
                ]);
    
                return redirect()->back()->with('success_message', 'You have joined this group.');
    
            case 'leave':
                if ($group->owner->id == $user->id) {
                    return redirect()->back()->withErrors(['You are the owner of this group.']);
                }
    
                $member = GroupMember::where('group_id', $group->id)->where('user_id', $user->id)->first();
    
                if (!$member) {
                    return redirect()->back()->withErrors(['You are not in this group.']);
                }
    
                $member->delete();
    
                return redirect()->back()->with('success_message', 'You have left this group.');
    
            default:
                return redirect()->back()->withErrors(['Invalid action']);
        }
    }    
}