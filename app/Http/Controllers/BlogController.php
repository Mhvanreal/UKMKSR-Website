<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class BlogController extends Controller
{
    public function index() {
        try {
            $blogs = Blog::latest()->get();
            return view('admin.blog.index', compact('blogs'));
        } catch (\Exception $e) {
            Log::error("Error load blog index: " . $e->getMessage());
            return back()->with('error', 'Gagal memuat data blog.');
        }
    }

    public function blogging() {
        try {
            $data = Blog::latest()
                ->paginate(6)
                ->through(function ($blog) {
                    $blog->description = Str::limit(strip_tags($blog->description), 100, '...');
                    return $blog;
                });

            return view('LandingPage.BlogPage', compact('data'));
        } catch (\Exception $e) {
            Log::error("Error load blog landing: " . $e->getMessage());
            return back()->with('error', 'Gagal memuat daftar blog.');
        }
    }

    public function edit($id){
        try {
            $blog = Blog::findOrFail($id);
            return view('admin.blog.update_blog', compact('blog'));
        } catch (\Exception $e) {
            Log::error("Error edit blog ID $id: " . $e->getMessage());
            return back()->with('error', 'Gagal mengambil data blog untuk diedit.');
        }
    }

    public function update(Request $request, $id){
        try {
            $request->validate([
                'judul' => 'required|string|max:255',
                'tanggal' => 'required|date',
                'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'deskripsi' => 'required|string',
            ]);

            $blog = Blog::findOrFail($id);

            if ($request->hasFile('gambar')) {
                if ($blog->images) {
                    Storage::disk('public')->delete($blog->images);
                }
                $blog->images = $request->file('gambar')->store('images', 'public');
            }

            $blog->title = $request->input('judul');
            $blog->description = $request->input('deskripsi');
            $blog->created_at = $request->input('tanggal');
            $blog->save();

            return redirect()->route('blogadmin.index')->with('success', 'Blog berhasil diperbarui!');
        } catch (\Exception $e) {
            Log::error("Error update blog ID $id: " . $e->getMessage());
            return back()->withInput()->with('error', 'Gagal memperbarui blog.');
        }
    }

    public function create() {
        try {
            return view('admin.blog.create_blog');
        } catch (\Exception $e) {
            Log::error("Error open blog create view: " . $e->getMessage());
            return back()->with('error', 'Gagal membuka halaman tambah blog.');
        }
    }

    public function store(Request $request) {
        try {
            $request->validate([
                'judul' => 'required|string|max:255',
                'tanggal' => 'required|date',
                'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'deskripsi' => 'required|string',
            ]);

            $imagePath = null;
            if ($request->hasFile('gambar')) {
                $imagePath = $request->file('gambar')->store('images', 'public');
            }

            Blog::create([
                'title' => $request->input('judul'),
                'description' => $request->input('deskripsi'),
                'images' => $imagePath,
                'created_at' => Carbon::createFromFormat('Y-m-d', $request->input('tanggal')),
            ]);

            return redirect()->route('blogadmin.index')->with('success', 'Blog berhasil ditambahkan!');
        } catch (\Exception $e) {
            Log::error("Error store blog: " . $e->getMessage());
            return back()->withInput()->with('error', 'Gagal menambahkan blog.');
        }
    }

    public function destroy($id){
        try {
            $blog = Blog::findOrFail($id);

            if ($blog->images) {
                Storage::disk('public')->delete($blog->images);
            }

            $blog->delete();
            return redirect()->route('blogadmin.index')->with('success', 'Blog berhasil dihapus');
        } catch (\Exception $e) {
            Log::error("Error delete blog ID $id: " . $e->getMessage());
            return back()->with('error', 'Gagal menghapus blog.');
        }
    }

    public function detail($id){
        try {
            $blog = Blog::findOrFail($id);
            $blog->description = html_entity_decode($blog->description);
            return view('admin.blog.showBlog', compact('blog'));
        } catch (\Exception $e) {
            Log::error("Error detail blog ID $id: " . $e->getMessage());
            return back()->with('error', 'Gagal menampilkan detail blog.');
        }
    }

    public function search(Request $request) {
        try {
            $query = $request->input('query');

            $data = Blog::where('title', 'LIKE', "%$query%")
                        ->latest()
                        ->paginate(6);

            return view('LandingPage.BlogPage', compact('data'));
        } catch (\Exception $e) {
            Log::error("Error search blog: " . $e->getMessage());
            return back()->with('error', 'Gagal mencari blog.');
        }
    }

    public function show($id){
        try {
            $blog = Blog::findOrFail($id);
            $blog->description = html_entity_decode($blog->description);
            return view('admin.blog.detail', compact('blog'));
        } catch (\Exception $e) {
            Log::error("Error show blog ID $id: " . $e->getMessage());
            return back()->with('error', 'Gagal menampilkan blog.');
        }
    }

}
