<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewsController extends Controller
{
    /* =========================
     * LIST REVIEW CUSTOMER
     * ========================= */
    public function index()
    {
        $reviews = Review::where('customer_id', auth('customer')->id())
            ->with(['order', 'produk'])
            ->latest()
            ->get();

        return view('frontend.review.index', compact('reviews'));
    }

    /* =========================
     * FORM BUAT REVIEW
     * ========================= */
    public function createReview(Order $order)
    {
        abort_if($order->customer_id !== auth('customer')->id(), 403);
        abort_if($order->review, 403);

        $product = $order->orderItems->first()?->product;

        abort_if(!$product, 404);

        return view('frontend.review.review', compact('order', 'product'));
    }

    /* =========================
     * SIMPAN REVIEW
     * ========================= */
    public function store(Request $request, Order $order)
    {
        abort_if($order->customer_id !== auth('customer')->id(), 403);
        abort_if($order->review, 403);

        $request->validate([
            'produk_id' => 'required|exists:produks,id',
            'rating'    => 'required|integer|min:1|max:5',
            'comment'   => 'nullable|string',
        ]);

        Review::create([
            'order_id'    => $order->id,
            'produk_id'   => $request->produk_id,
            'customer_id' => auth('customer')->id(),
            'rating'      => $request->rating,
            'comment'     => $request->comment,
        ]);

        return redirect()
            ->route('customer.dashboard')
            ->with('success', 'Review berhasil dikirim');
    }
    /* =========================
     * FORM EDIT REVIEW
     * ========================= */
    public function edit(Review $review)
    {
        abort_if($review->customer_id !== auth('customer')->id(), 403);

        $order = $review->order;
        $product = $review->produk;

        return view('frontend.review.edit_review', compact(
            'review',
            'order',
            'product'
        ));
    }

    /* =========================
     * UPDATE REVIEW
     * ========================= */
    public function update(Request $request, Review $review)
    {
        abort_if($review->customer_id !== auth('customer')->id(), 403);

        $request->validate([

            'rating'  => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);

        $review->update([
            'rating'  => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()
            ->route('customer.review.index')
            ->with('success', 'Review berhasil diperbarui');
    }
}
