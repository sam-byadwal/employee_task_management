<!DOCTYPE html>
<html lang="en" class="h-full">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Admin Login</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            darkMode: 'class'
        }
    </script>

    <script>
        // Apply saved theme before page renders
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.classList.add('dark');
        }
    </script>

</head>

<body
    class="
        min-h-screen
        bg-slate-100
        dark:bg-slate-950
        transition-colors
        duration-300
    "
>

    <!-- Top Bar -->
    <div class="absolute top-5 right-5">

        <button
            type="button"
            id="themeToggle"
            class="
                flex
                items-center
                gap-2
                rounded-xl
                border
                border-slate-200
                bg-white
                px-4
                py-2
                text-sm
                font-medium
                text-slate-700
                shadow-sm
                transition
                hover:bg-slate-50

                dark:border-slate-700
                dark:bg-slate-900
                dark:text-slate-200
                dark:hover:bg-slate-800
            "
        >

            <span id="themeIcon"></span>

            <span id="themeText">
                Night
            </span>

        </button>

    </div>


    <!-- Main -->
    <div class="flex min-h-screen items-center justify-center px-4 py-12">

        <div class="w-full max-w-md">

            <!-- Logo / Brand -->
            <div class="mb-8 text-center">

                <div
                    class="
                        mx-auto
                        mb-4
                        flex
                        h-14
                        w-14
                        items-center
                        justify-center
                        rounded-2xl
                        bg-indigo-600
                        text-xl
                        font-bold
                        text-white
                        shadow-lg
                        shadow-indigo-600/30
                    "
                >
                    TF
                </div>

                <h1
                    class="
                        text-2xl
                        font-bold
                        text-slate-900
                        dark:text-white
                    "
                >
                    TaskFlow
                </h1>

                <p
                    class="
                        mt-1
                        text-sm
                        text-slate-500
                        dark:text-slate-400
                    "
                >
                    Employee Task Management System
                </p>

            </div>


            <!-- Login Card -->
            <div
                class="
                    rounded-2xl
                    border
                    border-slate-200
                    bg-white
                    p-8
                    shadow-xl
                    shadow-slate-200/50

                    dark:border-slate-800
                    dark:bg-slate-900
                    dark:shadow-black/20
                "
            >

                <div class="mb-7">

                    <h2
                        class="
                            text-xl
                            font-semibold
                            text-slate-900
                            dark:text-white
                        "
                    >
                        Admin Login
                    </h2>

                    <p
                        class="
                            mt-1
                            text-sm
                            text-slate-500
                            dark:text-slate-400
                        "
                    >
                        Sign in to manage your task system.
                    </p>

                </div>


                <!-- Error Message -->
                @if(session('error'))

                    <div
                        class="
                            mb-5
                            rounded-xl
                            border
                            border-red-200
                            bg-red-50
                            px-4
                            py-3
                            text-sm
                            text-red-700

                            dark:border-red-900
                            dark:bg-red-950/40
                            dark:text-red-300
                        "
                    >
                        {{ session('error') }}
                    </div>

                @endif


                @if($errors->any())

                    <div
                        class="
                            mb-5
                            rounded-xl
                            border
                            border-red-200
                            bg-red-50
                            px-4
                            py-3
                            text-sm
                            text-red-700

                            dark:border-red-900
                            dark:bg-red-950/40
                            dark:text-red-300
                        "
                    >
                        {{ $errors->first() }}
                    </div>

                @endif


                <!-- Login Form -->
                <form
                    method="POST"
                    action="{{ route('admin.login.submit') }}"
                    class="space-y-5"
                >

                    @csrf


                    <!-- Email -->
                    <div>

                        <label
                            for="email"
                            class="
                                mb-2
                                block
                                text-sm
                                font-medium
                                text-slate-700
                                dark:text-slate-300
                            "
                        >
                            Email Address
                        </label>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="admin@example.com"
                            required
                            autocomplete="email"
                            class="
                                w-full
                                rounded-xl
                                border
                                border-slate-300
                                bg-white
                                px-4
                                py-3
                                text-sm
                                text-slate-900
                                outline-none
                                transition

                                placeholder:text-slate-400

                                focus:border-indigo-500
                                focus:ring-4
                                focus:ring-indigo-500/10

                                dark:border-slate-700
                                dark:bg-slate-950
                                dark:text-white
                                dark:placeholder:text-slate-500
                            "
                        >

                    </div>


                    <!-- Password -->
                    <div>

                        <label
                            for="password"
                            class="
                                mb-2
                                block
                                text-sm
                                font-medium
                                text-slate-700
                                dark:text-slate-300
                            "
                        >
                            Password
                        </label>

                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Enter your password"
                            required
                            autocomplete="current-password"
                            class="
                                w-full
                                rounded-xl
                                border
                                border-slate-300
                                bg-white
                                px-4
                                py-3
                                text-sm
                                text-slate-900
                                outline-none
                                transition

                                placeholder:text-slate-400

                                focus:border-indigo-500
                                focus:ring-4
                                focus:ring-indigo-500/10

                                dark:border-slate-700
                                dark:bg-slate-950
                                dark:text-white
                                dark:placeholder:text-slate-500
                            "
                        >

                    </div>


                    <!-- Remember -->
                    <div class="flex items-center">

                        <input
                            type="checkbox"
                            name="remember"
                            value="1"
                            id="remember"
                            class="
                                h-4
                                w-4
                                rounded
                                border-slate-300
                                text-indigo-600
                                focus:ring-indigo-500
                                dark:border-slate-600
                                dark:bg-slate-800
                            "
                        >

                        <label
                            for="remember"
                            class="
                                ml-2
                                text-sm
                                text-slate-600
                                dark:text-slate-400
                            "
                        >
                            Remember me
                        </label>

                    </div>


                    <!-- Login Button -->
                    <button
                        type="submit"
                        class="
                            w-full
                            rounded-xl
                            bg-indigo-600
                            px-4
                            py-3
                            text-sm
                            font-semibold
                            text-white
                            shadow-lg
                            shadow-indigo-600/20
                            transition

                            hover:bg-indigo-700
                            active:scale-[0.98]

                            focus:outline-none
                            focus:ring-4
                            focus:ring-indigo-500/20
                        "
                    >
                        Sign In
                    </button>

                </form>

            </div>


            <!-- Footer -->
            <p
                class="
                    mt-6
                    text-center
                    text-xs
                    text-slate-500
                    dark:text-slate-500
                "
            >
                © {{ date('Y') }} TaskFlow. All rights reserved.
            </p>

        </div>

    </div>


    <!-- Theme Toggle -->
    <script>

        const themeToggle = document.getElementById('themeToggle');

        const themeIcon = document.getElementById('themeIcon');

        const themeText = document.getElementById('themeText');


        function updateThemeButton() {

            const isDark =
                document.documentElement.classList.contains('dark');


            if (isDark) {

                // Sun icon
                themeIcon.innerHTML = `
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.8"
                        stroke="currentColor"
                        class="h-4 w-4"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m.364 6.364-1.591-1.591M12 18.75V21m-4.773-2.227-1.591 1.591M5.25 12H3m3.636-5.364L5.045 5.045M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z"
                        />
                    </svg>
                `;

                themeText.textContent = 'Morning';

            } else {

                // Moon icon
                themeIcon.innerHTML = `
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.8"
                        stroke="currentColor"
                        class="h-4 w-4"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M21.752 15.002A9.718 9.718 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.598.748-3.752A9.753 9.753 0 1 0 21.752 15.002Z"
                        />
                    </svg>
                `;

                themeText.textContent = 'Night';

            }

        }


        themeToggle.addEventListener('click', function () {

            document.documentElement.classList.toggle('dark');


            const isDark =
                document.documentElement.classList.contains('dark');


            localStorage.setItem(
                'theme',
                isDark ? 'dark' : 'light'
            );


            updateThemeButton();

        });


        updateThemeButton();

    </script>

</body>

</html>