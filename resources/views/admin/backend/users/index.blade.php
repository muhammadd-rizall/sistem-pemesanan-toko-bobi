@extends('admin.layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-6">

        @if (session('success'))
            <div id="success-alert"
                class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg shadow-md flex items-center justify-between"
                role="alert">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2 text-green-700" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.707a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span class="text-sm">{{ session('success') }}</span>
                </div>
                <button type="button" class="text-green-700 hover:text-green-900"
                    onclick="document.getElementById('success-alert').remove();">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M6 18L18 6M6 6l12 12" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        @endif

        <div class="animate-fade-in">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4 mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">Manajemen User</h1>
                    <p class="text-gray-600 mt-1">Kelola data pelanggan terdaftar di sistem Bobi Ceramic.</p>
                </div>

                <div class="flex items-center gap-4 w-full sm:w-auto">
                    <form action="{{ route('userView') }}" method="GET">
                        <div class="relative w-full sm:w-64">
                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Cari Pelanggan..."
                                class="w-full pl-10 pr-4 py-2.5 border-2 border-gray-200 rounded-full focus:outline-none focus:ring-2 focus:ring-green-400 transition-all duration-300">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </form>

                    <div class="hidden md:flex bg-white border-l-4 border-green-600 shadow-md px-5 py-2 rounded-r-lg items-center transform hover:-translate-y-0.5 transition-transform duration-300">
                        <div class="mr-3 text-right">
                            <div class="text-xs font-bold text-green-600 uppercase tracking-wide">Total User</div>
                            <div class="text-lg font-bold text-gray-800 leading-none">{{ count($users) }} User</div>
                        </div>
                        <div class="p-2 bg-green-50 rounded-full">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm sm:text-base divide-y divide-gray-100 table-fixed">
                        <thead class="bg-[#7eb17e] text-black uppercase text-xs tracking-wider">
                            <tr>
                                <th class="w-16 px-2 py-4 text-center font-bold">No</th>

                                <th class="w-24 px-2 py-4 text-center font-bold pl-10">Avatar</th>

                                <th class="w-1/4 px-2 py-4 text-left font-bold pl-28">Nama</th>

                                <th class="w-[30%] px-2 py-4 text-left font-bold hidden md:table-cell pl-20">Email</th>

                                <th class="w-auto px-2 py-4 text-center font-bold hidden md:table-cell pr-16">Bergabung</th>

                                <th class="w-24 px-2 py-4 text-center font-bold">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($users as $key => $user)
                                <tr class="hover:bg-green-50 transition duration-200">
                                    <td class="px-2 py-4 text-center align-middle">
                                        {{ $key + 1 }}
                                    </td>

                                    <td class="px-2 py-4 text-center align-middle pl-10">
                                        <div class="flex justify-center">
                                            <div class="h-11 w-11 rounded-full overflow-hidden border-2 border-emerald-200 shadow-sm">
                                                <img class="h-full w-full object-cover"
                                                    src="{{ (!empty($user->avatar))
                                                        ? (str_starts_with($user->avatar, 'http') ? $user->avatar : url('upload/user_images/'.$user->avatar))
                                                        : url('upload/no_image.jpg') }}"
                                                    alt="{{ $user->name }}">
                                                {{-- <img class="h-full w-full object-cover"
                                                    src="{{ (!empty($user->avatar)) ? url('upload/user_images/'.$user->avatar) : url('upload/no_image.jpg') }}"
                                                    alt="{{ $user->name }}"> --}}
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-2 py-4 text-left align-middle pl-28">
                                        <div class="text-sm font-semibold text-gray-800">{{ $user->name }}</div>
                                        <div class="md:hidden text-xs text-gray-500 mt-1">{{ $user->email }}</div>
                                        <div class="text-xs text-green-600 font-medium bg-green-50 inline-block px-2 py-0.5 rounded mt-1">Customer</div>
                                    </td>

                                    <td class="px-2 py-4 text-left hidden md:table-cell align-middle pl-20">
                                        <div class="flex items-center text-sm text-gray-600 bg-gray-50 px-3 py-1 rounded-full w-fit border border-gray-200 group-hover:bg-white group-hover:shadow-sm transition-all">
                                            <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                            {{ $user->email }}
                                        </div>
                                    </td>

                                    <td class="px-2 py-4 text-center hidden md:table-cell align-middle pr-16">
                                        <span class="block text-gray-800 font-medium text-sm">
                                            {{ $user->created_at ? $user->created_at->format('d M Y') : '-' }}
                                        </span>
                                        <span class="text-xs text-gray-400">
                                            {{ $user->created_at ? $user->created_at->diffForHumans() : '' }}
                                        </span>
                                    </td>

                                    <td class="px-2 py-4 text-center align-middle">
                                        <div class="flex items-center justify-center">
                                            <form action="{{ route('deleteUser', $user->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-2 bg-red-50 text-red-500 rounded-full hover:bg-red-500 hover:text-white transition-all shadow-sm" title="Hapus">
                                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-10 text-gray-500">
                                        <div class="flex flex-col items-center">
                                            <svg class="w-12 h-12 text-gray-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                            <p>Belum ada data pelanggan.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- <div class="mt-8">
                {{ $users->links() }}
            </div> --}}
        </div>
    </div>

    <script>
        setTimeout(function() {
            const alert = document.getElementById('success-alert');
            if (alert) {
                alert.classList.add('opacity-0', 'transition', 'duration-500');
                setTimeout(() => alert.remove(), 500);
            }
        }, 3000);
    </script>

    <style>
        @keyframes fade-in {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        .animate-fade-in {
            animation: fade-in 0.5s ease-out;
        }
    </style>
@endsection
