<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Configuration;
use App\Models\Admin\History;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index()
    {
        $configuration = Configuration::first();
        $historys = History::orderBy('created_at', 'desc')->get();
        return view('backend.admin.history.index', compact('configuration', 'historys'));
    }

    public function create()
    {
        $configuration = Configuration::first();
        return view('backend.admin.history.create', compact('configuration'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);
    
        History::create([
            'title' => $request->title,
            'description' => $request->description,
        ]);
    
        return redirect()->route('history.index')->with('success', 'History added successfully!');
    }    

    public function edit($id)
    {
        $configuration = Configuration::first();
        $history = History::findOrFail($id);
        return view('backend.admin.history.edit', compact('configuration', 'history'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
        ]);

        $data = history::findOrFail($id);

        $data->title = $request->title;
        $data->description = $request->description;
        $data->save();

        return redirect()->route('history.index')->with('success', 'History updated successfully.');
    }

    public function destroy($id)
    {
        $data = History::findOrFail($id);
        $data->delete();

        return redirect()->back()->with('success', 'History deleted successfully.');
    }
}
