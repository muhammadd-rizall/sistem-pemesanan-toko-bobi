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
            ['id' => 1, 'name' => 'Bohemian Vase', 'price' => 'Rp 249.000', 'image' => 'https://via.placeholder.com/500x500.png/A3B18A/344E41?text=Vase'],
            ['id' => 2, 'name' => 'Linen Throw Pillow', 'price' => 'Rp 189.000', 'image' => 'https://via.placeholder.com/500x500.png/DAD7CD/344E41?text=Pillow'],
            ['id' => 3, 'name' => 'Ceramic Mug Set', 'price' => 'Rp 320.000', 'image' => 'https://via.placeholder.com/500x500.png/A3B18A/344E41?text=Mug'],
            ['id' => 4, 'name' => 'Wooden Desk Lamp', 'price' => 'Rp 450.000', 'image' => 'https://via.placeholder.com/500x500.png/DAD7CD/344E41?text=Lamp'],
            ['id' => 5, 'name' => 'Minimalist Wall Clock', 'price' => 'Rp 299.000', 'image' => 'https://via.placeholder.com/500x500.png/A3B18A/344E41?text=Clock'],
            ['id' => 6, 'name' => 'Scented Soy Candle', 'price' => 'Rp 150.000', 'image' => 'https://via.placeholder.com/500x500.png/DAD7CD/344E41?text=Candle'],
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
