<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    public function categoryView(Request $request)
    {
        $search = $request->input('search');

        $datas = Category::when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                      ->orWhere('slug', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10);

        return view('admin.backend.category.data', compact('datas', 'search'));
    }

    public function createCategory()
    {
        return view('admin.backend.category.create');
    }

    public function storeCategory(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        // generate slug dari name
        $slug = Str::slug($validated['name']);

        // pastikan slug unik
        $count = Category::where('slug', 'like', $slug . '%')->count();
        if ($count > 0) {
            $slug .= '-' . ($count + 1);
        }

        Category::create([
            'name'        => $validated['name'],
            'description' => $validated['description'] ?? null,
            'slug'        => $slug,
        ]);

        return redirect()->route('categoryView')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function editCategory($id)
    {
        $data = Category::findOrFail($id);
        return view('admin.backend.category.edit', compact('data'));
    }

    public function updateCategory(Request $request, $id)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $slug = Str::slug($validated['name']);

        // cek slug unik kecuali data ini
        $count = Category::where('slug', 'like', $slug . '%')
            ->where('id', '!=', $id)
            ->count();

        if ($count > 0) {
            $slug .= '-' . ($count + 1);
        }

        $category = Category::findOrFail($id);
        $category->update([
            'name'        => $validated['name'],
            'description' => $validated['description'] ?? null,
            'slug'        => $slug,
        ]);

        return redirect()->route('categoryView')
            ->with('success', 'Kategori berhasil diupdate.');
    }

    public function deleteCategory($id)
    {
        Category::findOrFail($id)->delete();

        return redirect()->route('categoryView')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}
