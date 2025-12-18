<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="shortcut icon" href="{{ asset('assets/skolafit-removebg-preview.png') }}" type="image/x-icon">
    @vite('resources/css/app.css')

    <title>Admin Dashboard</title>
</head>
<body class="bg-gray-100 min-h-screen">

    <!-- Wrapper -->
    <div class="flex">

        <!-- Sidebar -->
        <aside class="w-64 bg-gradient-to-b from-indigo-700 to-indigo-800 text-white min-h-screen hidden md:block">
            <div class="p-6 text-center border-b border-indigo-600">
                <h1 class="text-2xl font-bold tracking-wide">Admin Panel</h1>
                <p class="text-xs opacity-80 mt-1">Management System</p>
            </div>

            <nav class="p-4 space-y-1 text-sm">

                <!-- Dashboard -->
                <a href="/admin/dashboard"
                class="flex items-center gap-3 px-4 py-3 rounded-lg
                {{ request()->is('admin/dashboard') ? 'bg-indigo-600' : 'hover:bg-indigo-600' }}">
                    <!-- icon -->
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 12l2-2m0 0l7-7 7 7m-9 2v8m4-8v8m5-6l2 2" />
                    </svg>
                    Dashboard
                </a>

                <!-- Users -->
                <a href="/admin/users"
                class="flex items-center gap-3 px-4 py-3 rounded-lg
                {{ request()->is('admin/users*') ? 'bg-indigo-600' : 'hover:bg-indigo-600' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17 20h5v-2a4 4 0 00-4-4h-1m-4 6H2v-2a4 4 0 014-4h1m4-4a4 4 0 100-8 4 4 0 000 8zm6 0a4 4 0 100-8 4 4 0 000 8z" />
                    </svg>
                    Users
                </a>

                <!-- Settings -->
                <a href="/admin/settings"
                class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-indigo-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M10.325 4.317a1 1 0 011.35-.936l.54.216a1 1 0 001.224-.447l.347-.6a1 1 0 011.732 0l.347.6a1 1 0 001.224.447l.54-.216a1 1 0 011.35.936l.083.645a1 1 0 00.867.867l.645.083a1 1 0 01.936 1.35l-.216.54a1 1 0 00.447 1.224l.6.347a1 1 0 010 1.732l-.6.347a1 1 0 00-.447 1.224l.216.54a1 1 0 01-.936 1.35l-.645.083a1 1 0 00-.867.867l-.083.645a1 1 0 01-1.35.936l-.54-.216a1 1 0 00-1.224.447l-.347.6a1 1 0 01-1.732 0l-.347-.6a1 1 0 00-1.224-.447l-.54.216a1 1 0 01-1.35-.936l-.083-.645a1 1 0 00-.867-.867l-.645-.083a1 1 0 01-.936-1.35l.216-.54a1 1 0 00-.447-1.224l-.6-.347a1 1 0 010-1.732l.6-.347a1 1 0 00.447-1.224l-.216-.54a1 1 0 01.936-1.35l.645-.083a1 1 0 00.867-.867l.083-.645z" />
                    </svg>
                    Settings
                </a>

            </nav>
        </aside>


        <!-- Main Content -->
        <main class="flex-1">

            <!-- Topbar -->
            <header class="bg-white shadow px-6 py-4 flex justify-between items-center">
                <h2 class="text-xl font-semibold text-gray-700">
                    Dashboard Admin
                </h2>

                <div class="flex items-center gap-4">

                    <span class="text-gray-600 text-sm">
                        Hai, <b>{{ Auth::user()->name }}</b>
                    </span>

                    <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}"
                        class="w-10 h-10 rounded-full border" alt="avatar">

                    <!-- Logout -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button
                            class="bg-red-500 hover:bg-red-600 text-white text-sm px-4 py-2 rounded-lg transition">
                            Logout
                        </button>
                    </form>

                </div>
            </header>


            <!-- Content -->
            <section class="p-6">

                <!-- Info -->
                <div class="mb-6">
                    <p class="text-gray-600">
                        Anda telah login sebagai <span class="font-semibold text-indigo-600">Admin</span>.
                    </p>
                </div>

                <!-- Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

    <!-- Users -->
    <div class="bg-white rounded-xl shadow p-6 flex items-center gap-4">
        <div class="bg-indigo-100 text-indigo-600 p-3 rounded-full">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H2v-2a4 4 0 014-4h1m4-4a4 4 0 100-8 4 4 0 000 8z" />
            </svg>
        </div>
        <div>
            <p class="text-sm text-gray-500">Total Users</p>
            <h3 class="text-2xl font-bold">120</h3>
        </div>
    </div>

    <!-- Admin -->
    <div class="bg-white rounded-xl shadow p-6 flex items-center gap-4">
        <div class="bg-green-100 text-green-600 p-3 rounded-full">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M5.121 17.804A4 4 0 019 16h6a4 4 0 013.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
        </div>
        <div>
            <p class="text-sm text-gray-500">Total Admin</p>
            <h3 class="text-2xl font-bold">5</h3>
        </div>
    </div>

    <!-- Server -->
    <div class="bg-white rounded-xl shadow p-6 flex items-center gap-4">
        <div class="bg-blue-100 text-blue-600 p-3 rounded-full">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M5 12h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12a2 2 0 100 4h14a2 2 0 100-4" />
            </svg>
        </div>
        <div>
            <p class="text-sm text-gray-500">Server Status</p>
            <h3 class="text-2xl font-bold text-blue-600">Online</h3>
        </div>
    </div>

</div>


                <!-- Section -->
                <div class="mt-10 bg-white rounded-xl shadow p-6">
                    <h3 class="text-lg font-semibold mb-3">Informasi</h3>
                    <p class="text-gray-600 text-sm">
                        Dashboard ini digunakan untuk mengelola data aplikasi, user, dan pengaturan sistem.
                    </p>
                </div>

            </section>

        </main>

    </div>

</body>
</html>
