<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminSettingController extends Controller
{
    public function edit()
    {
        $admin = auth()->user();
        return view('admin.settings.edit', compact('admin'));
    }

    public function update(Request $request)
    {
        $admin = auth()->user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore($admin->id),
            ],
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $admin->name = $validated['name'];
        $admin->email = $validated['email'];

        if (!empty($validated['password'])) {
            $admin->password = Hash::make($validated['password']);
        }

        $admin->save();

        return redirect()->route('admin.settings.edit')->with('success', 'Profile updated successfully.');
    }
}
