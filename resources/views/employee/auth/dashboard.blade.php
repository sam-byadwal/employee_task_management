@extends('layouts.employee')

@section('title', 'Dashboard')

@section('content')

<div class="space-y-8">

    <!-- ================= WELCOME ================= -->

    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-indigo-600 via-violet-600 to-purple-700 p-6 text-white shadow-xl shadow-indigo-500/10 sm:p-8">

        <!-- Decorative circles -->

        <div class="absolute -right-20 -top-20 h-64 w-64 rounded-full bg-white/10"></div>

        <div class="absolute -bottom-24 right-32 h-48 w-48 rounded-full bg-white/5"></div>


        <div class="relative">

            <div class="max-w-2xl">

                <p class="mb-2 text-sm font-medium text-indigo-200">
                    Employee Dashboard
                </p>

                <h1 class="text-2xl font-bold tracking-tight sm:text-3xl">
                    Good morning, {{ auth()->user()->name }} 👋
                </h1>

                <p class="mt-3 max-w-xl text-sm leading-6 text-indigo-100 sm:text-base">
                    Welcome back. Here's an overview of your tasks and
                    current workload.
                </p>

            </div>


            <div class="mt-6 flex flex-wrap gap-3">

                <a
                    href="#tasks"
                    class="rounded-xl bg-white px-5 py-3 text-sm font-semibold text-indigo-700 shadow-lg transition hover:bg-indigo-50"
                >
                    View My Tasks
                </a>

                <span
                    class="rounded-xl border border-white/20 bg-white/10 px-5 py-3 text-sm font-medium text-white backdrop-blur"
                >
                    {{ now()->format('d M Y') }}
                </span>

            </div>

        </div>

    </div>


    <!-- ================= STATISTICS ================= -->

    <div class="grid gap-5 sm:grid-cols-2 xl:grid-cols-4">

        <!-- Total -->

        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm font-medium text-slate-500">
                        Total Tasks
                    </p>

                    <h2 class="mt-2 text-3xl font-bold text-slate-900">
                        {{ $totalTasks }}
                    </h2>

                </div>

                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-indigo-50 text-indigo-600">

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
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M9 5a3 3 0 006 0M9 12h6M9 16h4"
                        />
                    </svg>

                </div>

            </div>

        </div>


        <!-- Pending -->

        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm font-medium text-slate-500">
                        Pending
                    </p>

                    <h2 class="mt-2 text-3xl font-bold text-slate-900">
                        {{ $pendingTasks }}
                    </h2>

                </div>

                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-amber-50 text-amber-600">

                    <svg
                        class="h-6 w-6"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        viewBox="0 0 24 24"
                    >
                        <circle
                            cx="12"
                            cy="12"
                            r="9"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 7v5l3 2"
                        />
                    </svg>

                </div>

            </div>

        </div>


        <!-- In Progress -->

        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm font-medium text-slate-500">
                        In Progress
                    </p>

                    <h2 class="mt-2 text-3xl font-bold text-slate-900">
                        {{ $inProgressTasks }}
                    </h2>

                </div>

                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-50 text-blue-600">

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
                            d="M13 10V3L4 14h7v7l9-11h-7z"
                        />
                    </svg>

                </div>

            </div>

        </div>


        <!-- Completed -->

        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm font-medium text-slate-500">
                        Completed
                    </p>

                    <h2 class="mt-2 text-3xl font-bold text-slate-900">
                        {{ $completedTasks }}
                    </h2>

                </div>

                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-600">

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
                            d="M9 12l2 2 4-4"
                        />

                        <circle
                            cx="12"
                            cy="12"
                            r="9"
                        />
                    </svg>

                </div>

            </div>

        </div>

    </div>


    <!-- ================= PROGRESS + OVERDUE ================= -->

    <div class="grid gap-6 lg:grid-cols-3">

        <!-- Progress -->

        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm lg:col-span-2">

            @php
                $progress = $totalTasks > 0
                    ? round(($completedTasks / $totalTasks) * 100)
                    : 0;
            @endphp

            <div class="flex items-center justify-between">

                <div>

                    <h2 class="text-lg font-bold text-slate-900">
                        Task Progress
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Your overall completion rate
                    </p>

                </div>

                <div class="text-2xl font-bold text-indigo-600">
                    {{ $progress }}%
                </div>

            </div>


            <div class="mt-6 h-4 overflow-hidden rounded-full bg-slate-100">

                <div
                    class="h-full rounded-full bg-gradient-to-r from-indigo-500 to-violet-600 transition-all duration-500"
                    style="width: {{ $progress }}%"
                ></div>

            </div>


            <div class="mt-4 flex justify-between text-xs text-slate-500">

                <span>
                    {{ $completedTasks }} completed
                </span>

                <span>
                    {{ $totalTasks }} total tasks
                </span>

            </div>

        </div>


        <!-- Overdue -->

        <div class="rounded-2xl border border-red-100 bg-gradient-to-br from-red-50 to-white p-6 shadow-sm">

            <div class="flex items-start justify-between">

                <div>

                    <p class="text-sm font-medium text-red-600">
                        Attention Required
                    </p>

                    <h2 class="mt-2 text-4xl font-bold text-red-700">
                        {{ $overdueTasks }}
                    </h2>

                    <p class="mt-2 text-sm text-slate-600">
                        overdue task{{ $overdueTasks == 1 ? '' : 's' }}
                    </p>

                </div>

                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-red-100 text-red-600">

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
                            d="M12 9v4M12 17h.01"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M10.3 3.9L2.7 17a2 2 0 001.7 3h15.2a2 2 0 001.7-3L13.7 3.9a2 2 0 00-3.4 0z"
                        />
                    </svg>

                </div>

            </div>

            @if($overdueTasks > 0)

                <p class="mt-5 text-xs font-medium text-red-600">
                    Please review these tasks as soon as possible.
                </p>

            @else

                <p class="mt-5 text-xs font-medium text-emerald-600">
                    Great! You have no overdue tasks.
                </p>

            @endif

        </div>

    </div>


    <!-- ================= TASKS ================= -->

    <div
        id="tasks"
        class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm"
    >

        <div class="flex flex-col justify-between gap-4 border-b border-slate-200 p-6 sm:flex-row sm:items-center">

            <div>

                <h2 class="text-lg font-bold text-slate-900">
                    My Recent Tasks
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Tasks assigned to you by the administrator
                </p>

            </div>

            <span class="rounded-xl bg-slate-100 px-4 py-2 text-xs font-semibold text-slate-600">
                {{ $totalTasks }} Tasks
            </span>

        </div>


        @if($tasks->count())

            <div class="divide-y divide-slate-100">

                @foreach($tasks as $task)

                    <div class="p-5 transition hover:bg-slate-50 sm:p-6">

                        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">

                            <!-- Task info -->

                            <div class="min-w-0 flex-1">

                                <div class="flex flex-wrap items-center gap-2">

                                    <h3 class="font-semibold text-slate-900">
                                        {{ $task->title }}
                                    </h3>


                                    <!-- Status -->

                                    @if($task->status === 'completed')

                                        <span class="rounded-full bg-emerald-100 px-2.5 py-1 text-[11px] font-semibold text-emerald-700">
                                            Completed
                                        </span>

                                    @elseif($task->status === 'in_progress')

                                        <span class="rounded-full bg-blue-100 px-2.5 py-1 text-[11px] font-semibold text-blue-700">
                                            In Progress
                                        </span>

                                    @else

                                        <span class="rounded-full bg-amber-100 px-2.5 py-1 text-[11px] font-semibold text-amber-700">
                                            Pending
                                        </span>

                                    @endif


                                    <!-- Priority -->

                                    @if($task->priority === 'urgent')

                                        <span class="rounded-full bg-red-100 px-2.5 py-1 text-[11px] font-semibold text-red-700">
                                            Urgent
                                        </span>

                                    @elseif($task->priority === 'high')

                                        <span class="rounded-full bg-orange-100 px-2.5 py-1 text-[11px] font-semibold text-orange-700">
                                            High
                                        </span>

                                    @elseif($task->priority === 'medium')

                                        <span class="rounded-full bg-indigo-100 px-2.5 py-1 text-[11px] font-semibold text-indigo-700">
                                            Medium
                                        </span>

                                    @else

                                        <span class="rounded-full bg-slate-100 px-2.5 py-1 text-[11px] font-semibold text-slate-600">
                                            Low
                                        </span>

                                    @endif

                                </div>


                                @if($task->description)

                                    <p class="mt-2 line-clamp-2 text-sm text-slate-500">
                                        {{ $task->description }}
                                    </p>

                                @endif


                                <div class="mt-3 flex flex-wrap items-center gap-4 text-xs text-slate-500">

                                    <span class="flex items-center gap-1.5">

                                        <svg
                                            class="h-4 w-4"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.8"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M8 7V3M16 7V3M4 11h16M5 5h14a1 1 0 011 1v14a1 1 0 01-1 1H5a1 1 0 01-1-1V6a1 1 0 011-1z"
                                            />
                                        </svg>

                                        {{ $task->created_at->format('d M Y') }}

                                    </span>


                                    @if($task->due_date)

                                        <span class="flex items-center gap-1.5">

                                            <svg
                                                class="h-4 w-4"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="1.8"
                                                viewBox="0 0 24 24"
                                            >
                                                <circle
                                                    cx="12"
                                                    cy="12"
                                                    r="9"
                                                />

                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M12 7v5l3 2"
                                                />
                                            </svg>

                                            Due {{ $task->due_date->format('d M Y') }}

                                        </span>

                                    @endif


                                    <span class="flex items-center gap-1.5">

                                        <svg
                                            class="h-4 w-4"
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
                                                d="M20 11.5a8 8 0 01-8 8 8.5 8.5 0 01-3.5-.8L4 20l1.3-3A8 8 0 1120 11.5z"
                                            />
                                        </svg>

                                        {{ $task->comments->count() }} comments

                                    </span>

                                </div>

                            </div>


                            <!-- Task action -->

                            <div class="shrink-0">

                                <a
                                    href="{{ route('employee.tasks.show', $task) }}"
                                    class="inline-flex items-center gap-2 rounded-xl border border-slate-200 px-4 py-2.5 text-xs font-semibold text-slate-700 transition hover:border-indigo-200 hover:bg-indigo-50 hover:text-indigo-700"
                                >

                                    View Task

                                    <svg
                                        class="h-4 w-4"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M9 5l7 7-7 7"
                                        />
                                    </svg>

                                </a>

                            </div>

                        </div>

                    </div>

                @endforeach

            </div>

        @else

            <div class="px-6 py-16 text-center">

                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-slate-100 text-slate-400">

                    <svg
                        class="h-8 w-8"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.6"
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
                            d="M9 5a3 3 0 006 0M9 12h6"
                        />
                    </svg>

                </div>

                <h3 class="mt-5 text-lg font-bold text-slate-900">
                    No tasks assigned
                </h3>

                <p class="mx-auto mt-2 max-w-sm text-sm text-slate-500">
                    You don't have any tasks assigned to you yet.
                    New tasks will appear here.
                </p>

            </div>

        @endif

    </div>

</div>

@endsection