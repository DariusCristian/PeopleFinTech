<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class SuccessStoryController extends Controller
{
    public function index(Member $member)
    {
        $stories = $member->successStories()->latest()->get();
        return view('success_stories.index', compact('member', 'stories'));
    }

    public function store(Request $request, Member $member)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'story' => 'required|string',
        ]);

        $member->successStories()->create($validated);

        return redirect()
            ->route('members.success-stories.index', $member)
            ->with('success', 'Success story added successfully!');
    }
}
