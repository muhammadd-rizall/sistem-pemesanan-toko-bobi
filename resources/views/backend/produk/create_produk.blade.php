@extends('layout.app')
@section('content')
    <div class="max-w-4xl mx-auto px-4 py-6">
        <div class="bg-white rounded-3xl shadow-2xl p-8">
            <h3 class="text-3xl font-bold mb-8 text-gray-800 text-center">Input Item Produk</h3>
            <form action="#" method="post" enctype="multipart/form-data">
                    @csrf
            </form>
        </div>
    </div>
@endsection
