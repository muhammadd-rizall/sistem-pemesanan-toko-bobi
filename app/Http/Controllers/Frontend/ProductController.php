<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Data dummy untuk halaman dashboard

        $products = [
            ['id' => 1, 'name' => 'Keramik Lantai', 'price' => 'Rp 249.000', 'image' => asset('storage/products/keramik.jpeg')],
            ['id' => 2, 'name' => 'Wastafel', 'price' => 'Rp 189.000', 'image' => asset('storage/products/wastafel.jpg')],
            ['id' => 3, 'name' => 'Shower Mandi', 'price' => 'Rp 320.000', 'image' => asset('storage/products/shower.jpg')],
            ['id' => 4, 'name' => 'Pintu Kamar Mandi', 'price' => 'Rp 450.000', 'image' => asset('storage/products/pintu.jpg')],
            ['id' => 5, 'name' => 'Kloset Duduk', 'price' => 'Rp 299.000', 'image' => asset('storage/products/kloset.jpg')],
            ['id' => 6, 'name' => 'Step Nosing Tangga', 'price' => 'Rp 150.000', 'image' => asset('storage/products/stepnosing.jpg')],
        ];

        return view('frontend.index', compact('products'));
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
        // Data dummy untuk halaman detail
        $product = [
            'id' => $id,
            'name' => 'Bohemian Vase',
            'price' => 'Rp 249.000',
            'image' => 'https://via.placeholder.com/800x800.png/A3B18A/344E41?text=Vase',
            'description' => 'A beautifully handcrafted bohemian vase that adds a touch of rustic elegance to any room. Made from recycled glass with intricate details, perfect for your favorite flowers or as a standalone decorative piece.',
            'sizes' => ['Small', 'Medium', 'Large'],
            'colors' => ['Sage Green', 'Cream White', 'Terracotta'],
            'stock' => 15
        ];

        return view('frontend.show', compact('product'));
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
}
