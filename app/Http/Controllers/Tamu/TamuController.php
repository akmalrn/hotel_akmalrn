<?php

namespace App\Http\Controllers\Tamu;

use App\Models\Admin\Configuration;
use App\Models\Admin\About;
use App\Models\Admin\Slider;
use App\Http\Controllers\Controller;
use App\Models\Admin\Blog;
use App\Models\Admin\Gallery;
use App\Models\Admin\History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TamuController extends Controller
{
    public function index()
    {
        $configuration = Configuration::first();
        $about = About::first();
        $sliders = Slider::all();
        $gallerys = Gallery::orderBy('created_at', 'desc')->limit(8)->get();
        $blogs = Blog::orderBy('created_at', 'desc')->limit(3)->get();
        return view('tamu.index', compact('configuration', 'about', 'sliders', 'gallerys', 'blogs'));
    }

    public function about()
    {
        $configuration = Configuration::first();
        $about = About::first();
        $gallerys = Gallery::orderBy('created_at', 'desc')->limit(8)->get();
        $historys = History::orderBy('created_at', 'desc')->get();
        return view('tamu.about', compact('configuration', 'about', 'gallerys', 'historys'));
    }

    public function blog()
    {
        $configuration = Configuration::first();
        $blogs = Blog::orderBy('created_at', 'desc')->paginate(5);
        return view('tamu.blog', compact('configuration', 'blogs'));
    }

    public function gallery()
    {
        $configuration = Configuration::first();
        $gallerys = Gallery::all();
        return view('tamu.gallery', compact('configuration', 'gallerys'));
    }

    public function contact()
    {
        $configuration = Configuration::first();
        return view('tamu.contact', compact('configuration'));
    }

    public function room()
    {
        $configuration = Configuration::first();
        return view('tamu.rooms', compact('configuration'));
    }

    public function reservation()
    {
        $configuration = Configuration::first();
        return view('tamu.reservation', compact('configuration'));
    }

    public function register()
    {
        $configuration = Configuration::first();
        return view('tamu.register', compact('configuration'));
    }

    public function login()
    {
        $configuration = Configuration::first();
        return view('tamu.login', compact('configuration'));
    }

    public function detail_blog($id)
    {
        $configuration = Configuration::first();
        $blog = Blog::findOrFail($id);
        $latestBlogs = Blog::orderBy('created_at', 'desc')->limit(5)->get();
        return view('tamu.detail_blog', compact('configuration', 'blog', 'latestBlogs'));
    }

    public function search(Request $request)
    {
        $query = $request->query('query');

        $blogs = Blog::query()
            ->when($query, function ($queryBuilder) use ($query) {
                return $queryBuilder->where('title', 'LIKE', "%{$query}%");
            })
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($blog) {
                $blog->image = asset($blog->image);
                return $blog;
            });

        return response()->json($blogs);
    }

    public function sendEmail(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'message' => 'required',
        ]);

        $configuration = Configuration::first(); 
        $emailTo = $configuration->email_address ?? 'default@example.com';

        try {
            Mail::raw(
                "Name: {$request->name}\nMessage: {$request->message}",
                function ($message) use ($request, $emailTo) {
                    $message->to($emailTo)
                            ->subject('New Contact Message from ' . $request->name)
                            ->replyTo($request->email);
                }
            );

            return back()->with('success', 'Email berhasil dikirim!');
        } catch (\Exception $e) {
            return back()->with('error', 'Email gagal dikirim: ' . $e->getMessage());
        }
    }
}
