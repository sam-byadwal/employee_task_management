@extends('layouts.admin')

@section('title', 'Add Employee')

@section('page-heading', 'Add Employee')

@section('content')

<div class="mx-auto max-w-5xl">

    <!-- Header -->
    <div class="mb-8">

        <a
            href="{{ route('admin.employees.index') }}"
            class="inline-flex items-center gap-2 text-sm font-medium text-slate-500 transition hover:text-indigo-600"
        >
            ← Back to Employees
        </a>

        <div class="mt-5">

            <span
                class="inline-flex rounded-full bg-indigo-50 px-3 py-1 text-xs font-bold text-indigo-600"
            >
                TEAM MANAGEMENT
            </span>

            <h1 class="mt-3 text-3xl font-extrabold tracking-tight text-slate-900">
                Add New Employee
            </h1>

            <p class="mt-2 text-sm text-slate-500">
                Create an employee account and add them to your team.
            </p>

        </div>

    </div>


    <!-- Validation -->

    @if ($errors->any())

        <div
            class="mb-6 rounded-2xl border border-red-200 bg-red-50 p-5"
        >

            <div class="flex gap-3">

                <div class="text-xl">
                    ⚠️
                </div>

                <div>

                    <h3 class="font-bold text-red-800">
                        Please fix the following errors
                    </h3>

                    <ul class="mt-2 list-disc pl-5 text-sm text-red-600">

                        @foreach ($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            </div>

        </div>

    @endif


    <!-- Form -->

    <form
        action="{{ route('admin.employees.store') }}"
        method="POST"
    >

        @csrf

        <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">

            <!-- Form header -->

            <div
                class="border-b border-slate-200 bg-gradient-to-r from-slate-50 to-white px-6 py-6 sm:px-8"
            >

                <div class="flex items-center gap-4">

                    <div
                        class="flex h-12 w-12 items-center justify-center rounded-2xl bg-indigo-100 text-xl"
                    >
                        👤
                    </div>

                    <div>

                        <h2 class="font-bold text-slate-900">
                            Employee Information
                        </h2>

                        <p class="mt-1 text-xs text-slate-500">
                            Basic account information for the employee.
                        </p>

                    </div>

                </div>

            </div>


            <!-- Fields -->

            <div class="space-y-6 p-6 sm:p-8">

                <!-- Name -->

                <div>

                    <label class="mb-2 block text-sm font-bold text-slate-700">
                        Full Name
                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Enter employee name"
                        required
                        class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10"
                    >

                </div>


                <!-- Email -->

                <div>

                    <label class="mb-2 block text-sm font-bold text-slate-700">
                        Email Address
                    </label>

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="employee@example.com"
                        required
                        class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10"
                    >

                </div>


                <!-- Password Row -->

                <div class="grid gap-6 md:grid-cols-2">

                    <!-- Password -->

                    <div>

                        <label class="mb-2 block text-sm font-bold text-slate-700">
                            Password
                        </label>

                        <input
                            type="password"
                            name="password"
                            placeholder="Minimum 6 characters"
                            required
                            class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10"
                        >

                    </div>


                    <!-- Confirm -->

                    <div>

                        <label class="mb-2 block text-sm font-bold text-slate-700">
                            Confirm Password
                        </label>

                        <input
                            type="password"
                            name="password_confirmation"
                            placeholder="Repeat password"
                            required
                            class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10"
                        >

                    </div>

                </div>


             <!-- Account Status -->

<div class="rounded-2xl border border-slate-200 bg-white p-5">

    <div class="mb-4">
        <h3 class="font-bold text-slate-900">
            Account Status
        </h3>

        <p class="mt-1 text-sm text-slate-500">
            Choose whether this employee can log in.
        </p>
    </div>

    <select
        name="status"
        class="w-full rounded-xl border border-slate-300 px-4 py-3
               text-slate-700 focus:border-indigo-500
               focus:ring-indigo-500"
    >
        <option
            value="1"
            {{ old('status', '1') == '1' ? 'selected' : '' }}
        >
            Active
        </option>

        <option
            value="0"
            {{ old('status') === '0' ? 'selected' : '' }}
        >
            Inactive
        </option>
    </select>

    @error('status')
        <p class="mt-2 text-sm text-red-600">
            {{ $message }}
        </p>
    @enderror

</div>

            </div>


            <!-- Footer -->

            <div
                class="flex flex-col-reverse gap-3 border-t border-slate-200 bg-slate-50 px-6 py-5 sm:flex-row sm:justify-end sm:px-8"
            >

                <a
                    href="{{ route('admin.employees.index') }}"
                    class="inline-flex justify-center rounded-xl border border-slate-200 bg-white px-6 py-3 text-sm font-bold text-slate-600 transition hover:bg-slate-100"
                >
                    Cancel
                </a>

                <button
                    type="submit"
                    class="inline-flex justify-center rounded-xl bg-indigo-600 px-6 py-3 text-sm font-bold text-white shadow-lg shadow-indigo-600/20 transition hover:-translate-y-0.5 hover:bg-indigo-700 hover:shadow-xl"
                >
                    Create Employee →
                </button>

            </div>

        </div>

    </form>

</div>

@endsection