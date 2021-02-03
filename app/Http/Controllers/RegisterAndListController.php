<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RegisterAndListController extends Controller
{
    public function list()
    {
        $user = User::query()->get();
        return response()->json($user);
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required',
            'name' => 'required',
        ]);

        $user = User::query()->where('id', $request->id)->get()->first();

        if($user){
            return $user->update([
                'name' => $request->name
            ]);
        } else {
            return User::create([
                'id' => $request->id,
                'name' => $request->name
            ]);
        }
    }
}
?>