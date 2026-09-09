@extends('layouts.admin')

@section('title', 'Task Details')

@section('page-heading', 'Task Details')

@section('content')

<div class="space-y-6">

    {{-- Header --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>

            <div class="flex items-center gap-2 text-sm text-slate-500">

                <a
                    href="{{ route('admin.dashboard') }}"
                    class="hover:text-indigo-600"
                >
                    Dashboard
                </a>

                <span>/</span>

                <a
                    href="{{ route('admin.tasks.index') }}"
                    class="hover:text-indigo-600"
                >
                    Tasks
                </a>

                <span>/</span>

                <span class="text-slate-700">
                    Task Details
                </span>

            </div>

            <h1 class="mt-2 text-2xl font-bold text-slate-900">
                Task Details
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                View task information and discussion.
            </p>

        </div>


        <div class="flex gap-3">

            <a
                href="{{ route('admin.tasks.edit', $task) }}"
                class="rounded-xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-indigo-500/20 hover:bg-indigo-700"
            >
                Edit Task
            </a>

            <a
                href="{{ route('admin.tasks.index') }}"
                class="rounded-xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-600 hover:bg-slate-50"
            >
                Back
            </a>

        </div>

    </div>


    {{-- Main Grid --}}
    <div class="grid gap-6 lg:grid-cols-3">



        {{-- Task Information --}}
        <div class="lg:col-span-2">

            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

  {{-- created by --}}
     <div class="bg-white rounded-xl border border-gray-200 p-5 shadow-sm">
    <p class="text-xs font-medium uppercase tracking-wide text-gray-500 mb-2">
        Created By
    </p>

    <div class="flex items-center gap-3">
        <div class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold">
            {{ strtoupper(substr($task->creator?->name ?? 'N', 0, 1)) }}
        </div>

        <div>
            <p class="text-base font-semibold text-gray-900">
                {{ $task->creator?->name ?? 'N/A' }}
            </p>

            <p class="text-sm text-gray-500">
                Task Creator
            </p>
        </div>
    </div>
</div>

                {{-- Title --}}
                <div>

                    <div class="flex flex-wrap items-center gap-3">

                        <h2 class="text-2xl font-bold text-slate-900">
                            {{ $task->title }}
                        </h2>


                        {{-- Priority --}}
                        @php
                            $priorityClasses = [
                                'low' => 'bg-slate-100 text-slate-600',
                                'medium' => 'bg-blue-100 text-blue-700',
                                'high' => 'bg-orange-100 text-orange-700',
                                'urgent' => 'bg-red-100 text-red-700',
                            ];
                        @endphp

                        <span
                            class="rounded-full px-3 py-1 text-xs font-bold uppercase {{ $priorityClasses[$task->priority] ?? 'bg-slate-100 text-slate-600' }}"
                        >
                            {{ $task->priority }}
                        </span>

                    </div>


                    {{-- Status --}}
                    @php
                        $statusClasses = [
                            'pending' => 'bg-amber-100 text-amber-700',
                            'in_progress' => 'bg-blue-100 text-blue-700',
                            'completed' => 'bg-emerald-100 text-emerald-700',
                        ];
                    @endphp

                    <span
                        class="mt-3 inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $statusClasses[$task->status] ?? 'bg-slate-100 text-slate-600' }}"
                    >
                        {{ ucwords(str_replace('_', ' ', $task->status)) }}
                    </span>

                </div>


                {{-- Description --}}
                <div class="mt-8">

                    <h3 class="text-sm font-bold uppercase tracking-wide text-slate-500">
                        Description
                    </h3>

                    <div class="mt-3 rounded-xl bg-slate-50 p-5">

                        @if($task->description)

                            <p class="whitespace-pre-line text-sm leading-7 text-slate-600">
                                {{ $task->description }}
                            </p>

                        @else

                            <p class="text-sm italic text-slate-400">
                                No description provided.
                            </p>

                        @endif

                    </div>

                </div>


                {{-- Task Metadata --}}
                <div class="mt-8 grid gap-4 sm:grid-cols-3">

                    {{-- Assigned --}}
                    <div class="rounded-xl border border-slate-100 bg-slate-50 p-4">

                        <p class="text-xs font-semibold uppercase text-slate-400">
                            Assigned To
                        </p>

                        <div class="mt-3 flex items-center gap-3">

                            <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-indigo-100 text-sm font-bold text-indigo-700">
                                {{ strtoupper(substr($task->employee->name ?? 'U', 0, 1)) }}
                            </div>

                            <div>

                                <p class="text-sm font-semibold text-slate-800">
                                    {{ $task->employee->name ?? 'Unassigned' }}
                                </p>

                            </div>

                        </div>

                    </div>


                    {{-- Due Date --}}
                    <div class="rounded-xl border border-slate-100 bg-slate-50 p-4">

                        <p class="text-xs font-semibold uppercase text-slate-400">
                            Due Date
                        </p>

                        <p class="mt-3 text-sm font-semibold text-slate-800">

                            @if($task->due_date)
                                {{ $task->due_date->format('d M Y') }}
                            @else
                                No due date
                            @endif

                        </p>

                    </div>


                    {{-- Task ID --}}
                    <div class="rounded-xl border border-slate-100 bg-slate-50 p-4">

                        <p class="text-xs font-semibold uppercase text-slate-400">
                            Task ID
                        </p>

                        <p class="mt-3 text-sm font-semibold text-slate-800">
                            #{{ $task->id }}
                        </p>

                    </div>

                </div>

            </div>

        </div>


        {{-- Right Side --}}
        <div>

            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

                <h3 class="font-bold text-slate-900">
                    Task Timeline
                </h3>

                <div class="mt-5 space-y-5">

                    <div class="flex gap-3">

                        <div class="mt-1 h-3 w-3 rounded-full bg-indigo-500"></div>

                        <div>

                            <p class="text-sm font-semibold text-slate-800">
                                Task Created
                            </p>

                            <p class="text-xs text-slate-500">
                                {{ $task->created_at->format('d M Y, h:i A') }}
                            </p>

                        </div>

                    </div>


                    <div class="flex gap-3">

                        <div class="mt-1 h-3 w-3 rounded-full bg-blue-500"></div>

                        <div>

                            <p class="text-sm font-semibold text-slate-800">
                                Last Updated
                            </p>

                            <p class="text-xs text-slate-500">
                                {{ $task->updated_at->format('d M Y, h:i A') }}
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- Comments --}}
    <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

        <div class="border-b border-slate-100 p-6">

            <div class="flex items-center justify-between">

                <div>

                    <h2 class="text-lg font-bold text-slate-900">
                        Comments
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        {{ $task->comments->count() }}
                        {{ Str::plural('comment', $task->comments->count()) }}
                    </p>

                </div>

                <span class="rounded-xl bg-indigo-50 px-3 py-2 text-sm font-bold text-indigo-600">
                    💬
                </span>

            </div>

        </div>


        {{-- Comment List --}}
        <div class="divide-y divide-slate-100">

            @forelse($task->comments as $comment)

                <div class="p-6">

                    <div class="flex gap-4">

                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-indigo-100 font-bold text-indigo-700">
                            {{ strtoupper(substr($comment->user->name ?? 'U', 0, 1)) }}
                        </div>


                        <div class="min-w-0 flex-1">

                            <div class="flex flex-col gap-1 sm:flex-row sm:items-center sm:justify-between">

                                <div>

                                    <p class="text-sm font-bold text-slate-900">
                                        {{ $comment->user->name ?? 'Unknown User' }}
                                    </p>

                                    <p class="text-xs text-slate-400">
                                        {{ $comment->created_at->format('d M Y, h:i A') }}
                                    </p>

                                </div>


                                <div class="flex gap-2">

                                    <a
                                        href="{{ route('admin.comments.edit', $comment) }}"
                                        class="text-xs font-semibold text-indigo-600 hover:text-indigo-800"
                                    >
                                        Edit
                                    </a>

                                    <form
                                        action="{{ route('admin.comments.destroy', $comment) }}"
                                        method="POST"
                                        onsubmit="return confirm('Delete this comment?')"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="text-xs font-semibold text-red-600 hover:text-red-800"
                                        >
                                            Delete
                                        </button>

                                    </form>

                                </div>

                            </div>


                            <p class="mt-3 whitespace-pre-line text-sm leading-6 text-slate-600">
                                {{ $comment->comment }}
                            </p>

                        </div>

                    </div>

                </div>

            @empty

                <div class="px-6 py-12 text-center">

                    <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-100 text-2xl">
                        💬
                    </div>

                    <h3 class="mt-4 font-bold text-slate-900">
                        No comments yet
                    </h3>

                    <p class="mt-1 text-sm text-slate-500">
                        Start the discussion for this task.
                    </p>

                </div>

            @endforelse

        </div>


        {{-- Add Comment --}}
        <div class="border-t border-slate-100 bg-slate-50 p-6">

            <h3 class="font-bold text-slate-900">
                Add a comment
            </h3>

            <form
                action="{{ route('admin.comments.store') }}"
                method="POST"
                class="mt-4"
            >

                @csrf

                <input
                    type="hidden"
                    name="task_id"
                    value="{{ $task->id }}"
                >


                <textarea
                    name="comment"
                    rows="4"
                    required
                    maxlength="5000"
                    placeholder="Write an update, question or note..."
                    class="w-full resize-none rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm leading-6 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100"
                ></textarea>


                @error('comment')

                    <p class="mt-2 text-sm text-red-600">
                        {{ $message }}
                    </p>

                @enderror


                <div class="mt-3 flex justify-end">

                    <button
                        type="submit"
                        class="rounded-xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-indigo-500/20 transition hover:bg-indigo-700"
                    >
                        Post Comment
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection