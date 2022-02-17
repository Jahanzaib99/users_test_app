<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Trait\Transformer;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    use Transformer;
    // all users
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(5);
        $meta = Transformer::transformCollection($users);
        $collection = $users->map(function($data) {
            return $data;
        });
        $users = $collection->toArray();
        
        
        return ['data' => $users, 'meta' => $meta];
    }
  
    // edit user
    public function edit($id)
    {
        $user = User::find($id);
        return response()->json($user);
    }
  
    // update user
    public function update($id, Request $request)
    {
        $user = User::find($id);
        $user->update($request->all());
  
        return response()->json('user successfully updated');
    }
  
    // delete user
    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();
  
        return response()->json('user successfully deleted');
    }

    public function export() 
    {
        return User::all();
    }
}
