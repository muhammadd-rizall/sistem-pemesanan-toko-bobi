<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{

    public function review(Request $request) {
        $search = $request->query('search');

        $datas = Review::when($search, function($query, $search){
            return $query->where('produk', function ($q) use ($search){
                $q->where('nama_produk', 'like', "%{$search}%");
            })
            ->orWhereHas('customer', function ($x) use ($search){
                $x->where('name', 'like', "%{$search}%");
            });
        })
        ->latest()
        ->paginate(10);

        return view('admin.backend.review.data', compact('datas','search'));
    }

     //
    // menghapus data review
    //
    public function deleteReview($id)
    {
        $data = Review::findOrFail($id);
        $data->delete();

        return redirect()->route('review')->with('success', 'review berhasil dihapus.');
    }
}
