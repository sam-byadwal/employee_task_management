<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        @yield('title', 'Admin Panel') | TaskFlow
    </title>

    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'ui-sans-serif', 'system-ui']
                    }
                }
            }
        }
    </script>

    <link
        rel="preconnect"
        href="https://fonts.googleapis.com"
    >

    <link
        rel="preconnect"
        href="https://fonts.gstatic.com"
        crossorigin
    >

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >

    @stack('styles')
</head>


<body class="bg-slate-100 font-sans text-slate-800">

<div class="flex min-h-screen">


    <!-- ========================================= -->
    <!-- SIDEBAR -->
    <!-- ========================================= -->

    <aside
        class="fixed inset-y-0 left-0 z-50 hidden w-72 flex-col bg-slate-950 text-white shadow-2xl lg:flex"
    >

        <!-- Logo -->

        <div class="flex h-20 items-center border-b border-white/10 px-6">

            <div
                class="flex h-11 w-11 items-center justify-center rounded-2xl bg-gradient-to-br from-indigo-500 to-purple-600 text-xl font-bold shadow-lg shadow-indigo-500/20"
            >
                T
            </div>

            <div class="ml-3">

                <h1 class="text-lg font-bold tracking-tight">
                    TaskFlow
                </h1>

                <p class="text-xs text-slate-400">
                    Employee Management
                </p>

            </div>

        </div>


        <!-- Navigation -->

        <div class="flex-1 overflow-y-auto px-4 py-6">

            <p
                class="mb-3 px-3 text-[11px] font-semibold uppercase tracking-[0.18em] text-slate-500"
            >
                Workspace
            </p>


            <nav class="space-y-2">


                <!-- Dashboard -->

                <a
                    href="{{ route('admin.dashboard') }}"
                    class="group flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition
                    {{ request()->routeIs('admin.dashboard')
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
                            d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z"
                        />
                    </svg>

                    Dashboard

                </a>


                <!-- Employees -->

                <a
                    href="{{ route('admin.employees.index') }}"
                    class="group flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition
                    {{ request()->routeIs('admin.employees.*')
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
                            d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2"
                        />

                        <circle
                            cx="9"
                            cy="7"
                            r="4"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M22 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"
                        />
                    </svg>

                    Employees

                </a>


                <!-- Tasks -->

                <a
                    href="{{ route('admin.tasks.index') }}"
                    class="group flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition
                    {{ request()->routeIs('admin.tasks.*')
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
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2"
                        />

                        <rect
                            x="9"
                            y="3"
                            width="6"
                            height="4"
                            rx="1"
                        />

                        <path
                            stroke-linecap="round"
                            d="M9 13h6M9 17h4"
                        />
                    </svg>

                    Tasks

                </a>


                <!-- Comments -->

                <!-- <a
                    href="#"
                    class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-slate-500 transition hover:bg-white/5 hover:text-slate-300"
                > -->
                <a
    href="{{ route('admin.comments.index') }}"
    class="{{ request()->routeIs('admin.comments.*')
        ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-500/20'
        : 'text-slate-400 hover:bg-slate-800 hover:text-white'
    }} group flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition"
>
    <span>💬</span>

    <span>
        Comments
    </span>
</a>

                    <!-- <svg
                        class="h-5 w-5"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M8 10h8M8 14h5"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M21 12a8.5 8.5 0 01-9 8 9.7 9.7 0 01-4.1-.9L3 21l1.8-4.2A7.8 7.8 0 013 12a8.5 8.5 0 0118 0z"
                        />
                    </svg>

                    Comments

                    <span
                        class="ml-auto rounded-full bg-slate-800 px-2 py-0.5 text-[10px]"
                    >
                        Soon
                    </span> -->

                <!-- </a> -->

            </nav>


            <!-- Divider -->

            <div class="my-6 border-t border-white/10"></div>


            <p
                class="mb-3 px-3 text-[11px] font-semibold uppercase tracking-[0.18em] text-slate-500"
            >
                System
            </p>


            <a
                href="#"
                class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-slate-400 transition hover:bg-white/5 hover:text-white"
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
                        d="M19.4 15a1.7 1.7 0 00.34 1.88l.06.06-1.8 1.8-.06-.06a1.7 1.7 0 00-1.88-.34 1.7 1.7 0 00-1.03 1.56V20H10v-.1a1.7 1.7 0 00-1.03-1.56 1.7 1.7 0 00-1.88.34l-.06.06-1.8-1.8.06-.06A1.7 1.7 0 005.63 15 1.7 1.7 0 004.07 14H4v-2h.07a1.7 1.7 0 001.56-1.03 1.7 1.7 0 00-.34-1.88l-.06-.06 1.8-1.8.06.06a1.7 1.7 0 001.88.34A1.7 1.7 0 0010 6.07V6h4v.07a1.7 1.7 0 001.03 1.56 1.7 1.7 0 001.88-.34l.06-.06 1.8 1.8-.06.06a1.7 1.7 0 00-.34 1.88A1.7 1.7 0 0019.93 12H20v2h-.07A1.7 1.7 0 0019.4 15z"
                    />
                </svg>

                Settings

            </a>

        </div>


        <!-- User -->

        <div class="border-t border-white/10 p-4">

            <div
                class="flex items-center rounded-2xl bg-white/5 p-3"
            >

                <div
                    class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 font-bold"
                >
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>

                <div class="ml-3 min-w-0">

                    <p class="truncate text-sm font-semibold text-white">
                        {{ auth()->user()->name }}
                    </p>

                    <p class="truncate text-xs text-slate-400">
                        Administrator
                    </p>

                </div>

                <form
                    action="{{ route('admin.logout') }}"
                    method="POST"
                    class="ml-auto"
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
                                d="M15 3h4a2 2 0 012 2v14a2 2 0 01-2 2h-4"
                            />

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M10 17l5-5-5-5M15 12H3"
                            />
                        </svg>

                    </button>

                </form>

            </div>

        </div>

    </aside>


    <!-- ========================================= -->
    <!-- MOBILE HEADER -->
    <!-- ========================================= -->

    <header
        class="fixed left-0 right-0 top-0 z-40 flex h-16 items-center justify-between border-b border-slate-200 bg-white px-4 lg:hidden"
    >

        <div class="flex items-center gap-3">

            <div
                class="flex h-9 w-9 items-center justify-center rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 font-bold text-white"
            >
                T
            </div>

            <span class="font-bold">
                TaskFlow
            </span>

        </div>

        <span class="text-sm font-medium text-slate-500">
            Admin
        </span>

    </header>


    <!-- ========================================= -->
    <!-- MAIN CONTENT -->
    <!-- ========================================= -->

    <main class="w-full lg:ml-72">

        <!-- Top Bar -->

        <div
            class="hidden h-20 items-center justify-between border-b border-slate-200 bg-white px-8 lg:flex"
        >

            <div>

                <p class="text-sm text-slate-400">
                    {{ now()->format('l, d F Y') }}
                </p>

                <h2 class="text-lg font-bold text-slate-800">
                    @yield('page-heading', 'Admin Dashboard')
                </h2>

            </div>


            <div class="flex items-center gap-3">

                <div
                    class="flex items-center gap-2 rounded-full border border-slate-200 bg-slate-50 px-3 py-2"
                >

                    <span
                        class="h-2 w-2 rounded-full bg-emerald-500"
                    ></span>

                    <span class="text-xs font-medium text-slate-600">
                        System Online
                    </span>

                </div>

            </div>

        </div>


        <!-- Page -->

        <div class="p-4 pt-20 sm:p-6 lg:p-8 lg:pt-8">

            @if(session('success'))

                <div
                    class="mb-6 flex items-center gap-3 rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm text-emerald-700 shadow-sm"
                >

                    <div
                        class="flex h-8 w-8 items-center justify-center rounded-full bg-emerald-100"
                    >
                        ✓
                    </div>

                    <span class="font-medium">
                        {{ session('success') }}
                    </span>

                </div>

            @endif


            @if(session('error'))

                <div
                    class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-700"
                >
                    {{ session('error') }}
                </div>

            @endif


            @yield('content')

        </div>

    </main>

</div>


@stack('scripts')

</body>
</html>