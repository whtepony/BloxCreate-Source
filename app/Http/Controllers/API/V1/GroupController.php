<?php 

namespace App\Http\Controllers\API\V1;

use App\Models\User;
use App\Models\Group;
use App\Models\GroupMember;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GroupController extends Controller
{
    public function groupMembers(Request $request, $id, $rank)
    {
        $group = Group::find($id);

        if (!$group) {
            return response()->json(['success' => false, 'message' => 'Group not found.'], 404);
        }

        $members = $group->members()->where('rank', $rank)->with('user')->orderBy('created_at', 'desc')->paginate(12);

        $data = [];
        foreach ($members as $member) {
            $data[] = [
                'id' => $member->user->id,
                'username' => $member->user->username,
                'avatar' => $member->user->thumbnail(),
            ];
        }

        return response()->json([
            'members' => $data,
            'pagination' => [
                'current_page' => $members->currentPage(),
                'last_page' => $members->lastPage(),
                'total' => $members->total(),
            ],
        ]);
    }
}