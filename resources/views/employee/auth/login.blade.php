<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Employee Login | TaskFlow</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="min-h-screen bg-slate-950">

<div class="min-h-screen flex items-center justify-center px-6 py-12">

    <div class="w-full max-w-md">

        <!-- Logo -->
        <div class="text-center mb-8">

            <div class="mx-auto mb-5 flex h-16 w-16 items-center justify-center rounded-2xl bg-indigo-600 shadow-xl shadow-indigo-600/30">
                <svg
                    class="h-8 w-8 text-white"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622C17.176 19.29 21 14.591 21 9c0-1.042-.133-2.052-.382-3.016z"
                    />
                </svg>
            </div>

            <h1 class="text-3xl font-extrabold text-white">
                Employee Portal
            </h1>

            <p class="mt-2 text-sm text-slate-400">
                Login to manage your assigned tasks
            </p>

        </div>


        <!-- Card -->
        <div class="rounded-3xl border border-white/10 bg-white p-8 shadow-2xl">

            @if(session('error'))
                <div class="mb-5 rounded-xl bg-red-50 px-4 py-3 text-sm text-red-700">
                    {{ session('error') }}
                </div>
            @endif

            @if(session('success'))
                <div class="mb-5 rounded-xl bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="mb-5 rounded-xl bg-red-50 px-4 py-3">
                    @foreach($errors->all() as $error)
                        <p class="text-sm text-red-700">
                            {{ $error }}
                        </p>
                    @endforeach
                </div>
            @endif


            <form
                action="{{ route('employee.login.submit') }}"
                method="POST"
                class="space-y-5"
            >

                @csrf

                <!-- Email -->
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">
                        Email Address
                    </label>

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="employee@example.com"
                        required
                        autofocus
                        class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none transition focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10"
                    >
                </div>


                <!-- Password -->
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">
                        Password
                    </label>

                    <input
                        type="password"
                        name="password"
                        placeholder="••••••••"
                        required
                        class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none transition focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10"
                    >
                </div>


                <!-- Remember -->
                <div class="flex items-center justify-between">

                    <label class="flex items-center gap-2 text-sm text-slate-600">

                        <input
                            type="checkbox"
                            name="remember"
                            value="1"
                            class="h-4 w-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500"
                        >

                        Remember me

                    </label>

                    <span class="text-xs text-slate-400">
                        Secure login
                    </span>

                </div>


                <!-- Submit -->
                <button
                    type="submit"
                    class="w-full rounded-xl bg-indigo-600 px-5 py-3.5 text-sm font-bold text-white shadow-lg shadow-indigo-600/20 transition hover:bg-indigo-700 hover:shadow-indigo-600/30"
                >
                    Login to Dashboard
                </button>

            </form>

        </div>


        <p class="mt-6 text-center text-xs text-slate-500">
            TaskFlow Employee Management System
        </p>

    </div>

</div>

</body>
</html>