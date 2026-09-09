@extends('layouts.employee')

@section('title', 'My Tasks')

@section('content')

<div class="space-y-6">

    {{-- Header --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>
            <p class="text-sm font-medium text-indigo-600">
                Workspace
            </p>

            <h1 class="mt-1 text-3xl font-bold tracking-tight text-slate-900">
                My Tasks
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                View and manage the tasks assigned to you.
            </p>
        </div>

        <div class="flex items-center gap-2 rounded-xl bg-white px-4 py-3 shadow-sm ring-1 ring-slate-200">
            <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-indigo-50">
                <svg class="h-5 w-5 text-indigo-600" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a3 3 0 006 0M9 5h6" />
                </svg>
            </div>

            <div>
                <p class="text-xs text-slate-500">
                    Total Tasks
                </p>

                <p class="text-lg font-bold text-slate-900">
                    {{ $tasks->count() }}
                </p>
            </div>
        </div>

    </div>


    {{-- Filters --}}
    <div class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-slate-200">

        <form
            method="GET"
            action="{{ route('employee.tasks.index') }}"
            class="grid grid-cols-1 gap-4 md:grid-cols-4"
        >

            {{-- Search --}}
            <div class="md:col-span-2">

                <label class="mb-2 block text-sm font-semibold text-slate-700">
                    Search tasks
                </label>

                <div class="relative">

                    <svg
                        class="absolute left-3 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-400"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="m21 21-4.35-4.35m1.35-5.65a7 7 0 11-14 0 7 7 0 0114 0z"
                        />
                    </svg>

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search by task title or description..."
                        class="w-full rounded-xl border border-slate-200 bg-slate-50 py-3 pl-10 pr-4 text-sm text-slate-800 outline-none transition focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-100"
                    >

                </div>

            </div>


            {{-- Status --}}
            <div>

                <label class="mb-2 block text-sm font-semibold text-slate-700">
                    Status
                </label>

                <select
                    name="status"
                    class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-100"
                >

                    <option value="">
                        All Status
                    </option>

                    <option
                        value="pending"
                        {{ request('status') === 'pending' ? 'selected' : '' }}
                    >
                        Pending
                    </option>

                    <option
                        value="in_progress"
                        {{ request('status') === 'in_progress' ? 'selected' : '' }}
                    >
                        In Progress
                    </option>

                    <option
                        value="completed"
                        {{ request('status') === 'completed' ? 'selected' : '' }}
                    >
                        Completed
                    </option>

                </select>

            </div>


            {{-- Priority --}}
            <div>

                <label class="mb-2 block text-sm font-semibold text-slate-700">
                    Priority
                </label>

                <select
                    name="priority"
                    class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-100"
                >

                    <option value="">
                        All Priority
                    </option>

                    <option
                        value="low"
                        {{ request('priority') === 'low' ? 'selected' : '' }}
                    >
                        Low
                    </option>

                    <option
                        value="medium"
                        {{ request('priority') === 'medium' ? 'selected' : '' }}
                    >
                        Medium
                    </option>

                    <option
                        value="high"
                        {{ request('priority') === 'high' ? 'selected' : '' }}
                    >
                        High
                    </option>

                    <option
                        value="urgent"
                        {{ request('priority') === 'urgent' ? 'selected' : '' }}
                    >
                        Urgent
                    </option>

                </select>

            </div>


            {{-- Buttons --}}
            <div class="flex items-end gap-2 md:col-span-4">

                <button
                    type="submit"
                    class="rounded-xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700"
                >
                    Apply Filters
                </button>

                <a
                    href="{{ route('employee.tasks.index') }}"
                    class="rounded-xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-50"
                >
                    Reset
                </a>

            </div>

        </form>

    </div>


    {{-- Task List --}}
    <div class="space-y-4">

        @forelse($tasks as $task)

            <div
                class="group rounded-2xl bg-white p-5 shadow-sm ring-1 ring-slate-200 transition hover:-translate-y-0.5 hover:shadow-md"
            >

                <div class="flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between">

                    {{-- Left --}}
                    <div class="min-w-0 flex-1">

                        <div class="flex flex-wrap items-center gap-2">

                            {{-- Status --}}
                            @if($task->status === 'pending')

                                <span class="rounded-full bg-amber-50 px-3 py-1 text-xs font-semibold text-amber-700">
                                    Pending
                                </span>

                            @elseif($task->status === 'in_progress')

                                <span class="rounded-full bg-blue-50 px-3 py-1 text-xs font-semibold text-blue-700">
                                    In Progress
                                </span>

                            @elseif($task->status === 'completed')

                                <span class="rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-700">
                                    Completed
                                </span>

                            @endif


                            {{-- Priority --}}
                            @if($task->priority === 'urgent')

                                <span class="rounded-full bg-red-50 px-3 py-1 text-xs font-semibold text-red-700">
                                    Urgent
                                </span>

                            @elseif($task->priority === 'high')

                                <span class="rounded-full bg-orange-50 px-3 py-1 text-xs font-semibold text-orange-700">
                                    High
                                </span>

                            @elseif($task->priority === 'medium')

                                <span class="rounded-full bg-indigo-50 px-3 py-1 text-xs font-semibold text-indigo-700">
                                    Medium
                                </span>

                            @else

                                <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-600">
                                    Low
                                </span>

                            @endif

                        </div>


                        {{-- Title --}}
                        <h2 class="mt-3 truncate text-lg font-bold text-slate-900">
                            {{ $task->title }}
                        </h2>


                        {{-- Description --}}
                        <p class="mt-1 line-clamp-2 text-sm leading-6 text-slate-500">
                            {{ $task->description ?: 'No description provided for this task.' }}
                        </p>


                        {{-- Meta --}}
                        <div class="mt-4 flex flex-wrap items-center gap-4 text-xs text-slate-500">

                            @if($task->due_date)

                                <div class="flex items-center gap-1.5">

                                    <svg
                                        class="h-4 w-4"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                                        />
                                    </svg>

                                    <span>
                                        Due {{ $task->due_date->format('d M Y') }}
                                    </span>

                                </div>

                            @endif


                            <div class="flex items-center gap-1.5">

                                <svg
                                    class="h-4 w-4"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M7 8h10M7 12h6m-6 4h4M5 4h14a2 2 0 012 2v12a2 2 0 01-2 2H5a2 2 0 01-2-2V6a2 2 0 012-2z"
                                    />
                                </svg>

                                <span>
                                    {{ $task->comments->count() }} comments
                                </span>

                            </div>

                        </div>

                    </div>


                    {{-- Right --}}
                    <div class="flex shrink-0 items-center justify-between gap-4 lg:flex-col lg:items-end">

                        @if($task->due_date && $task->status !== 'completed' && $task->due_date->isPast())

                            <span class="flex items-center gap-1.5 rounded-lg bg-red-50 px-3 py-2 text-xs font-semibold text-red-600">

                                <svg
                                    class="h-4 w-4"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12 9v4m0 4h.01M10.3 3.8l-8 14A2 2 0 004 21h16a2 2 0 001.7-3.2l-8-14a2 2 0 00-3.4 0z"
                                    />
                                </svg>

                                Overdue

                            </span>

                        @endif


                        <a
                            href="{{ route('employee.tasks.show', $task) }}"
                            class="inline-flex items-center gap-2 rounded-xl bg-slate-900 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-indigo-600"
                        >
                            View Task

                            <svg
                                class="h-4 w-4 transition group-hover:translate-x-0.5"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M9 5l7 7-7 7"
                                />
                            </svg>

                        </a>

                    </div>

                </div>

            </div>

        @empty

            {{-- Empty State --}}
            <div class="rounded-2xl bg-white px-6 py-16 text-center shadow-sm ring-1 ring-slate-200">

                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-indigo-50">

                    <svg
                        class="h-8 w-8 text-indigo-500"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M9 12h6m-6 4h4m-7 5h10a2 2 0 002-2V7.5L13.5 3H6a2 2 0 00-2 2v14a2 2 0 002 2zm7-18v4h4"
                        />
                    </svg>

                </div>

                <h3 class="mt-5 text-lg font-bold text-slate-900">
                    No tasks found
                </h3>

                <p class="mx-auto mt-2 max-w-md text-sm text-slate-500">
                    There are no tasks matching your current search or filters.
                </p>

                <a
                    href="{{ route('employee.tasks.index') }}"
                    class="mt-5 inline-flex rounded-xl bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-indigo-700"
                >
                    Clear Filters
                </a>

            </div>

        @endforelse

    </div>

</div>

@endsection