@extends('layouts.admin')

@section('title', 'Tasks')
@section('page-heading', 'Tasks')

@section('content')

<div class="space-y-6">

    {{-- Header --}}
    <div class="flex flex-col justify-between gap-5 lg:flex-row lg:items-end">

        <div>
            <div class="flex items-center gap-2 text-sm">
                <span class="font-semibold text-indigo-600">Workspace</span>
                <span class="text-slate-300">/</span>
                <span class="text-slate-500">Tasks</span>
            </div>

            <h1 class="mt-2 text-3xl font-extrabold tracking-tight text-slate-900">
                Task Management
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                Create, assign and track work across your team.
            </p>
        </div>

        <a
            href="{{ route('admin.tasks.create') }}"
            class="inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-600 px-5 py-3 text-sm font-bold text-white shadow-lg shadow-indigo-600/20 transition hover:-translate-y-0.5 hover:bg-indigo-700"
        >
            <span class="text-lg">+</span>
            Create Task
        </a>

    </div>


    {{-- Stats --}}
    <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">

        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-sm font-medium text-slate-500">
                Total Tasks
            </p>

            <p class="mt-2 text-3xl font-extrabold text-slate-900">
                {{ $tasks->count() }}
            </p>

            <p class="mt-1 text-xs text-slate-400">
                All assigned work
            </p>
        </div>


        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-sm font-medium text-slate-500">
                Pending
            </p>

            <p class="mt-2 text-3xl font-extrabold text-amber-500">
                {{ $tasks->where('status', 'pending')->count() }}
            </p>

            <p class="mt-1 text-xs text-slate-400">
                Waiting to start
            </p>
        </div>


        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-sm font-medium text-slate-500">
                In Progress
            </p>

            <p class="mt-2 text-3xl font-extrabold text-blue-600">
                {{ $tasks->where('status', 'in_progress')->count() }}
            </p>

            <p class="mt-1 text-xs text-slate-400">
                Currently working
            </p>
        </div>


        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-sm font-medium text-slate-500">
                Completed
            </p>

            <p class="mt-2 text-3xl font-extrabold text-emerald-600">
                {{ $tasks->where('status', 'completed')->count() }}
            </p>

            <p class="mt-1 text-xs text-slate-400">
                Finished tasks
            </p>
        </div>

    </div>


    {{-- Main Card --}}
    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

        {{-- Filters --}}
        <div class="border-b border-slate-200 p-5">

            <form
                method="GET"
                action="{{ route('admin.tasks.index') }}"
                class="grid gap-3 lg:grid-cols-12"
            >

                {{-- Search --}}
                <div class="relative lg:col-span-5">

                    <svg
                        class="absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        viewBox="0 0 24 24"
                    >
                        <circle cx="11" cy="11" r="7"></circle>
                        <path d="m20 20-3.5-3.5"></path>
                    </svg>

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search tasks..."
                        class="w-full rounded-xl border border-slate-200 bg-slate-50 py-3 pl-10 pr-4 text-sm outline-none transition focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10"
                    >

                </div>


                {{-- Status --}}
                <div class="lg:col-span-3">

                    <select
                        name="status"
                        class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none transition focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10"
                    >

                        <option value="">All Status</option>

                        <option
                            value="pending"
                            @selected(request('status') === 'pending')
                        >
                            Pending
                        </option>

                        <option
                            value="in_progress"
                            @selected(request('status') === 'in_progress')
                        >
                            In Progress
                        </option>

                        <option
                            value="completed"
                            @selected(request('status') === 'completed')
                        >
                            Completed
                        </option>

                    </select>

                </div>


                {{-- Priority --}}
                <div class="lg:col-span-3">

                    <select
                        name="priority"
                        class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none transition focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10"
                    >

                        <option value="">All Priority</option>

                        <option value="low" @selected(request('priority') === 'low')>
                            Low
                        </option>

                        <option value="medium" @selected(request('priority') === 'medium')>
                            Medium
                        </option>

                        <option value="high" @selected(request('priority') === 'high')>
                            High
                        </option>

                        <option value="urgent" @selected(request('priority') === 'urgent')>
                            Urgent
                        </option>

                    </select>

                </div>


                {{-- Filter --}}
                <div class="lg:col-span-1">

                    <button
                        type="submit"
                        class="w-full rounded-xl bg-slate-900 px-4 py-3 text-sm font-bold text-white transition hover:bg-slate-800"
                    >
                        Filter
                    </button>

                </div>

            </form>

        </div>


        {{-- Task List --}}

        @if($tasks->count())

            <div class="divide-y divide-slate-100">

            
                @foreach($tasks as $task)

                    @php

                        $priorityClasses = [
                            'low' => 'bg-slate-100 text-slate-600',
                            'medium' => 'bg-blue-50 text-blue-600',
                            'high' => 'bg-orange-50 text-orange-600',
                            'urgent' => 'bg-red-50 text-red-600',
                        ];

                        $statusClasses = [
                            'pending' => 'bg-amber-50 text-amber-700',
                            'in_progress' => 'bg-blue-50 text-blue-700',
                            'completed' => 'bg-emerald-50 text-emerald-700',
                        ];

                    @endphp

                    <div class="group p-5 transition hover:bg-slate-50 sm:p-6">

                        <div class="flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between">

                            {{-- Task Info --}}
                            <div class="min-w-0 flex-1">

                                <div class="flex flex-wrap items-center gap-2">

                                    <h3 class="text-base font-bold text-slate-900">
                                        {{ $task->title }}
                                    </h3>

                                    <span
                                        class="rounded-full px-2.5 py-1 text-[11px] font-bold uppercase {{ $priorityClasses[$task->priority] ?? 'bg-slate-100 text-slate-600' }}"
                                    >
                                        {{ $task->priority }}
                                    </span>

                                </div>


                                @if($task->description)

                                    <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-500">
                                        {{ \Illuminate\Support\Str::limit($task->description, 140) }}
                                    </p>

                                @endif


                                <div class="mt-4 flex flex-wrap items-center gap-4 text-xs text-slate-500">

                                    {{-- Employee --}}

                                    <div class="flex items-center gap-2">

                                        <div class="flex h-7 w-7 items-center justify-center rounded-lg bg-gradient-to-br from-indigo-500 to-purple-600 text-[10px] font-bold text-white">
                                            {{ $task->employee ? strtoupper(substr($task->employee->name, 0, 1)) : '?' }}
                                        </div>

                                        <span>
                                            {{ $task->employee?->name ?? 'Unassigned' }}
                                        </span>

                                    </div>


                                    {{-- Due Date --}}

                                    @if($task->due_date)

                                        <span class="text-slate-300">•</span>

                                        <span>
                                            Due {{ $task->due_date->format('d M Y') }}
                                        </span>

                                    @endif

                                </div>

                            </div>


                            {{-- Right Side --}}

                            <div class="flex flex-wrap items-center gap-3">

                                <span
                                    class="rounded-full px-3 py-1.5 text-xs font-bold {{ $statusClasses[$task->status] ?? 'bg-slate-100 text-slate-600' }}"
                                >
                                    {{ str_replace('_', ' ', ucfirst($task->status)) }}
                                </span>


                                <a
                                    href="{{ route('admin.tasks.edit', $task) }}"
                                    class="rounded-xl border border-slate-200 bg-white px-4 py-2 text-xs font-bold text-slate-600 shadow-sm transition hover:border-indigo-200 hover:bg-indigo-50 hover:text-indigo-600"
                                >
                                    Edit
                                </a>

                                <a
    href="{{ route('admin.tasks.show', $task) }}"
    class="rounded-lg px-3 py-2 text-xs font-semibold text-slate-600 transition hover:bg-slate-100"
