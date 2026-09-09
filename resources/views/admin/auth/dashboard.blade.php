@extends('layouts.admin')

@section('title', 'Dashboard')

@section('page-heading', 'Dashboard')

@section('content')

<div class="space-y-8">

    <!-- Welcome -->

    <div
        class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-indigo-600 via-indigo-700 to-purple-800 p-8 text-white shadow-xl shadow-indigo-500/20"
    >

        <div class="relative z-10 max-w-2xl">

            <p class="mb-2 text-sm font-medium text-indigo-200">
                Welcome back 👋
            </p>

            <h1 class="text-3xl font-extrabold tracking-tight sm:text-4xl">
                Good to see you, {{ auth()->user()->name }}
            </h1>

            <p class="mt-3 text-indigo-100">
                Manage your employees, assign tasks and keep your
                team's workflow organized from one place.
            </p>

            <div class="mt-6 flex flex-wrap gap-3">

                <a
                    href="{{ route('admin.tasks.create') }}"
                    class="rounded-xl bg-white px-5 py-3 text-sm font-bold text-indigo-700 shadow-lg transition hover:-translate-y-0.5 hover:shadow-xl"
                >
                    + Create Task
                </a>

                <a
                    href="{{ route('admin.employees.create') }}"
                    class="rounded-xl border border-white/20 bg-white/10 px-5 py-3 text-sm font-semibold text-white backdrop-blur transition hover:bg-white/20"
                >
                    Add Employee
                </a>

            </div>

        </div>


        <!-- Decorative circles -->

        <div
            class="absolute -right-16 -top-16 h-64 w-64 rounded-full bg-white/10"
        ></div>

        <div
            class="absolute -bottom-24 right-32 h-64 w-64 rounded-full bg-purple-400/10"
        ></div>

    </div>


    <!-- Stats -->

    <div class="grid gap-5 sm:grid-cols-2  xl:grid-cols-3 2xl:grid-cols-6">


        <!-- Employees -->

        <div
            class="group rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-xl"
        >

            <div class="flex items-center justify-between">

                <div
                    class="flex h-12 w-12 items-center justify-center rounded-2xl bg-indigo-50 text-indigo-600"
                >
                    👥
                </div>

                <span
                    class="text-xs font-semibold text-emerald-600"
                >
                    Team
                </span>

            </div>

            <p class="mt-5 text-sm text-slate-500">
                Total Employees
            </p>

            <h3 class="mt-1 text-3xl font-extrabold text-slate-900">
               {{ $totalEmployees }}
            </h3>

        </div>
  <!-- active Employees -->

        <div
            class="group rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-xl"
        >

            <div class="flex items-center justify-between">

                <div
                    class="flex h-12 w-12 items-center justify-center rounded-2xl bg-indigo-50 text-indigo-600"
                >
                    👥
                </div>

                <span
                    class="text-xs font-semibold text-emerald-600"
                >
                    Team
                </span>

            </div>

            <p class="mt-5 text-sm text-slate-500">
                Total active Employees
            </p>

            <h3 class="mt-1 text-3xl font-extrabold text-slate-900">
               {{ $activeEmployees }}
            </h3>

        </div>
  <!-- Inactive  Employees -->

        <div
            class="group rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-xl"
        >

            <div class="flex items-center justify-between">

                <div
                    class="flex h-12 w-12 items-center justify-center rounded-2xl bg-indigo-50 text-indigo-600"
                >
                    👥
                </div>

                <span
                    class="text-xs font-semibold text-emerald-600"
                >
                    Team
                </span>

            </div>

            <p class="mt-5 text-sm text-slate-500">
                Total Inactive Employes
            </p>

            <h3 class="mt-1 text-3xl font-extrabold text-slate-900">
               {{ $inactiveEmployees }}
            </h3>

        </div>
        <!-- Tasks -->

        <div
            class="group rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-xl"
        >

            <div class="flex items-center justify-between">

                <div
                    class="flex h-12 w-12 items-center justify-center rounded-2xl bg-purple-50 text-purple-600"
                >
                    ✓
                </div>

                <span
                    class="text-xs font-semibold text-purple-600"
                >
                    Tasks
                </span>

            </div>

            <p class="mt-5 text-sm text-slate-500">
                Total Tasks
            </p>

            <h3 class="mt-1 text-3xl font-extrabold text-slate-900">
                {{ $totalTasks }}
            </h3>

        </div>


        <!-- Pending -->

        <div
            class="group rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-xl"
        >

            <div class="flex items-center justify-between">

                <div
                    class="flex h-12 w-12 items-center justify-center rounded-2xl bg-amber-50 text-amber-600"
                >
                    ⏳
                </div>

                <span
                    class="text-xs font-semibold text-amber-600"
                >
                    Pending
                </span>

            </div>

            <p class="mt-5 text-sm text-slate-500">
                Pending Tasks
            </p>

            <h3 class="mt-1 text-3xl font-extrabold text-slate-900">
              {{ $pendingTasks }}
            </h3>

        </div>


        <!-- Completed -->

        <div
            class="group rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-xl"
        >

            <div class="flex items-center justify-between">

                <div
                    class="flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-600"
                >
                    ✓
                </div>

                <span
                    class="text-xs font-semibold text-emerald-600"
                >
                    Completed
                </span>

            </div>

            <p class="mt-5 text-sm text-slate-500">
                Completed Tasks
            </p>

            <h3 class="mt-1 text-3xl font-extrabold text-slate-900">
               {{ $completedTasks }}
            </h3>

        </div>

         <!--OverDUe Task Completed -->

        <div
            class="group rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-xl"
        >

            <div class="flex items-center justify-between">

                <div
                    class="flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-600"
                >
                    ✓
                </div>

                <span
                    class="text-xs font-semibold text-emerald-600"
                >
                    {{ $overdueTasks }}

                </span>

            </div>

            <p class="mt-5 text-sm text-slate-500">
                OVERDUE Tasks
            </p>

            <h3 class="mt-1 text-3xl font-extrabold text-slate-900">
              {{ $overdueTasks }}
            </h3>

        </div>
    </div>


    <!-- Bottom section -->

    <div class="grid gap-6 xl:grid-cols-3">


        <!-- Quick Actions -->

        <div
            class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm"
        >

            <div class="mb-5">

                <h3 class="text-lg font-bold text-slate-900">
                    Quick Actions
                </h3>

                <p class="mt-1 text-sm text-slate-500">
                    Frequently used actions
                </p>

            </div>


            <div class="space-y-3">

                <a
                    href="{{ route('admin.tasks.create') }}"
                    class="flex items-center gap-4 rounded-xl border border-slate-100 p-4 transition hover:border-indigo-200 hover:bg-indigo-50"
                >

                    <div
                        class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-100 text-indigo-600"
                    >
                        +
                    </div>

                    <div>

                        <p class="font-semibold text-slate-800">
                            Create Task
                        </p>

                        <p class="text-xs text-slate-500">
                            Assign work to an employee
                        </p>

                    </div>

                </a>


                <a
                    href="{{ route('admin.employees.create') }}"
                    class="flex items-center gap-4 rounded-xl border border-slate-100 p-4 transition hover:border-purple-200 hover:bg-purple-50"
                >

                    <div
                        class="flex h-10 w-10 items-center justify-center rounded-xl bg-purple-100 text-purple-600"
                    >
                        +
                    </div>

                    <div>

                        <p class="font-semibold text-slate-800">
                            Add Employee
                        </p>

                        <p class="text-xs text-slate-500">
                            Add a new team member
                        </p>

                    </div>

                </a>


                <a
                    href="{{ route('admin.tasks.index') }}"
                    class="flex items-center gap-4 rounded-xl border border-slate-100 p-4 transition hover:border-emerald-200 hover:bg-emerald-50"
                >

                    <div
                        class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-100 text-emerald-600"
                    >
                        →
                    </div>

                    <div>

                        <p class="font-semibold text-slate-800">
                            View Tasks
                        </p>

                        <p class="text-xs text-slate-500">
                            Track your team's work
                        </p>

                    </div>

                </a>

            </div>

        </div>


        <!-- Getting Started -->

        <div
            class="xl:col-span-2 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm"
        >

            <div class="mb-6">

                <h3 class="text-lg font-bold text-slate-900">
                    Project Progress
                </h3>

                <p class="mt-1 text-sm text-slate-500">
                    Employee Task Management System
                </p>

            </div>


            <div class="space-y-5">


                <div>

                    <div class="mb-2 flex justify-between text-sm">

                        <span class="font-medium text-slate-700">
                            Admin Authentication
                        </span>

                        <span class="font-bold text-emerald-600">
                            Done
                        </span>

                    </div>

                    <div class="h-2 rounded-full bg-slate-100">

                        <div
                            class="h-2 w-full rounded-full bg-emerald-500"
                        ></div>

                    </div>

                </div>


                <div>

                    <div class="mb-2 flex justify-between text-sm">

                        <span class="font-medium text-slate-700">
                            Employee Management
                        </span>

                        <span class="font-bold text-emerald-600">
                            Done
                        </span>

                    </div>

                    <div class="h-2 rounded-full bg-slate-100">

                        <div
                            class="h-2 w-full rounded-full bg-emerald-500"
                        ></div>

                    </div>

                </div>


                <div>

                @php
    $taskProgress = $totalTasks > 0
        ? round(($completedTasks / $totalTasks) * 100)
        : 0;
@endphp
                   <div class="mb-2 flex justify-between text-sm">

        <span class="font-medium text-slate-700">
            Task Management
        </span>

        <span class="font-bold text-indigo-600">
            {{ $taskProgress }}%
        </span>

    </div>

                   <div class="h-2 rounded-full bg-slate-100 overflow-hidden">

        <div
            class="h-2 rounded-full bg-indigo-500 transition-all duration-500"
            style="width: {{ $taskProgress }}%"
        ></div>

    </div>

     <p class="mt-2 text-xs text-slate-500">
        {{ $completedTasks }} of {{ $totalTasks }} tasks completed
    </p>

                </div>


                <div>

                    <div class="mb-2 flex justify-between text-sm">

                        <span class="font-medium text-slate-700">
                            Comments System
                        </span>

                        <span class="font-bold text-slate-400">
                            Next
                        </span>

                    </div>

                    <div class="h-2 rounded-full bg-slate-100">

                        <div
                            class="h-2 w-1/4 rounded-full bg-slate-300"
                        ></div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection