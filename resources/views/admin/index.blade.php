@extends('admin.layouts.app')

@section('content')
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-sage-800">Dashboard</h1>
        <p class="text-sage-600 mt-1">Selamat datang kembali, Admin! Berikut ringkasan aktivitas toko Anda.</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white p-6 rounded-xl shadow-md transform hover:-translate-y-1 transition-transform duration-300 ease-in-out">
            <div class="flex justify-between items-start">
                <div class="flex flex-col">
                    <p class="text-sm font-medium text-gray-500">Total Pendapatan</p>
                    <p class="text-3xl font-bold text-sage-800 mt-1">Rp 12.5jt</p>
                </div>
                <div class="bg-sage-100 p-3 rounded-full">
                    <svg class="w-6 h-6 text-sage-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v.01"></path></svg>
                </div>
            </div>
            <p class="text-xs text-green-500 mt-4 flex items-center">
                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd"></path></svg>
                <span>12.5%</span>
                <span class="text-gray-400 ml-1">dari bulan lalu</span>
            </p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-md transform hover:-translate-y-1 transition-transform duration-300 ease-in-out">
            <div class="flex justify-between items-start">
                <div class="flex flex-col">
                    <p class="text-sm font-medium text-gray-500">Total Pesanan</p>
                    <p class="text-3xl font-bold text-sage-800 mt-1">350</p>
                </div>
                <div class="bg-blue-100 p-3 rounded-full">
                     <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                </div>
            </div>
             <p class="text-xs text-green-500 mt-4 flex items-center">
                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd"></path></svg>
                <span>8.2%</span>
                <span class="text-gray-400 ml-1">dari bulan lalu</span>
            </p>
        </div>

        {{-- Anda bisa menambahkan 2 kartu lainnya di sini dengan pola yang sama --}}
    </div>

    <div class="mt-10 bg-white p-6 rounded-xl shadow-md">
        <h2 class="text-xl font-bold text-sage-800 mb-4">Pesanan Terbaru</h2>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="text-sm font-semibold text-gray-500 border-b-2 border-sage-100">
                        <th class="py-3 px-4">ID Pesanan</th>
                        <th class="py-3 px-4">Pelanggan</th>
                        <th class="py-3 px-4">Tanggal</th>
                        <th class="py-3 px-4">Total</th>
                        <th class="py-3 px-4 text-center">Status</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    <tr class="border-b border-sage-100 hover:bg-sage-50 transition-colors">
                        <td class="py-4 px-4 font-medium">#12345</td>
                        <td class="py-4 px-4">John Doe</td>
                        <td class="py-4 px-4">29 Sep 2025</td>
                        <td class="py-4 px-4 font-semibold">Rp 450.000</td>
                        <td class="py-4 px-4 text-center"><span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-medium">Selesai</span></td>
                    </tr>
                    <tr class="border-b border-sage-100 hover:bg-sage-50 transition-colors">
                        <td class="py-4 px-4 font-medium">#12344</td>
                        <td class="py-4 px-4">Jane Smith</td>
                        <td class="py-4 px-4">29 Sep 2025</td>
                        <td class="py-4 px-4 font-semibold">Rp 250.000</td>
                        <td class="py-4 px-4 text-center"><span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-medium">Dikirim</span></td>
                    </tr>
                    <tr class="border-b border-sage-100 hover:bg-sage-50 transition-colors">
                        <td class="py-4 px-4 font-medium">#12343</td>
                        <td class="py-4 px-4">Mike Johnson</td>
                        <td class="py-4 px-4">28 Sep 2025</td>
                        <td class="py-4 px-4 font-semibold">Rp 750.000</td>
                        <td class="py-4 px-4 text-center"><span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-medium">Diproses</span></td>
                    </tr>
                     <tr class="hover:bg-sage-50 transition-colors">
                        <td class="py-4 px-4 font-medium">#12342</td>
                        <td class="py-4 px-4">Sarah Lee</td>
                        <td class="py-4 px-4">27 Sep 2025</td>
                        <td class="py-4 px-4 font-semibold">Rp 150.000</td>
                        <td class="py-4 px-4 text-center"><span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-medium">Dibatalkan</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
