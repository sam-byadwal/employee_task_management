@extends('layouts.admin')

@section('title', 'Add Comment')

@section('page-heading', 'Add Comment')

@section('content')

<div class="mx-auto max-w-4xl space-y-6">

    {{-- Header --}}
    <div>
        <div class="flex items-center gap-2 text-sm text-slate-500">
            <a href="{{ route('admin.dashboard') }}"
               class="hover:text-indigo-600">
                Dashboard
            </a>

            <span>/</span>

            <a href="{{ route('admin.comments.index') }}"
               class="hover:text-indigo-600">
                Comments
            </a>

            <span>/</span>

            <span class="text-slate-700">
                Add
            </span>
        </div>

        <h1 class="mt-2 text-2xl font-bold text-slate-900">
            Add Comment
        </h1>

        <p class="mt-1 text-sm text-slate-500">
            Add an update or discussion to a task.
        </p>
    </div>


    {{-- Errors --}}
    @if($errors->any())

        <div class="rounded-xl border border-red-200 bg-red-50 p-4">

            <ul class="space-y-1 text-sm text-red-600">

                @foreach($errors->all() as $error)

                    <li>
                        • {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- Form --}}
    <form
        action="{{ route('admin.comments.store') }}"
        method="POST"
        class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8"
    >

        @csrf


        {{-- Task --}}
        <div>

            <label class="mb-2 block text-sm font-semibold text-slate-700">
                Select Task
            </label>

            <select
                name="task_id"
                required
                class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-100"
            >

                <option value="">
                    Select a task
                </option>

                @foreach($tasks as $task)

                    <option
                        value="{{ $task->id }}"
                        @selected(old('task_id') == $task->id)
                    >
                        {{ $task->title }}
                        @if($task->employee)
                            — {{ $task->employee->name }}
                        @endif
                    </option>

                @endforeach

            </select>

        </div>


        {{-- Comment --}}
        <div class="mt-6">

            <label class="mb-2 block text-sm font-semibold text-slate-700">
                Comment
            </label>

            <textarea
                name="comment"
                rows="7"
                required
                maxlength="5000"
                placeholder="Write your comment..."
                class="w-full resize-none rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm leading-6 outline-none focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-100"
            >{{ old('comment') }}</textarea>

            <p class="mt-2 text-xs text-slate-400">
                Maximum 5000 characters.
            </p>

        </div>


        {{-- Buttons --}}
        <div class="mt-8 flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">

            <a
                href="{{ route('admin.comments.index') }}"
                class="rounded-xl border border-slate-200 px-6 py-3 text-center text-sm font-semibold text-slate-600 hover:bg-slate-50"
            >
                Cancel
            </a>

            <button
                type="submit"
                class="rounded-xl bg-indigo-600 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-indigo-500/20 hover:bg-indigo-700"
            >
                Add Comment
            </button>

        </div>

    </form>

</div>

@endsection