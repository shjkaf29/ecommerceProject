<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\File;
use App\Models\UserOrder;

class UserController extends Controller
{
    
    public function viewUser()
    {
        $users = User::all();
        return view('admin.viewuser', compact('users'));
    }


    public function editUser($id)
    {
        $user = User::findOrFail($id);
        return view('admin.updateuser', compact('user'));
    }


    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$id,
            'role'  => 'nullable|string|max:50', 
        ]);

        $user->name  = $request->name;
        $user->email = $request->email;

        if ($request->filled('role')) {
            $user->role = $request->role;
        }

        $user->save();

        return redirect()->route('admin.viewuser')
                         ->with('user_message', 'User updated successfully!');
    }

   
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.viewuser')
                         ->with('user_message', 'User deleted successfully!');
    }

    public function dashboard()
    {
    return view('admin.dashboard'); 
    }

}
