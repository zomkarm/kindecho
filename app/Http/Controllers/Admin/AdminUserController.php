<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $users = User::where('is_admin', false)
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString(); // Keeps the search value in pagination links

        return view('admin.users.index', compact('users', 'search'));
    }

    public function destroy(User $user)
    {
        if ($user->is_admin) {
            return back()->with('error', 'Cannot delete an admin user.');
        }

        $user->delete();
        return back()->with('success', 'User deleted successfully.');
    }
}
