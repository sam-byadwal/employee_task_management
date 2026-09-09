@extends('layouts.employee')

@section('title', 'Task Details')

@section('content')

<div class="space-y-6">

    {{-- Header --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>

            <a
                href="{{ route('employee.tasks.index') }}"
                class="inline-flex items-center gap-2 text-sm font-semibold text-slate-500 transition hover:text-indigo-600"
            >
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
                        d="M15 19l-7-7 7-7"
                    />
                </svg>

                Back to My Tasks
            </a>

            <h1 class="mt-3 text-3xl font-bold tracking-tight text-slate-900">
                {{ $task->title }}
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                Task #{{ $task->id }}
            </p>

        </div>

    </div>


    {{-- Success Message --}}
    @if(session('success'))

        <div class="flex items-center gap-3 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700">

            <svg
                class="h-5 w-5 shrink-0"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M5 13l4 4L19 7"
                />
            </svg>

            {{ session('success') }}

        </div>

    @endif


    {{-- Validation Errors --}}
    @if($errors->any())

        <div class="rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">

            <ul class="list-disc space-y-1 pl-5">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    <div class="grid grid-cols-1 gap-6 xl:grid-cols-3">

        {{-- Main Task --}}
        <div class="space-y-6 xl:col-span-2">

            {{-- Description --}}
            <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200">

                <div class="flex items-center gap-3">

                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-50">

                        <svg
                            class="h-5 w-5 text-indigo-600"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M9 12h6m-6 4h4m-7 5h10a2 2 0 002-2V7.5L13.5 3H6a2 2 0 00-2 2v14a2 2 0 002 2zm7-18v4h4"
                            />
                        </svg>

                    </div>

                    <div>

                        <h2 class="font-bold text-slate-900">
                            Task Description
                        </h2>

                        <p class="text-xs text-slate-500">
                            Details provided by the administrator
                        </p>

                    </div>

                </div>


                <div class="mt-6 rounded-xl bg-slate-50 p-5">

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


            {{-- Comments --}}
            <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200">

                <div class="flex items-center justify-between">

                    <div class="flex items-center gap-3">

                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-violet-50">

                            <svg
                                class="h-5 w-5 text-violet-600"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M8 10h8M8 14h5m-8 7l-3 1 1-4a8 8 0 1115-4 8 8 0 01-15 4z"
                                />
                            </svg>

                        </div>

                        <div>

                            <h2 class="font-bold text-slate-900">
                                Comments
                            </h2>

                            <p class="text-xs text-slate-500">
                                {{ $task->comments->count() }} comments
                            </p>

                        </div>

                    </div>

                </div>


                {{-- Add Comment --}}
                <form
                    method="POST"
                    action="{{ route('employee.tasks.comments.store', $task) }}"
                    class="mt-6"
                >

                    @csrf

                    <label class="mb-2 block text-sm font-semibold text-slate-700">
                        Add a comment
                    </label>

                    <textarea
                        name="comment"
                        rows="4"
                        placeholder="Write your comment here..."
                        class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-100"
                    >{{ old('comment') }}</textarea>

                    <div class="mt-3 flex justify-end">

                        <button
                            type="submit"
                            class="rounded-xl bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-indigo-700"
                        >
                            Add Comment
                        </button>

                    </div>

                </form>


                {{-- Comment List --}}
                <div class="mt-6 space-y-4">

                    @forelse($task->comments->sortByDesc('created_at') as $comment)

                        <div class="rounded-xl border border-slate-100 bg-slate-50 p-4">

                            <div class="flex items-start gap-3">

                                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-indigo-600 text-sm font-bold text-white">

                                    {{ strtoupper(substr($comment->user->name, 0, 1)) }}

                                </div>


                                <div class="min-w-0 flex-1">

                                    <div class="flex flex-wrap items-center gap-2">

                                        <p class="text-sm font-bold text-slate-900">
                                            {{ $comment->user->name }}
                                        </p>

                                        <span class="text-xs text-slate-400">
                                            {{ $comment->created_at->diffForHumans() }}
                                        </span>

                                    </div>

                                    <p class="mt-2 whitespace-pre-line text-sm leading-6 text-slate-600">
                                        {{ $comment->comment }}
                                    </p>

                                </div>

                            </div>

                        </div>

                    @empty

                        <div class="rounded-xl border border-dashed border-slate-200 py-10 text-center">

                            <p class="text-sm text-slate-400">
                                No comments yet.
                            </p>

                            <p class="mt-1 text-xs text-slate-400">
                                Be the first to leave a comment.
                            </p>

                        </div>

                    @endforelse

                </div>

            </div>

        </div>


        {{-- Sidebar --}}
        <div class="space-y-6">

            {{-- Status --}}
            <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200">

                <h2 class="font-bold text-slate-900">
                    Task Status
                </h2>

                <form
                    method="POST"
                    action="{{ route('employee.tasks.update-status', $task) }}"
                    class="mt-5"
                >

                    @csrf
                    @method('PATCH')

                    <select
                        name="status"
                        class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-medium text-slate-700 outline-none focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-100"
                    >

                        <option
                            value="pending"
                            {{ $task->status === 'pending' ? 'selected' : '' }}
                        >
                            Pending
                        </option>

                        <option
                            value="in_progress"
                            {{ $task->status === 'in_progress' ? 'selected' : '' }}
                        >
                            In Progress
                        </option>

                        <option
                            value="completed"
                            {{ $task->status === 'completed' ? 'selected' : '' }}
                        >
                            Completed
                        </option>

                    </select>

                    <button
                        type="submit"
                        class="mt-3 w-full rounded-xl bg-slate-900 px-4 py-3 text-sm font-semibold text-white transition hover:bg-indigo-600"
                    >
                        Update Status
                    </button>

                </form>

            </div>


            {{-- Task Information --}}
            <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200">

                <h2 class="font-bold text-slate-900">
                    Task Information
                </h2>

                <div class="mt-5 divide-y divide-slate-100">

                    {{-- Priority --}}
                    <div class="flex items-center justify-between py-4">

                        <span class="text-sm text-slate-500">
                            Priority
                        </span>

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


                    {{-- Due Date --}}
                    <div class="flex items-center justify-between py-4">

                        <span class="text-sm text-slate-500">
                            Due Date
                        </span>

                        <span class="text-sm font-semibold text-slate-800">

                            @if($task->due_date)

                                {{ $task->due_date->format('d M Y') }}

                            @else

                                No deadline

                            @endif

                        </span>

                    </div>


                    {{-- Created --}}
                    <div class="flex items-center justify-between py-4">

                        <span class="text-sm text-slate-500">
                            Created
                        </span>

                        <span class="text-sm font-semibold text-slate-800">
                            {{ $task->created_at->format('d M Y') }}
                        </span>

                    </div>


                    {{-- Comments --}}
                    <div class="flex items-center justify-between py-4">

                        <span class="text-sm text-slate-500">
                            Comments
                        </span>

                        <span class="text-sm font-semibold text-slate-800">
                            {{ $task->comments->count() }}
                        </span>

                    </div>

                </div>

            </div>


            {{-- Quick Action --}}
            @if($task->status !== 'completed')

                <div class="rounded-2xl bg-gradient-to-br from-indigo-600 to-violet-600 p-6 text-white shadow-lg">

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-white/15">

                        <svg
                            class="h-6 w-6"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M5 13l4 4L19 7"
                            />
                        </svg>

                    </div>

                    <h3 class="mt-4 text-lg font-bold">
                        Ready to finish?
                    </h3>

                    <p class="mt-1 text-sm leading-6 text-indigo-100">
                        Mark this task as completed when your work is finished.
                    </p>

                    <form
                        method="POST"
                        action="{{ route('employee.tasks.update-status', $task) }}"
                        class="mt-5"
                    >

                        @csrf
                        @method('PATCH')

                        <input
                            type="hidden"
                            name="status"
                            value="completed"
                        >

                        <button
                            type="submit"
                            class="w-full rounded-xl bg-white px-4 py-3 text-sm font-bold text-indigo-700 transition hover:bg-indigo-50"
                        >
                            Mark as Completed
                        </button>

                    </form>

                </div>

            @endif

        </div>

    </div>

</div>

@endsection