@extends('layouts.admin')

@section('title', 'Employee Tasks')

@section('page-heading', 'Employee Tasks')

@section('content')

<div class="space-y-6">

    {{-- Header --}}
    <div>

        <a
            href="{{ route('admin.employees.index') }}"
            class="text-sm text-slate-500 hover:text-slate-900"
        >
            ← Back to Employees
        </a>

        <h1 class="mt-3 text-2xl font-bold text-slate-900">
            {{ $employee->name }}'s Tasks
        </h1>

        <p class="text-sm text-slate-500">
            {{ $employee->email }}
        </p>

    </div>


    {{-- Main Card --}}
    <div class="overflow-hidden rounded-xl border border-slate-200 bg-white">


        {{-- Bulk Reassign Section --}}
        <form
            action="{{ route('admin.employees.tasks.bulk-reassign', $employee) }}"
            method="POST"
            id="bulkReassignForm"
            class="border-b border-slate-200 bg-slate-50 px-6 py-4"
        >

            @csrf
            @method('PATCH')

            <div class="flex flex-wrap items-center gap-3">

                {{-- Employee Dropdown --}}
                <select
                    name="assigned_to"
                    required
                    class="rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500"
                >

                    <option value="">
                        Reassign selected tasks to...
                    </option>

                    @foreach($availableEmployees as $otherEmployee)

                        <option value="{{ $otherEmployee->id }}">
                            {{ $otherEmployee->name }}
                        </option>

                    @endforeach

                </select>


                {{-- Bulk Reassign Button --}}
                <button
                    type="submit"
                    class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-blue-700"
                >
                    Reassign Selected
                </button>


                {{-- Select All Button --}}
                <button
                    type="button"
                    id="selectAllTasks"
                    class="rounded-lg border border-slate-300 bg-white px-4 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-100"
                >
                    Select All
                </button>


                {{-- Clear Selection --}}
                <button
                    type="button"
                    id="clearAllTasks"
                    class="rounded-lg border border-slate-300 bg-white px-4 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-100"
                >
                    Clear
                </button>

            </div>


            {{-- JavaScript will add task_ids[] here --}}
            <div id="selectedTaskInputs"></div>

        </form>


        {{-- Table Heading --}}
        <div class="border-b border-slate-200 px-6 py-4">

            <div class="flex items-center justify-between">

                <div>

                    <h2 class="font-semibold text-slate-900">
                        Assigned Tasks
                    </h2>

                    <p class="mt-1 text-xs text-slate-500">
                        Select one or multiple tasks to reassign them.
                    </p>

                </div>

            </div>

        </div>


        {{-- Table --}}
        <div class="overflow-x-auto">

            <table class="w-full text-left text-sm">

                <thead class="bg-slate-50">

                    <tr>

                        {{-- Select checkbox --}}
                        <th class="w-12 px-6 py-4">

                            <input
                                type="checkbox"
                                id="selectAllCheckbox"
                                class="h-4 w-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500"
                            >

                        </th>


                        {{-- Task --}}
                        <th class="px-6 py-4 font-semibold text-slate-700">
                            Task
                        </th>


                        {{-- Priority --}}
                        <th class="px-6 py-4 font-semibold text-slate-700">
                            Priority
                        </th>


                        {{-- Status --}}
                        <th class="px-6 py-4 font-semibold text-slate-700">
                            Status
                        </th>


                        {{-- Due Date --}}
                        <th class="px-6 py-4 font-semibold text-slate-700">
                            Due Date
                        </th>


                        {{-- Individual Reassign --}}
                        <th class="px-6 py-4 font-semibold text-slate-700">
                            Action
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-slate-100">

                    @forelse($tasks as $task)

                        <tr class="transition hover:bg-slate-50">


                            {{-- Task Checkbox --}}
                            <td class="px-6 py-4">

                                <input
                                    type="checkbox"
                                    class="task-checkbox h-4 w-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500"
                                    value="{{ $task->id }}"
                                >

                            </td>


                            {{-- Task --}}
                            <td class="px-6 py-4">

                                <div class="font-semibold text-slate-900">
                                    {{ $task->title }}
                                </div>

                                <div class="mt-1 text-xs text-slate-500">
                                    {{ Str::limit($task->description, 80) }}
                                </div>

                            </td>


                            {{-- Priority --}}
                            <td class="px-6 py-4">

                                @if($task->priority === 'high')

                                    <span class="rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">
                                        High
                                    </span>

                                @elseif($task->priority === 'medium')

                                    <span class="rounded-full bg-yellow-100 px-3 py-1 text-xs font-semibold text-yellow-700">
                                        Medium
                                    </span>

                                @else

                                    <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                        Low
                                    </span>

                                @endif

                            </td>


                            {{-- Status --}}
                            <td class="px-6 py-4">

                                {{ ucfirst(str_replace('_', ' ', $task->status)) }}

                            </td>


                            {{-- Due Date --}}
                            <td class="px-6 py-4">

                                {{ $task->due_date?->format('d M Y') ?? 'N/A' }}

                            </td>


                            {{-- Individual Reassign --}}
                            <td class="px-6 py-4">

                                <form
                                    action="{{ route('admin.employees.tasks.reassign', [$employee, $task]) }}"
                                    method="POST"
                                    class="flex items-center gap-2"
                                >

                                    @csrf
                                    @method('PATCH')


                                    <select
                                        name="assigned_to"
                                        required
                                        class="rounded-lg border border-slate-300 bg-white px-2 py-2 text-xs focus:border-blue-500 focus:outline-none"
                                    >

                                        <option value="">
                                            Employee
                                        </option>

                                        @foreach($availableEmployees as $otherEmployee)

                                            <option value="{{ $otherEmployee->id }}">
                                                {{ $otherEmployee->name }}
                                            </option>

                                        @endforeach

                                    </select>


                                    <button
                                        type="submit"
                                        class="rounded-lg bg-blue-600 px-3 py-2 text-xs font-semibold text-white transition hover:bg-blue-700"
                                    >
                                        Reassign
                                    </button>

                                </form>

                            </td>

                        </tr>


                    @empty

                        <tr>

                            <td
                                colspan="6"
                                class="px-6 py-10 text-center"
                            >

                                <div class="text-sm font-medium text-slate-700">
                                    No tasks assigned to this employee.
                                </div>

                                <div class="mt-1 text-xs text-slate-500">
                                    All tasks have been reassigned or no tasks exist.
                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- Pagination --}}
        @if($tasks->hasPages())

            <div class="border-t border-slate-200 px-6 py-4">

                {{ $tasks->links() }}

            </div>

        @endif

    </div>

