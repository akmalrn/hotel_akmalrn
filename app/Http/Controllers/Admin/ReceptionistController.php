<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Admin;
use Illuminate\Http\Request;

class ReceptionistController extends Controller
{
    public function index()
    {
        $receptionists = Admin::where('role', 'Admin')->get();
        return view('backend.pricing.index', compact('receptionists'));
    }

    public function create()
    {
        return view('backend.admin.receptionists.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|string', 
            'password' => 'required|string|min:6|confirmed',
        ]);
        
        Admin::create([
            'name' => 'admin',
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'password_2' => $request->password,
            'role' => 'Admin',
        ]);

        return redirect()->route('receptionist.index')->with('success', 'Data saved successfully.');
    }

    public function edit($id)
    {
        $receptionist = Admin::findOrFail($id);
        return view('backend.admin.receptionists.edit', compact('receptionist'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'nullable|required|string|max:255',
            'description' => 'nullable|required|string',
            'overview' => 'nullable|',
        ]);

        $receptionist = Admin::findOrFail($id);

        $receptionist->update([
            'title' => $request->title,
            'description' => $request->description,
            'overview' =>  $request->overview,
        ]);

        return redirect()->route('receptionist.index')->with('success', 'Data updated successfully.');
    }

    public function destroy($id)
    {
        $receptionist = Admin::findOrFail($id);
        $receptionist->delete();

        return redirect()->back()->with('success', 'Data deleted successfully.');
    }
}
