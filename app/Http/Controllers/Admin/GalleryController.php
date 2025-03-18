<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Gallery;
use App\Models\Admin\Configuration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class GalleryController extends Controller
{
    public function index()
    {
        $configuration = Configuration::first();
        $gallerys = Gallery::orderBy('created_at', 'desc')->get();
        return view('backend.admin.gallery.index', compact('configuration', 'gallerys'));
    }

    public function create()
    {
        $configuration = Configuration::first();
        return view('backend.admin.gallery.create', compact('configuration'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp',
        ]);

        $imagegallery = null;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imageName = time() . '_' . $file->getClientOriginalName();
            $file->move(('uploads/gallerys'), $imageName);
            $imagegallery = 'uploads/gallerys/' . $imageName;
        }
        
        Gallery::create([
            'image' => $imagegallery,
        ]);        

        return redirect()->route('gallery.index')->with('success', 'Gallery saved successfully.');
    }

    public function edit($id)
    {
        $configuration = Configuration::first();
        $gallery = Gallery::findOrFail($id);
        return view('backend.admin.gallery.edit', compact('configuration', 'gallery'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp',
        ]);
    
        $data = Gallery::findOrFail($id);
    
        if ($request->hasFile('image')) {
            if ($data->image) {
                $oldImagePath = public_path($data->image);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/gallerys'), $imageName);

            $data->image = 'uploads/gallerys/' . $imageName;
        }
    
        $data->save(); 
    
        return redirect()->route('gallery.index')->with('success', 'Gallery updated successfully.');
    }

    public function destroy($id)
    {
        $data = Gallery::findOrFail($id);

        if (file_exists(($data->image))) {
            unlink(($data->image));
        }

        $data->delete();

        return redirect()->back()->with('success', 'Gallery deleted successfully.');
    }
}
