<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;

class MemberController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:members,email|max:255',
            'profession' => 'required|string|max:255',
            'company' => 'nullable|string|max:255',
            'linkedin_url' => 'nullable|url|max:255',
            'status' => 'required|in:active,inactive',
        ]);
        Member::create($request->all());
        return redirect()->route('members.index')->with('success', 'Member added successfully!');
    }

    public function index(Request $request)
    {
        $query = Member::query();
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($subQuery) use ($search) {
                $subQuery->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');
            });
        }
        if ($request->filled('profession')) {
            $query->where('profession', 'like', '%' . $request->profession . '%');
        }
        if ($request->filled('company')) {
            $query->where('company', 'like', '%' . $request->company . '%');
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        $members = $query->paginate(10);
        return view('members.index', compact('members'));
    }

    public function create()
    {
        return view('members.create');
    }

    public function edit($id)
    {
        $member = Member::findOrFail($id);
        return view('members.edit', compact('member'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:members,email,' . $id . '|max:255',
            'profession' => 'required|string|max:255',
            'company' => 'nullable|string|max:255',
            'linkedin_url' => 'nullable|url|max:255',
            'status' => 'required|in:active,inactive',
        ]);
        $member = Member::findOrFail($id);
        $member->update($request->all());
        return redirect()->route('members.index')->with('success', 'Member updated successfully!');
    }

    public function destroy($id)
    {
        $member = Member::findOrFail($id);
        $member->delete();
        return redirect()->route('members.index')->with('success', 'Member deleted successfully!');
    }

    public function export()
    {
        $headers = [
            'Content-Type' => 'text/csv',
        ];

        return response()->streamDownload(function () {
            $csv = fopen('php://output', 'w');
            fputcsv($csv, ['Name', 'Email', 'Profession', 'Company', 'Status']);

            $members = Member::all();
            foreach ($members as $member) {
                fputcsv($csv, [
                    $member->name,
                    $member->email,
                    $member->profession,
                    $member->company,
                    $member->status,
                ]);
            }

            fclose($csv);
        }, 'members.csv', $headers);
    }
}