>
    View
</a>

                                <form
                                    action="{{ route('admin.tasks.destroy', $task) }}"
                                    method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this task?')"
                                >

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="rounded-xl border border-red-100 bg-red-50 px-4 py-2 text-xs font-bold text-red-600 transition hover:bg-red-100"
                                    >
                                        Delete
                                    </button>

                                </form>

                            </div>

                        </div>

                    </div>

                @endforeach

                @if($tasks->hasPages())
    <div class="mt-6">
        {{ $tasks->links() }}
    </div>
@endif
            </div>

        @else

            {{-- Empty State --}}

            <div class="px-6 py-20 text-center">

                <div
                    class="mx-auto flex h-20 w-20 items-center justify-center rounded-3xl bg-indigo-50 text-3xl"
                >
                    ✓
                </div>

                <h3 class="mt-5 text-xl font-extrabold text-slate-900">
                    No tasks found
                </h3>

                <p class="mx-auto mt-2 max-w-md text-sm text-slate-500">
                    Create your first task and assign it to an employee.
                </p>

                <a
                    href="{{ route('admin.tasks.create') }}"
                    class="mt-6 inline-flex items-center gap-2 rounded-xl bg-indigo-600 px-5 py-3 text-sm font-bold text-white shadow-lg shadow-indigo-600/20 transition hover:bg-indigo-700"
                >
                    + Create First Task
                </a>

            </div>

        @endif

    </div>

</div>

@endsection