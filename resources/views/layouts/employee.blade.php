<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        @yield('title', 'Employee Portal') - TaskFlow
    </title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >

    <style>
        * {
            font-family: 'Inter', sans-serif;
        }

        body {
            background: #f8fafc;
        }

        .sidebar-scroll::-webkit-scrollbar {
            width: 4px;
        }

        .sidebar-scroll::-webkit-scrollbar-thumb {
            background: #334155;
            border-radius: 10px;
        }
    </style>

    @stack('styles')
</head>

<body class="bg-slate-50 text-slate-900">

<div class="min-h-screen">

    <!-- ================= SIDEBAR ================= -->

    <aside
        id="sidebar"
        class="fixed inset-y-0 left-0 z-50 flex w-72 -translate-x-full flex-col bg-slate-950 text-white transition-transform duration-300 lg:translate-x-0"
    >

        <!-- Logo -->

        <div class="flex h-20 items-center border-b border-white/10 px-6">

            <div
                class="flex h-11 w-11 items-center justify-center rounded-2xl bg-gradient-to-br from-indigo-500 to-violet-600 shadow-lg shadow-indigo-500/20"
            >
                <svg
                    class="h-6 w-6"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a3 3 0 006 0M9 5a3 3 0 016 0"
                    />
                </svg>
            </div>

            <div class="ml-3">
                <h1 class="text-lg font-bold tracking-tight">
                    TaskFlow
                </h1>

                <p class="text-xs text-slate-400">
                    Employee Portal
                </p>
            </div>

        </div>


        <!-- Navigation -->

        <div class="sidebar-scroll flex-1 overflow-y-auto px-4 py-6">

            <p class="mb-3 px-3 text-[11px] font-semibold uppercase tracking-widest text-slate-500">
                Workspace
            </p>

            <nav class="space-y-1">

                <!-- Dashboard -->

                <a
                    href="{{ route('employee.dashboard') }}"
                    class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium transition
                    {{ request()->routeIs('employee.dashboard')
                        ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/20'
                        : 'text-slate-400 hover:bg-white/5 hover:text-white' }}"
                >

                    <svg
                        class="h-5 w-5"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M3 12l9-9 9 9M5 10v10a1 1 0 001 1h4v-6h4v6h4a1 1 0 001-1V10"
                        />
                    </svg>

                    Dashboard
                </a>


                <!-- My Tasks -->

                <a
                    href="{{ route('employee.tasks.index') }}"
                    class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium text-slate-400 transition hover:bg-white/5 hover:text-white"
                >

                    <svg
                        class="h-5 w-5"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M9 5a3 3 0 006 0M9 5a3 3 0 016 0M9 12h6M9 16h4"
                        />
                    </svg>

                    My Tasks
                </a>


                <!-- Completed -->

                <a
                    href="{{ route('employee.tasks.index', ['status' => 'completed']) }}"
                    class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium text-slate-400 transition hover:bg-white/5 hover:text-white"
                >

                    <svg
                        class="h-5 w-5"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M9 12l2 2 4-4"
                        />

                        <circle
                            cx="12"
                            cy="12"
                            r="9"
                        />
                    </svg>

                    Completed
                </a>


                <!-- Comments -->

                <a
                    href="#"
                    class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium text-slate-400 transition hover:bg-white/5 hover:text-white"
                >

                    <svg
                        class="h-5 w-5"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M21 11.5a8.38 8.38 0 01-9 8.5 9.18 9.18 0 01-4-.9L3 21l1.9-4.2A8.5 8.5 0 1112 20"
                        />
                    </svg>

                    Comments
                </a>

            </nav>


            <p class="mb-3 mt-8 px-3 text-[11px] font-semibold uppercase tracking-widest text-slate-500">
                Account
            </p>


            <nav class="space-y-1">

                <!-- Profile -->

                <a
                    href="#"
                    class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium text-slate-400 transition hover:bg-white/5 hover:text-white"
                >

                    <svg
                        class="h-5 w-5"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        viewBox="0 0 24 24"
                    >
                        <circle
                            cx="12"
                            cy="8"
                            r="3"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M5 21a7 7 0 0114 0"
                        />
                    </svg>

                    My Profile
                </a>


                <!-- Settings -->

                <a
                    href="#"
                    class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium text-slate-400 transition hover:bg-white/5 hover:text-white"
                >

                    <svg
                        class="h-5 w-5"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 15.5a3.5 3.5 0 100-7 3.5 3.5 0 000 7z"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M19.4 15a1.7 1.7 0 00.3 1.9l.1.1-1.8 1.8-.1-.1a1.7 1.7 0 00-1.9-.3 1.7 1.7 0 00-1 1.5V20h-2.6v-.1a1.7 1.7 0 00-1-1.5 1.7 1.7 0 00-1.9.3l-.1.1-1.8-1.8.1-.1a1.7 1.7 0 00.3-1.9 1.7 1.7 0 00-1.5-1H5v-2.6h.1a1.7 1.7 0 001.5-1 1.7 1.7 0 00-.3-1.9l-.1-.1L8 6.6l.1.1a1.7 1.7 0 001.9.3 1.7 1.7 0 001-1.5V5h2.6v.1a1.7 1.7 0 001 1.5 1.7 1.7 0 001.9-.3l.1-.1 1.8 1.8-.1.1a1.7 1.7 0 00-.3 1.9 1.7 1.7 0 001.5 1h.1v2.6h-.1a1.7 1.7 0 00-1.5 1z"
                        />
                    </svg>

                    Settings
                </a>

            </nav>

        </div>


        <!-- User Bottom -->

        <div class="border-t border-white/10 p-4">

            <div class="flex items-center gap-3 rounded-2xl bg-white/5 p-3">

                <div
                    class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-gradient-to-br from-indigo-500 to-violet-600 font-bold"
                >
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>

                <div class="min-w-0 flex-1">

                    <p class="truncate text-sm font-semibold">
                        {{ auth()->user()->name }}
                    </p>

                    <p class="truncate text-xs text-slate-400">
                        Employee
                    </p>

                </div>

                <form
                    method="POST"
                    action="{{ route('employee.logout') }}"
                >
                    @csrf

                    <button
                        type="submit"
                        title="Logout"
                        class="rounded-lg p-2 text-slate-400 transition hover:bg-red-500/10 hover:text-red-400"
                    >

                        <svg
                            class="h-5 w-5"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M10 17l5-5-5-5M15 12H3"
                            />

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M21 19V5a2 2 0 00-2-2h-6"
                            />
                        </svg>

                    </button>

                </form>

            </div>

        </div>

    </aside>


    <!-- ================= MAIN ================= -->

    <div class="lg:pl-72">

        <!-- Top Header -->

        <header
            class="sticky top-0 z-40 border-b border-slate-200 bg-white/90 backdrop-blur"
        >

            <div class="flex h-20 items-center justify-between px-4 sm:px-6 lg:px-8">

                <!-- Mobile Menu -->

                <button
                    onclick="toggleSidebar()"
                    class="rounded-xl p-2 text-slate-600 hover:bg-slate-100 lg:hidden"
                >

                    <svg
                        class="h-6 w-6"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M4 6h16M4 12h16M4 18h16"
                        />
                    </svg>

                </button>


                <div class="hidden sm:block">

                    <p class="text-sm font-semibold text-slate-900">
                        Employee Workspace
                    </p>

                    <p class="text-xs text-slate-500">
                        Manage your work and tasks
                    </p>

                </div>


                <div class="ml-auto flex items-center gap-3">

                    <!-- Notification -->

                    <button
                        class="relative rounded-xl border border-slate-200 bg-white p-2.5 text-slate-500 transition hover:bg-slate-50 hover:text-slate-900"
                    >

                        <svg
                            class="h-5 w-5"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M18 8a6 6 0 00-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9M13.73 21a2 2 0 01-3.46 0"
                            />
                        </svg>

                        <span class="absolute right-2 top-2 h-2 w-2 rounded-full bg-red-500"></span>

                    </button>


                    <!-- Employee -->

                    <div
                        class="hidden items-center gap-3 border-l border-slate-200 pl-4 sm:flex"
                    >

                        <div class="text-right">

                            <p class="text-sm font-semibold text-slate-900">
                                {{ auth()->user()->name }}
                            </p>

                            <p class="text-xs text-slate-500">
                                Employee
                            </p>

                        </div>

                        <div
                            class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-100 font-bold text-indigo-700"
                        >
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>

                    </div>

                </div>

            </div>

        </header>


        <!-- Page Content -->

        <main class="p-4 sm:p-6 lg:p-8">

            @if(session('success'))

                <div class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm font-medium text-emerald-700">
                    {{ session('success') }}
                </div>

            @endif


            @if(session('error'))

                <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-5 py-4 text-sm font-medium text-red-700">
                    {{ session('error') }}
                </div>

            @endif


            @yield('content')

        </main>

    </div>

</div>


<script>

function toggleSidebar()
{
    const sidebar = document.getElementById('sidebar');

    sidebar.classList.toggle('-translate-x-full');
}

</script>

@stack('scripts')

</body>
</html>