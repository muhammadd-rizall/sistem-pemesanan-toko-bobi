@extends('frontend.layouts.app')

@section('content')
<div class="min-h-screen bg-sage-50/50 py-12">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-5xl">

        <div class="mb-10 animate-fade-in-down">
            <div class="flex items-center gap-3 text-sm text-sage-600 mb-2">
                <a href="{{ route('home') }}" class="hover:text-sage-800 transition-colors">Home</a>
                <span class="text-sage-400">/</span>
                <span class="font-medium text-sage-800">Profil Saya</span>
            </div>
            <h1 class="text-3xl md:text-4xl font-bold text-sage-900 font-serif">Profil Saya</h1>
            <p class="text-sage-600 mt-2 text-lg">Kelola informasi profil Anda untuk mengamankan akun Anda.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 animate-fade-in-up">

            <div class="lg:col-span-4">
                <div class="bg-white rounded-3xl shadow-xl shadow-sage-100/50 border border-sage-100 overflow-hidden sticky top-24 transition-all duration-300 hover:shadow-2xl hover:shadow-sage-200/50">
                    <div class="h-32 bg-gradient-to-br from-sage-400 via-sage-500 to-sage-700 relative overflow-hidden">
                        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMSIgY3k9IjEiIHI9IjEiIGZpbGw9InJnYmEoMjU1LDI1NSwyNTUsMC4yKSIvPjwvc3ZnPg==')] opacity-30"></div>
                    </div>

                    <div class="px-6 pb-8 text-center relative">
                        <div class="relative -mt-16 mb-4 inline-block group">
                            <div class="w-32 h-32 rounded-full border-4 border-white shadow-lg overflow-hidden bg-white relative z-10 transition-transform duration-300 group-hover:scale-105">
                                <img src="{{ (!empty(Auth::guard('customer')->user()->avatar))
                                    ? (str_starts_with(Auth::guard('customer')->user()->avatar, 'http')
                                        ? Auth::guard('customer')->user()->avatar
                                        : url('upload/user_images/'.Auth::guard('customer')->user()->avatar))
                                    : 'https://ui-avatars.com/api/?name='.urlencode(Auth::guard('customer')->user()->nama_lengkap).'&background=e8f0e8&color=2f4f39&size=256&bold=true' }}"
                                    alt="Profile"
                                    class="w-full h-full object-cover">
                                {{-- <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::guard('customer')->user()->nama_lengkap) }}&background=e8f0e8&color=2f4f39&size=256&bold=true"
                                     alt="Profile"
                                     class="w-full h-full object-cover"> --}}
                            </div>
                            {{-- Badge Status --}}
                            <div class="absolute bottom-2 right-2 z-20 bg-green-500 border-2 border-white w-5 h-5 rounded-full" title="Active"></div>
                        </div>

                        <h2 class="text-xl font-bold text-sage-900 mb-1">{{ Auth::guard('customer')->user()->nama_lengkap }}</h2>
                        <p class="text-sm text-sage-500 font-medium">{{ Auth::guard('customer')->user()->email }}</p>
                        <p class="text-xs text-sage-400 mt-2">Member sejak {{ Auth::guard('customer')->user()->created_at->format('M Y') }}</p>

                        <div class="mt-6 flex justify-center">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-sage-100 text-sage-700 border border-sage-200">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Akun Terverifikasi
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-8">
                <div class="bg-white rounded-3xl shadow-lg shadow-sage-100/50 border border-sage-100 p-6 sm:p-8 relative overflow-hidden">

                    <div class="absolute top-0 right-0 -mt-10 -mr-10 w-40 h-40 bg-sage-50 rounded-full blur-3xl opacity-50 pointer-events-none"></div>

                    <div class="flex justify-between items-center mb-8 border-b border-sage-100 pb-4 relative z-10">
                        <div>
                            <h3 class="text-xl font-bold text-sage-900">Detail Informasi</h3>
                            <p class="text-sm text-sage-500">Informasi pribadi Anda yang terdaftar</p>
                        </div>
                        <button class="inline-flex items-center gap-2 px-4 py-2 bg-sage-50 text-sage-700 text-sm font-medium rounded-lg hover:bg-sage-100 hover:text-sage-900 transition-all duration-200">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                            Edit Profil
                        </button>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 relative z-10">

                        <div class="space-y-2 group">
                            <label class="text-xs font-bold text-sage-400 uppercase tracking-wider group-hover:text-sage-600 transition-colors">Nama Lengkap</label>
                            <div class="p-3.5 bg-sage-50/50 rounded-xl border border-sage-100 text-sage-900 font-semibold flex items-center gap-3 group-hover:border-sage-300 transition-all duration-300">
                                <svg class="w-5 h-5 text-sage-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                {{ Auth::guard('customer')->user()->name }}
                            </div>
                        </div>

                        <div class="space-y-2 group">
                            <label class="text-xs font-bold text-sage-400 uppercase tracking-wider group-hover:text-sage-600 transition-colors">Username</label>
                            <div class="p-3.5 bg-sage-50/50 rounded-xl border border-sage-100 text-sage-900 font-semibold flex items-center gap-3 group-hover:border-sage-300 transition-all duration-300">
                                <svg class="w-5 h-5 text-sage-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path></svg>
                                {{ Auth::guard('customer')->user()->username }}
                            </div>
                        </div>

                        <div class="md:col-span-2 space-y-2 group">
                            <label class="text-xs font-bold text-sage-400 uppercase tracking-wider group-hover:text-sage-600 transition-colors">Email Address</label>
                            <div class="p-3.5 bg-sage-50/50 rounded-xl border border-sage-100 text-sage-900 font-semibold flex items-center justify-between group-hover:border-sage-300 transition-all duration-300">
                                <div class="flex items-center gap-3">
                                    <svg class="w-5 h-5 text-sage-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                    {{ Auth::guard('customer')->user()->email }}
                                </div>
                                <span class="flex items-center gap-1 text-[10px] font-bold text-green-600 bg-green-100 px-2 py-1 rounded-md">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                                    VERIFIED
                                </span>
                            </div>
                        </div>

                        <div class="space-y-2 group">
                            <label class="text-xs font-bold text-sage-400 uppercase tracking-wider group-hover:text-sage-600 transition-colors">Nomor Telepon</label>
                            <div class="p-3.5 bg-sage-50/50 rounded-xl border border-sage-100 text-sage-900 font-semibold flex items-center gap-3 group-hover:border-sage-300 transition-all duration-300">
                                <svg class="w-5 h-5 text-sage-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                {{ Auth::guard('customer')->user()->no_hp ?? '-' }}
                            </div>
                        </div>

                        <div class="space-y-2 group">
                            <label class="text-xs font-bold text-sage-400 uppercase tracking-wider group-hover:text-sage-600 transition-colors">Tanggal Bergabung</label>
                            <div class="p-3.5 bg-sage-50/50 rounded-xl border border-sage-100 text-sage-900 font-semibold flex items-center gap-3 group-hover:border-sage-300 transition-all duration-300">
                                <svg class="w-5 h-5 text-sage-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                {{ Auth::guard('customer')->user()->created_at->translatedFormat('d F Y') }}
                            </div>
                        </div>

                        <div class="md:col-span-2 space-y-2 group">
                            <label class="text-xs font-bold text-sage-400 uppercase tracking-wider group-hover:text-sage-600 transition-colors">Alamat Utama</label>
                            <div class="p-4 bg-sage-50/50 rounded-xl border border-sage-100 text-sage-900 font-medium flex items-start gap-3 group-hover:border-sage-300 transition-all duration-300 min-h-[80px]">
                                <svg class="w-5 h-5 text-sage-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                <span class="leading-relaxed">
                                    {{ Auth::guard('customer')->user()->alamat ?? 'Belum ada alamat yang disimpan. Silakan lengkapi profil Anda.' }}
                                </span>
                            </div>
                        </div>

                    </div>

                    <div class="mt-10 pt-6 border-t border-sage-100 flex flex-col sm:flex-row gap-4">
                        <button class="flex-1 group relative flex items-center justify-center gap-2 px-6 py-3.5 bg-sage-600 text-white font-semibold rounded-xl shadow-lg hover:bg-sage-700 hover:-translate-y-0.5 transition-all duration-300 overflow-hidden">
                            <span class="relative z-10 flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                Ubah Password
                            </span>
                            <div class="absolute inset-0 bg-white/20 translate-y-full group-hover:translate-y-0 transition-transform duration-300 ease-out"></div>
                        </button>

                        <form method="POST" action="{{ route('customer.logout') }}" class="flex-1" onsubmit="return confirm('Apakah Anda yakin ingin keluar?');">
                            @csrf
                            <button type="submit" class="w-full flex items-center justify-center gap-2 px-6 py-3.5 bg-white text-red-500 border-2 border-red-100 font-semibold rounded-xl hover:bg-red-50 hover:border-red-200 hover:text-red-600 transition-all duration-300">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                Logout
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
