<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function store(Request $request, $postId)
    {
        $request->validate(['reason' => 'nullable|string|max:500']);

        Report::create([
            'post_id' => $postId,
            'user_id' => Auth::id(),
            'reason' => $request->reason,
        ]);

        return back()->with('success', 'Post reported. Thank you!');
    }
}
