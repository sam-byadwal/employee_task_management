@extends('layouts.admin')

@section('title', 'Edit Employee')

@section('page-heading', 'Edit Employee')

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

        <div class="mt-5 flex flex-col justify-between gap-5 sm:flex-row sm:items-end">

            <div>

                <span
                    class="inline-flex rounded-full bg-indigo-50 px-3 py-1 text-xs font-bold text-indigo-600"
                >
                    EMPLOYEE PROFILE
                </span>

                <h1 class="mt-3 text-3xl font-extrabold tracking-tight text-slate-900">
                    Edit Employee
                </h1>

                <p class="mt-2 text-sm text-slate-500">
                    Update employee information and account details.
                </p>

            </div>

            <!-- Avatar -->
            <div class="flex items-center gap-3">

                <div
                    class="flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-indigo-500 to-purple-600 text-xl font-bold text-white shadow-lg"
                >
                    {{ strtoupper(substr($employee->name, 0, 1)) }}
                </div>

                <div>

                    <p class="font-bold text-slate-900">
                        {{ $employee->name }}
                    </p>

                    <p class="text-sm text-slate-500">
                        {{ $employee->email }}
                    </p>

                </div>

            </div>

        </div>

    </div>


    <!-- Success Message -->
    @if(session('success'))

        <div class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 p-4">

            <p class="text-sm font-semibold text-emerald-700">
                ✓ {{ session('success') }}
            </p>

        </div>

    @endif


    <!-- Validation Errors -->
    @if ($errors->any())

        <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 p-5">

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


    <!-- Main Update Form -->
    <form
        action="{{ route('admin.employees.update', $employee) }}"
        method="POST"
    >

        @csrf
        @method('PUT')

        <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">


            <!-- Account Information Header -->
            <div
                class="border-b border-slate-200 bg-gradient-to-r from-slate-50 to-white px-6 py-6 sm:px-8"
            >

                <h2 class="font-bold text-slate-900">
                    Account Information
                </h2>

                <p class="mt-1 text-xs text-slate-500">
                    Update the employee's basic account information.
                </p>

            </div>


            <div class="space-y-6 p-6 sm:p-8">


                <!-- Name -->
                <div>

                    <label class="mb-2 block text-sm font-bold text-slate-700">
                        Full Name
                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name', $employee->name) }}"
                        required
                        class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10"
                    >

                    @error('name')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                <!-- Email -->
                <div>

                    <label class="mb-2 block text-sm font-bold text-slate-700">
                        Email Address
                    </label>

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email', $employee->email) }}"
                        required
                        class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10"
                    >

                    @error('email')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                <!-- Status -->
                <div>

                    <label class="mb-2 block text-sm font-bold text-slate-700">
                        Account Status
                    </label>

                    <select
                        name="status"
                        required
                        class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10"
                    >

                        <option
                            value="1"
                            {{ old('status', $employee->status) == 1 ? 'selected' : '' }}
                        >
                            Active
                        </option>

                        <option
                            value="0"
                            {{ old('status', $employee->status) == 0 ? 'selected' : '' }}
                        >
                            Inactive
                        </option>

                    </select>

                    <p class="mt-2 text-xs text-slate-500">
                        Inactive employees cannot log in to the system.
                    </p>

                    @error('status')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                <!-- Password Section -->
                <div class="border-t border-slate-100 pt-6">

                    <div class="mb-5">

                        <h3 class="font-bold text-slate-900">
                            Change Password
                        </h3>

                        <p class="mt-1 text-sm text-slate-500">
                            Leave these fields empty if you do not want to change the current password.
                        </p>

                    </div>


                    <div class="grid gap-6 sm:grid-cols-2">


                        <!-- New Password -->
                        <div>

                            <label class="mb-2 block text-sm font-bold text-slate-700">
                                New Password
                            </label>

                            <input
                                type="password"
                                name="password"
                                autocomplete="new-password"
                                placeholder="Enter new password"
                                class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10"
                            >

                            @error('password')
                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        <!-- Confirm Password -->
                        <div>

                            <label class="mb-2 block text-sm font-bold text-slate-700">
                                Confirm New Password
                            </label>

                            <input
                                type="password"
                                name="password_confirmation"
                                autocomplete="new-password"
                                placeholder="Confirm new password"
                                class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10"
                            >

                        </div>

                    </div>

                </div>


                <!-- Account Details -->
                <div
                    class="grid gap-4 border-t border-slate-100 pt-6 sm:grid-cols-3"
                >

                    <div>

                        <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                            Employee ID
                        </p>

                        <p class="mt-1 font-bold text-slate-800">
                            #{{ $employee->id }}
                        </p>

                    </div>


                    <div>

                        <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                            Role
                        </p>

                        <p class="mt-1 font-bold capitalize text-slate-800">
                            {{ $employee->role }}
                        </p>

                    </div>


                    <div>

                        <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                            Joined
                        </p>

                        <p class="mt-1 font-bold text-slate-800">
                            {{ $employee->created_at->format('d M Y') }}
                        </p>

                    </div>

                </div>

            </div>


            <!-- Footer -->
            <div
                class="flex flex-col gap-4 border-t border-slate-200 bg-slate-50 px-6 py-5 sm:flex-row sm:items-center sm:justify-between sm:px-8"
            >

                <!-- Delete Employee -->
                <button
                    type="submit"
                    form="delete-employee-form"
                    class="w-full rounded-xl border border-red-200 bg-red-50 px-5 py-3 text-sm font-bold text-red-600 transition hover:bg-red-100 sm:w-auto"
                >
                    Delete Employee
                </button>


                <div class="flex flex-col gap-3 sm:flex-row">

                    <a
                        href="{{ route('admin.employees.index') }}"
                        class="rounded-xl border border-slate-200 bg-white px-6 py-3 text-center text-sm font-bold text-slate-600 transition hover:bg-slate-100"
                    >
                        Cancel
                    </a>

                    <button
                        type="submit"
                        class="rounded-xl bg-indigo-600 px-6 py-3 text-sm font-bold text-white shadow-lg shadow-indigo-600/20 transition hover:-translate-y-0.5 hover:bg-indigo-700"
                    >
                        Save Changes →
                    </button>

                </div>

            </div>

        </div>

    </form>


    <!-- Separate Delete Form -->
    <form
        id="delete-employee-form"
        action="{{ route('admin.employees.destroy', $employee) }}"
        method="POST"
        onsubmit="return confirm('Are you sure you want to permanently delete this employee?')"
    >

        @csrf
        @method('DELETE')

    </form>

</div>

@endsection