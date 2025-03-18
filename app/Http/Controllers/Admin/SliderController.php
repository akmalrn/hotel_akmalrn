<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Slider;
use App\Models\Admin\Configuration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class SliderController extends Controller
{
    public function index()
    {
        $configuration = Configuration::first();
        $sliders = Slider::orderBy('created_at', 'desc')->get();
        return view('backend.admin.slider.index', compact('configuration', 'sliders'));
    }

    public function create()
    {
        $configuration = Configuration::first();
        return view('backend.admin.slider.create', compact('configuration'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp',
            'title' => 'required|string',
        ]);

        $imageSlider = null;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imageName = time() . '_' . $file->getClientOriginalName();
            $file->move(('uploads/sliders'), $imageName);
            $imageSlider = 'uploads/sliders/' . $imageName;
        }

        Slider::create([
            'image' => $imageSlider,
            'title' => $request->title,
        ]);

        return redirect()->route('slider.index')->with('success', 'Slider saved successfully.');
    }

    public function edit($id)
    {
        $configuration = Configuration::first();
        $slider = Slider::findOrFail($id);
        return view('backend.admin.slider.edit', compact('configuration', 'slider'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp',
            'title' => 'required|string',
        ]);

        $data = Slider::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($data->image) {
                $oldImagePath = ($data->image);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(('uploads/sliders'), $imageName);

            $data->image = 'uploads/sliders/' . $imageName;
        }

        $data->title = $request->title;
        $data->save();

        return redirect()->route('slider.index')->with('success', 'Slider updated successfully.');
    }

    public function destroy($id)
    {
        $data = Slider::findOrFail($id);

        if (file_exists(($data->image))) {
            unlink(($data->image));
        }

        $data->delete();

        return redirect()->back()->with('success', 'Slider deleted successfully.');
    }
}