</div>


{{-- Bulk Reassign JavaScript --}}
<script>

    const selectAllCheckbox =
        document.getElementById('selectAllCheckbox');

    const selectAllButton =
        document.getElementById('selectAllTasks');

    const clearAllButton =
        document.getElementById('clearAllTasks');

    const bulkForm =
        document.getElementById('bulkReassignForm');

    const selectedTaskInputs =
        document.getElementById('selectedTaskInputs');


    function getTaskCheckboxes() {

        return document.querySelectorAll(
            '.task-checkbox'
        );

    }


    function updateSelectAllCheckbox() {

        const checkboxes = getTaskCheckboxes();

        const selected = document.querySelectorAll(
            '.task-checkbox:checked'
        );

        if (checkboxes.length === 0) {

            selectAllCheckbox.checked = false;

            return;
        }

        selectAllCheckbox.checked =
            checkboxes.length === selected.length;

    }


    // Select All checkbox
    selectAllCheckbox.addEventListener(
        'change',
        function () {

            getTaskCheckboxes().forEach(
                checkbox => {

                    checkbox.checked =
                        this.checked;

                }
            );

        }
    );


    // Select All button
    selectAllButton.addEventListener(
        'click',
        function () {

            getTaskCheckboxes().forEach(
                checkbox => {

                    checkbox.checked = true;

                }
            );

            selectAllCheckbox.checked = true;

        }
    );


    // Clear button
    clearAllButton.addEventListener(
        'click',
        function () {

            getTaskCheckboxes().forEach(
                checkbox => {

                    checkbox.checked = false;

                }
            );

            selectAllCheckbox.checked = false;

        }
    );


    // Update header checkbox when individual checkbox changes
    getTaskCheckboxes().forEach(
        checkbox => {

            checkbox.addEventListener(
                'change',
                updateSelectAllCheckbox
            );

        }
    );


    // Bulk form submit
    bulkForm.addEventListener(
        'submit',
        function (event) {

            selectedTaskInputs.innerHTML = '';


            const selectedTasks =
                document.querySelectorAll(
                    '.task-checkbox:checked'
                );


            // No task selected
            if (selectedTasks.length === 0) {

                event.preventDefault();

                alert(
                    'Please select at least one task.'
                );

                return;

            }


            // Create hidden task_ids[] inputs
            selectedTasks.forEach(
                checkbox => {

                    const input =
                        document.createElement('input');

                    input.type = 'hidden';

                    input.name = 'task_ids[]';

                    input.value = checkbox.value;

                    selectedTaskInputs.appendChild(
                        input
                    );

                }
            );

        }
    );

</script>

@endsection