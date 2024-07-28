<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Name;

class NameController extends Controller
{
    public function create()
    {
        return view('create_name');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $name = new Name();
        $name->name = $request->name;
        $name->save();

        return redirect()->back()->with('success', 'Name added successfully!');
    }
}
