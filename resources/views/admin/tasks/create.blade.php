@extends('layouts.admin')

@section('title', 'Create Task')
@section('page-heading', 'Create Task')

@section('content')

<div class="mx-auto max-w-6xl">

    {{-- Header --}}
    <div class="mb-8">

        <a
            href="{{ route('admin.tasks.index') }}"
            class="inline-flex items-center gap-2 text-sm font-medium text-slate-500 transition hover:text-indigo-600"
        >
            ← Back to Tasks
        </a>

        <div class="mt-5">

            <span class="inline-flex rounded-full bg-indigo-50 px-3 py-1 text-xs font-bold tracking-wide text-indigo-600">
                TASK MANAGEMENT
            </span>

            <h1 class="mt-3 text-3xl font-extrabold tracking-tight text-slate-900">
                Create New Task
            </h1>

            <p class="mt-2 text-sm text-slate-500">
                Create a task, assign it to an employee and define its priority.
            </p>

        </div>

    </div>


    {{-- Errors --}}
    @if ($errors->any())

        <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 p-5">

            <div class="flex gap-3">

                <div class="text-xl">⚠️</div>

                <div>

                    <h3 class="font-bold text-red-800">
                        Please fix the following errors
                    </h3>

                    <ul class="mt-2 list-disc space-y-1 pl-5 text-sm text-red-600">

                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach

                    </ul>

                </div>

            </div>

        </div>

    @endif


    <form
        action="{{ route('admin.tasks.store') }}"
        method="POST"
    >

        @csrf

        <div class="grid gap-6 lg:grid-cols-3">


            {{-- LEFT --}}
            <div class="space-y-6 lg:col-span-2">


                {{-- Basic Information --}}
                <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">

                    <div class="border-b border-slate-200 bg-gradient-to-r from-slate-50 to-white px-6 py-6">

                        <div class="flex items-center gap-4">

                            <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-indigo-100 text-lg">
                                📝
                            </div>

                            <div>

                                <h2 class="font-bold text-slate-900">
                                    Task Information
                                </h2>

                                <p class="mt-1 text-xs text-slate-500">
                                    Add the basic details of your task.
                                </p>

                            </div>

                        </div>

                    </div>


                    <div class="space-y-6 p-6">


                        {{-- Title --}}
                        <div>

                            <label class="mb-2 block text-sm font-bold text-slate-700">
                                Task Title
                            </label>

                            <input
                                type="text"
                                name="title"
                                value="{{ old('title') }}"
                                placeholder="e.g. Build employee dashboard"
                                required
                                class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10"
                            >

                        </div>


                        {{-- Description --}}
                        <div>

                            <label class="mb-2 block text-sm font-bold text-slate-700">
                                Description
                            </label>

                            <textarea
                                name="description"
                                rows="7"
                                placeholder="Describe what needs to be completed..."
                                class="w-full resize-none rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm leading-6 text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10"
                            >{{ old('description') }}</textarea>

                            <p class="mt-2 text-xs text-slate-400">
                                Give enough information so the employee understands the task.
                            </p>

                        </div>

                    </div>

                </div>


                {{-- Priority --}}
                <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">

                    <div class="border-b border-slate-200 px-6 py-5">

                        <h2 class="font-bold text-slate-900">
                            Priority
                        </h2>

                        <p class="mt-1 text-xs text-slate-500">
                            How important is this task?
                        </p>

                    </div>


                    <div class="grid gap-3 p-6 sm:grid-cols-4">

                        @php
                            $priorities = [
                                'low' => [
                                    'label' => 'Low',
                                    'description' => 'Can wait',
                                    'icon' => '↓',
                                    'active' => 'border-slate-400 bg-slate-50 ring-2 ring-slate-200',
                                ],
                                'medium' => [
                                    'label' => 'Medium',
                                    'description' => 'Normal',
                                    'icon' => '→',
                                    'active' => 'border-blue-400 bg-blue-50 ring-2 ring-blue-100',
                                ],
                                'high' => [
                                    'label' => 'High',
                                    'description' => 'Important',
                                    'icon' => '↑',
                                    'active' => 'border-orange-400 bg-orange-50 ring-2 ring-orange-100',
                                ],
                                'urgent' => [
                                    'label' => 'Urgent',
                                    'description' => 'Immediate',
                                    'icon' => '!',
                                    'active' => 'border-red-400 bg-red-50 ring-2 ring-red-100',
                                ],
                            ];
                        @endphp


                        @foreach($priorities as $value => $priority)

                            <label class="priority-option cursor-pointer">

                                <input
                                    type="radio"
                                    name="priority"
                                    value="{{ $value }}"
                                    class="peer sr-only"
                                    {{ old('priority', 'medium') === $value ? 'checked' : '' }}
                                >

                                <div
                                    class="rounded-2xl border border-slate-200 p-4 transition peer-checked:{{ $priority['active'] }} hover:border-slate-300"
                                >

                                    <div class="flex items-center justify-between">

                                        <span class="text-xl font-extrabold">
                                            {{ $priority['icon'] }}
                                        </span>

                                        <span class="h-2.5 w-2.5 rounded-full
                                            {{ $value === 'low' ? 'bg-slate-400' : '' }}
                                            {{ $value === 'medium' ? 'bg-blue-500' : '' }}
                                            {{ $value === 'high' ? 'bg-orange-500' : '' }}
                                            {{ $value === 'urgent' ? 'bg-red-500' : '' }}
                                        "></span>

                                    </div>

                                    <p class="mt-3 text-sm font-bold text-slate-800">
                                        {{ $priority['label'] }}
                                    </p>

                                    <p class="mt-1 text-xs text-slate-400">
                                        {{ $priority['description'] }}
                                    </p>

                                </div>

                            </label>

                        @endforeach

                    </div>

                </div>


            </div>


            {{-- RIGHT --}}
            <div class="space-y-6">


                {{-- Assignment --}}
                <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">

                    <div class="border-b border-slate-200 px-6 py-5">

                        <div class="flex items-center gap-3">

                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-purple-50">
                                👤
                            </div>

                            <div>

                                <h2 class="font-bold text-slate-900">
                                    Assignment
                                </h2>

                                <p class="mt-1 text-xs text-slate-500">
                                    Who will handle this task?
                                </p>

                            </div>

                        </div>

                    </div>


                    <div class="p-6">

                        <label class="mb-2 block text-sm font-bold text-slate-700">
                            Assign Employee
                        </label>

                        <select
                            name="assigned_to"
                            class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10"
                        >

                            <option value="">
                                Unassigned
                            </option>

                            @foreach($employees as $employee)

                                <option
                                    value="{{ $employee->id }}"
                                    @selected(old('assigned_to') == $employee->id)
                                >
                                    {{ $employee->name }}
                                    — {{ $employee->email }}
                                </option>

                            @endforeach

                        </select>

                    </div>

                </div>


                {{-- Status --}}
                <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">

                    <div class="border-b border-slate-200 px-6 py-5">

                        <h2 class="font-bold text-slate-900">
                            Initial Status
                        </h2>

                        <p class="mt-1 text-xs text-slate-500">
                            Set the starting workflow status.
                        </p>

                    </div>


                    <div class="space-y-3 p-6">

                        @php
                            $statuses = [
                                'pending' => [
                                    'label' => 'Pending',
                                    'description' => 'Not started yet',
                                ],
                                'in_progress' => [
                                    'label' => 'In Progress',
                                    'description' => 'Currently being worked on',
                                ],
                                'completed' => [
                                    'label' => 'Completed',
                                    'description' => 'Already finished',
                                ],
                            ];
                        @endphp


                        @foreach($statuses as $value => $status)

                            <label class="block cursor-pointer">

                                <input
                                    type="radio"
                                    name="status"
                                    value="{{ $value }}"
                                    class="peer sr-only"
                                    {{ old('status', 'pending') === $value ? 'checked' : '' }}
                                >

                                <div
                                    class="flex items-center justify-between rounded-2xl border border-slate-200 p-4 transition peer-checked:border-indigo-400 peer-checked:bg-indigo-50 peer-checked:ring-2 peer-checked:ring-indigo-100 hover:bg-slate-50"
                                >

                                    <div>

                                        <p class="text-sm font-bold text-slate-800">
                                            {{ $status['label'] }}
                                        </p>

                                        <p class="mt-1 text-xs text-slate-400">
                                            {{ $status['description'] }}
                                        </p>

                                    </div>

                                    <div class="h-3 w-3 rounded-full
                                        {{ $value === 'pending' ? 'bg-amber-400' : '' }}
                                        {{ $value === 'in_progress' ? 'bg-blue-500' : '' }}
                                        {{ $value === 'completed' ? 'bg-emerald-500' : '' }}
                                    "></div>

                                </div>

                            </label>

                        @endforeach

                    </div>

                </div>


                {{-- Due Date --}}
                <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">

                    <div class="border-b border-slate-200 px-6 py-5">

                        <h2 class="font-bold text-slate-900">
                            Deadline
                        </h2>

                        <p class="mt-1 text-xs text-slate-500">
                            When should this task be completed?
                        </p>

                    </div>


                    <div class="p-6">

                        <label class="mb-2 block text-sm font-bold text-slate-700">
                            Due Date
                        </label>

                        <input
                            type="date"
                            name="due_date"
                            value="{{ old('due_date') }}"
                            min="{{ now()->format('Y-m-d') }}"
                            class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10"
                        >

                    </div>

                </div>


            </div>

        </div>


        {{-- Bottom Actions --}}
        <div class="mt-6 flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">

            <a
                href="{{ route('admin.tasks.index') }}"
                class="rounded-xl border border-slate-200 bg-white px-6 py-3 text-center text-sm font-bold text-slate-600 shadow-sm transition hover:bg-slate-100"
            >
                Cancel
            </a>

            <button
                type="submit"
                class="rounded-xl bg-indigo-600 px-7 py-3 text-sm font-bold text-white shadow-lg shadow-indigo-600/20 transition hover:-translate-y-0.5 hover:bg-indigo-700 hover:shadow-xl"
            >
                Create Task →
            </button>

        </div>

    </form>

</div>

@endsection