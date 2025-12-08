<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer; // Menggunakan model Customer yang Anda berikan

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    // Menampilkan halaman daftar user
    public function userView(Request $request)
    {
        // 1. Mulai query dasar
        $query = Customer::latest();

        // 2. Cek apakah ada input pencarian dari View?
        if ($request->has('search') && $request->search != null) {
            $search = $request->search;

            // 3. Filter berdasarkan Nama ATAU Email
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%$search%")
                  ->orWhere('email', 'LIKE', "%$search%");
            });
        }

        // 4. Eksekusi query (bisa pakai get() atau paginate())
        $users = $query->get();

        // Kembalikan ke view
        return view('admin.backend.users.index', compact('users'));
    }

    // Menghapus user (Opsional, fitur tambahan)
    public function deleteUser($id)
    {
        $user = Customer::findOrFail($id);

        // Hapus foto jika ada (opsional, sesuaikan path penyimpanan Anda)
        // if ($user->avatar && file_exists(public_path($user->avatar))) {
        //    unlink(public_path($user->avatar));
        // }

        $user->delete();

        return redirect()->back()->with('success', 'Data User berhasil dihapus');
    }
}
