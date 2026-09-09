@extends('layouts.admin')

@section('title', 'Comments')

@section('page-heading', 'Comments')

@section('content')

<div class="space-y-6">

    {{-- Header --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>
            <div class="flex items-center gap-2 text-sm text-slate-500">
                <a href="{{ route('admin.dashboard') }}"
                   class="hover:text-indigo-600">
                    Dashboard
                </a>

                <span>/</span>

                <span class="text-slate-700">
                    Comments
                </span>
            </div>

            <h1 class="mt-2 text-2xl font-bold text-slate-900">
                Comments
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                Manage discussions and updates related to tasks.
            </p>
        </div>

        <a
            href="{{ route('admin.comments.create') }}"
            class="inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-indigo-500/20 transition hover:bg-indigo-700"
        >
            <span class="text-lg">+</span>
            Add Comment
        </a>

    </div>


    {{-- Stats --}}
    <div class="grid gap-4 sm:grid-cols-3">

        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-sm font-medium text-slate-500">
                Total Comments
            </p>

            <p class="mt-2 text-3xl font-bold text-slate-900">
                {{ $comments->count() }}
            </p>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-sm font-medium text-slate-500">
                Tasks Discussed
            </p>

            <p class="mt-2 text-3xl font-bold text-indigo-600">
                {{ $comments->pluck('task_id')->unique()->count() }}
            </p>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-sm font-medium text-slate-500">
                Contributors
            </p>

            <p class="mt-2 text-3xl font-bold text-purple-600">
                {{ $comments->pluck('user_id')->unique()->count() }}
            </p>
        </div>

    </div>


    {{-- Search --}}
    <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">

        <form
            action="{{ route('admin.comments.index') }}"
            method="GET"
            class="flex flex-col gap-3 sm:flex-row"
        >

            <div class="relative flex-1">

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search comments, tasks or users..."
                    class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none transition focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-100"
                >

            </div>

            <button
                type="submit"
                class="rounded-xl bg-slate-900 px-6 py-3 text-sm font-semibold text-white transition hover:bg-slate-800"
            >
                Search
            </button>

            @if(request('search'))
                <a
                    href="{{ route('admin.comments.index') }}"
                    class="rounded-xl border border-slate-200 px-6 py-3 text-center text-sm font-semibold text-slate-600 transition hover:bg-slate-50"
                >
                    Clear
                </a>
            @endif

        </form>

    </div>


    {{-- Comments --}}
    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

        @forelse($comments as $comment)

            <div class="border-b border-slate-100 p-6 last:border-b-0">

                <div class="flex gap-4">

                    {{-- Avatar --}}
                    <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-indigo-100 font-bold text-indigo-700">
                        {{ strtoupper(substr($comment->user->name ?? 'U', 0, 1)) }}
                    </div>


                    <div class="min-w-0 flex-1">

                        {{-- Top --}}
                        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">

                            <div>

                                <h3 class="font-semibold text-slate-900">
                                    {{ $comment->user->name ?? 'Unknown User' }}
                                </h3>

                                <p class="text-xs text-slate-500">
                                    {{ $comment->created_at->format('d M Y, h:i A') }}
                                </p>

                            </div>


                            <div class="flex items-center gap-2">

                                <a
                                    href="{{ route('admin.comments.edit', $comment) }}"
                                    class="rounded-lg px-3 py-2 text-xs font-semibold text-indigo-600 transition hover:bg-indigo-50"
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
                                        class="rounded-lg px-3 py-2 text-xs font-semibold text-red-600 transition hover:bg-red-50"
                                    >
                                        Delete
                                    </button>

                                </form>

                            </div>

                        </div>


                        {{-- Task --}}
                        <div class="mt-4 inline-flex items-center gap-2 rounded-lg bg-slate-100 px-3 py-2 text-xs font-semibold text-slate-600">

                            <span class="text-indigo-600">
                                Task:
                            </span>

                            {{ $comment->task->title ?? 'Deleted Task' }}

                        </div>


                        {{-- Comment --}}
                        <p class="mt-4 whitespace-pre-line text-sm leading-6 text-slate-600">
                            {{ $comment->comment }}
                        </p>

                    </div>

                </div>

            </div>

        @empty

            <div class="px-6 py-16 text-center">

                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-indigo-50 text-3xl">
                    💬
                </div>

                <h3 class="mt-5 text-lg font-bold text-slate-900">
                    No comments yet
                </h3>

                <p class="mt-2 text-sm text-slate-500">
                    Start a discussion by adding your first comment.
                </p>

                <a
                    href="{{ route('admin.comments.create') }}"
                    class="mt-6 inline-flex rounded-xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white hover:bg-indigo-700"
                >
                    Add First Comment
                </a>

            </div>

        @endforelse

    </div>

</div>

@endsection