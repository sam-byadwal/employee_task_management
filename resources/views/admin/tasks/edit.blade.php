@extends('layouts.admin')

@section('title', 'Edit Task')
@section('page-heading', 'Edit Task')

@section('content')

<div class="max-w-7xl mx-auto">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">

        <div>
            <div class="flex items-center gap-2 text-sm text-slate-500 mb-2">
                <a href="{{ route('admin.tasks.index') }}"
                   class="hover:text-indigo-600 transition">
                    Tasks
                </a>

                <span>/</span>

                <span class="text-slate-700">Edit Task</span>
            </div>

            <h1 class="text-3xl font-bold text-slate-900">
                Edit Task
            </h1>

            <p class="text-slate-500 mt-1">
                Update task details and assignment.
            </p>
        </div>

        <a href="{{ route('admin.tasks.index') }}"
           class="inline-flex items-center justify-center gap-2 px-4 py-2.5
                  rounded-xl border border-slate-200 bg-white text-slate-700
                  font-medium hover:bg-slate-50 transition shadow-sm">

            <svg class="w-5 h-5"
                 fill="none"
                 stroke="currentColor"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M15 19l-7-7 7-7"/>
            </svg>

            Back to Tasks
        </a>

    </div>


    {{-- Validation Errors --}}
    @if ($errors->any())

        <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 p-5">

            <div class="flex gap-3">

                <div class="flex-shrink-0">
                    <svg class="w-6 h-6 text-red-500"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>

                <div>
                    <h3 class="font-semibold text-red-800">
                        Please fix the following errors:
                    </h3>

                    <ul class="mt-2 text-sm text-red-700 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>

            </div>

        </div>

    @endif


    <form action="{{ route('admin.tasks.update', $task) }}"
          method="POST">

        @csrf
        @method('PUT')


        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">


            {{-- LEFT --}}
            <div class="lg:col-span-2 space-y-6">


                {{-- Task Information --}}
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm">

                    <div class="px-6 py-5 border-b border-slate-100">

                        <h2 class="text-lg font-bold text-slate-900">
                            Task Information
                        </h2>

                        <p class="text-sm text-slate-500 mt-1">
                            Basic information about this task.
                        </p>

                    </div>


                    <div class="p-6 space-y-6">

                        {{-- Title --}}
                        <div>

                            <label class="block text-sm font-semibold text-slate-700 mb-2">
                                Task Title
                            </label>

                            <input
                                type="text"
                                name="title"
                                value="{{ old('title', $task->title) }}"
                                placeholder="e.g. Build employee dashboard"
                                class="w-full px-4 py-3 rounded-xl border border-slate-200
                                       focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100
                                       outline-none transition"
                                required
                            >

                        </div>


                        {{-- Description --}}
                        <div>

                            <label class="block text-sm font-semibold text-slate-700 mb-2">
                                Description
                            </label>

                            <textarea
                                name="description"
                                rows="7"
                                placeholder="Describe what needs to be completed..."
                                class="w-full px-4 py-3 rounded-xl border border-slate-200
                                       focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100
                                       outline-none transition resize-none"
                            >{{ old('description', $task->description) }}</textarea>

                            <p class="text-xs text-slate-400 mt-2">
                                Add enough details so the employee clearly understands the task.
                            </p>

                        </div>


                        {{-- Priority --}}
                        <div>

                            <label class="block text-sm font-semibold text-slate-700 mb-3">
                                Priority
                            </label>

                            <div class="grid grid-cols-2 md:grid-cols-4 gap-3">

                                @php
                                    $priorities = [
                                        'low' => [
                                            'label' => 'Low',
                                            'description' => 'Can wait',
                                        ],
                                        'medium' => [
                                            'label' => 'Medium',
                                            'description' => 'Normal priority',
                                        ],
                                        'high' => [
                                            'label' => 'High',
                                            'description' => 'Important',
                                        ],
                                        'urgent' => [
                                            'label' => 'Urgent',
                                            'description' => 'Do immediately',
                                        ],
                                    ];
                                @endphp


                                @foreach ($priorities as $value => $priority)

                                    <label class="cursor-pointer">

                                        <input
                                            type="radio"
                                            name="priority"
                                            value="{{ $value }}"
                                            class="peer sr-only"
                                            {{ old('priority', $task->priority) === $value ? 'checked' : '' }}
                                        >

                                        <div class="rounded-xl border-2 border-slate-200 p-4
                                                    transition
                                                    peer-checked:border-indigo-500
                                                    peer-checked:bg-indigo-50
                                                    hover:border-slate-300">

                                            <div class="font-semibold text-slate-800">
                                                {{ $priority['label'] }}
                                            </div>

                                            <div class="text-xs text-slate-500 mt-1">
                                                {{ $priority['description'] }}
                                            </div>

                                        </div>

                                    </label>

                                @endforeach

                            </div>

                        </div>

                    </div>

                </div>


                {{-- Current Task Info --}}
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm">

                    <div class="px-6 py-5 border-b border-slate-100">

                        <h2 class="text-lg font-bold text-slate-900">
                            Task Information
                        </h2>

                    </div>

                    <div class="p-6 grid grid-cols-1 md:grid-cols-3 gap-5">

                        <div class="rounded-xl bg-slate-50 p-4">
                            <p class="text-xs text-slate-500 uppercase tracking-wide">
                                Task ID
                            </p>

                            <p class="font-bold text-slate-900 mt-1">
                                #{{ $task->id }}
                            </p>
                        </div>


                        <div class="rounded-xl bg-slate-50 p-4">
                            <p class="text-xs text-slate-500 uppercase tracking-wide">
                                Created
                            </p>

                            <p class="font-bold text-slate-900 mt-1">
                                {{ $task->created_at?->format('d M Y') }}
                            </p>
                        </div>


                        <div class="rounded-xl bg-slate-50 p-4">
                            <p class="text-xs text-slate-500 uppercase tracking-wide">
                                Last Updated
                            </p>

                            <p class="font-bold text-slate-900 mt-1">
                                {{ $task->updated_at?->format('d M Y') }}
                            </p>
                        </div>

                    </div>

                </div>

            </div>


            {{-- RIGHT --}}
            <div class="space-y-6">


                {{-- Assignment --}}
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm">

                    <div class="px-6 py-5 border-b border-slate-100">

                        <h2 class="text-lg font-bold text-slate-900">
                            Assignment
                        </h2>

                        <p class="text-sm text-slate-500 mt-1">
                            Select an employee.
                        </p>

                    </div>


                    <div class="p-6">

                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            Assign To
                        </label>

                        <select
                            name="assigned_to"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200
                                   bg-white focus:border-indigo-500
                                   focus:ring-2 focus:ring-indigo-100
                                   outline-none transition"
                        >

                            <option value="">
                                Unassigned
                            </option>

                            @foreach ($employees as $employee)

                                <option
                                    value="{{ $employee->id }}"
                                    {{ (string) old('assigned_to', $task->assigned_to) === (string) $employee->id ? 'selected' : '' }}
                                >
                                    {{ $employee->name }}
                                    — {{ $employee->email }}
                                </option>

                            @endforeach

                        </select>

                    </div>

                </div>


                {{-- Status --}}
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm">

                    <div class="px-6 py-5 border-b border-slate-100">

                        <h2 class="text-lg font-bold text-slate-900">
                            Task Status
                        </h2>

                    </div>


                    <div class="p-6 space-y-3">

                        @php
                            $statuses = [
                                'pending' => [
                                    'label' => 'Pending',
                                    'description' => 'Not started yet',
                                ],
                                'in_progress' => [
                                    'label' => 'In Progress',
                                    'description' => 'Currently working',
                                ],
                                'completed' => [
                                    'label' => 'Completed',
                                    'description' => 'Task finished',
                                ],
                            ];
                        @endphp


                        @foreach ($statuses as $value => $status)

                            <label class="block cursor-pointer">

                                <input
                                    type="radio"
                                    name="status"
                                    value="{{ $value }}"
                                    class="peer sr-only"
                                    {{ old('status', $task->status) === $value ? 'checked' : '' }}
                                >

                                <div class="flex items-center gap-3 p-4 rounded-xl
                                            border-2 border-slate-200
                                            peer-checked:border-indigo-500
                                            peer-checked:bg-indigo-50
                                            transition">

                                    <div>
                                        <p class="font-semibold text-slate-800">
                                            {{ $status['label'] }}
                                        </p>

                                        <p class="text-xs text-slate-500">
                                            {{ $status['description'] }}
                                        </p>
                                    </div>

                                </div>

                            </label>

                        @endforeach

                    </div>

                </div>


                {{-- Due Date --}}
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm">

                    <div class="px-6 py-5 border-b border-slate-100">

                        <h2 class="text-lg font-bold text-slate-900">
                            Due Date
                        </h2>

                    </div>

                    <div class="p-6">

                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            Deadline
                        </label>

                        <input
                            type="date"
                            name="due_date"
                            value="{{ old('due_date', $task->due_date?->format('Y-m-d')) }}"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200
                                   focus:border-indigo-500
                                   focus:ring-2 focus:ring-indigo-100
                                   outline-none transition"
                        >

                    </div>

                </div>


                {{-- Actions --}}
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5">

                    <button
                        type="submit"
                        class="w-full inline-flex items-center justify-center gap-2
                               px-5 py-3 rounded-xl bg-indigo-600 text-white
                               font-semibold hover:bg-indigo-700
                               transition shadow-lg shadow-indigo-200"
                    >

                        <svg class="w-5 h-5"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M5 13l4 4L19 7"/>

                        </svg>

                        Update Task

                    </button>


                    <a
                        href="{{ route('admin.tasks.index') }}"
                        class="mt-3 w-full inline-flex items-center justify-center
                               px-5 py-3 rounded-xl border border-slate-200
                               text-slate-700 font-semibold
                               hover:bg-slate-50 transition"
                    >
                        Cancel
                    </a>

                </div>

            </div>

        </div>

    </form>

</div>

@endsection