@extends('frontend.layouts.app')

@section('content')
<div class="container mx-auto px-6 py-12">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-start">
        <div class="overflow-hidden rounded-lg">
             <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}" class="w-full h-auto object-cover transform hover:scale-105 transition-transform duration-500 ease-in-out">
        </div>

        <div>
            <h1 class="text-4xl font-bold text-slate-green mb-4">{{ $product['name'] }}</h1>
            <p class="text-2xl text-sage mb-6">{{ $product['price'] }}</p>
            <p class="text-gray-600 leading-relaxed mb-8">{{ $product['description'] }}</p>

            <div class="mb-6">
                <h3 class="text-sm font-semibold uppercase mb-3">Color</h3>
                <div class="flex space-x-3">
                    @foreach($product['colors'] as $color)
                    <button class="w-8 h-8 rounded-full border-2 border-transparent focus:outline-none focus:ring-2 focus:ring-sage focus:ring-offset-2" style="background-color: {{ str_replace(' ', '', strtolower($color)) }}"></button>
                    @endforeach
                </div>
            </div>

            <div class="mb-8">
                 <h3 class="text-sm font-semibold uppercase mb-3">Size</h3>
                 <div class="flex space-x-3">
                    @foreach($product['sizes'] as $size)
                     <button class="px-4 py-2 border border-gray-300 rounded-md text-sm hover:border-sage hover:bg-sage hover:text-white transition duration-300 focus:outline-none focus:ring-2 focus:ring-sage focus:ring-offset-2">{{ $size }}</button>
                    @endforeach
                 </div>
            </div>

            <div class="flex items-center space-x-6">
                <span class="text-sm text-gray-500">Stock: {{ $product['stock'] }}</span>
                 <button class="bg-slate-green text-white font-semibold py-3 px-8 rounded-lg hover:bg-sage transition-all duration-300 transform hover:scale-105">
                    Add to Cart
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
