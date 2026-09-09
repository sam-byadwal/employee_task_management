@extends('layouts.admin')

@section('title', 'Employees')

@section('page-heading', 'Employees')

@section('content')

<div class="space-y-6">

    {{-- ========================================================= --}}
    {{-- Header --}}
    {{-- ========================================================= --}}

    <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">

        <div>

            <div class="flex items-center gap-2">

                <span class="text-sm font-medium text-indigo-600">
                    Team Management
                </span>

                <span class="text-slate-300">
                    /
                </span>

                <span class="text-sm text-slate-500">
                    Employees
                </span>

            </div>

            <h1 class="mt-2 text-3xl font-extrabold tracking-tight text-slate-900">
                Your Team
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                Manage employees, account status and team members.
            </p>

        </div>


        {{-- Add Employee Button --}}

        <a
            href="{{ route('admin.employees.create') }}"
            class="inline-flex items-center justify-center gap-2 rounded-xl
                   bg-indigo-600 px-5 py-3 text-sm font-bold text-white
                   shadow-lg shadow-indigo-600/20 transition
                   hover:-translate-y-0.5 hover:bg-indigo-700 hover:shadow-xl"
        >

            <span class="text-lg">
                +
            </span>

            Add Employee

        </a>

    </div>



    {{-- ========================================================= --}}
    {{-- Stats --}}
    {{-- ========================================================= --}}

    <div class="grid gap-4 sm:grid-cols-3">


        {{-- Total Employees --}}

        <div
            class="rounded-2xl border border-slate-200 bg-white
                   p-5 shadow-sm"
        >

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm text-slate-500">
                        Total Employees
                    </p>

                    <p class="mt-1 text-2xl font-extrabold text-slate-900">
                        {{ $totalEmployees }}
                    </p>

                </div>

                <div
                    class="flex h-11 w-11 items-center justify-center
                           rounded-xl bg-indigo-50 text-xl"
                >
                    👥
                </div>

            </div>

        </div>



        {{-- Active Employees --}}

        <div
            class="rounded-2xl border border-slate-200 bg-white
                   p-5 shadow-sm"
        >

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm text-slate-500">
                        Active
                    </p>

                    <p class="mt-1 text-2xl font-extrabold text-emerald-600">
                        {{ $activeEmployees }}
                    </p>

                </div>

                <div
                    class="flex h-11 w-11 items-center justify-center
                           rounded-xl bg-emerald-50 text-xl"
                >
                    ✓
                </div>

            </div>

        </div>



        {{-- Inactive Employees --}}

        <div
            class="rounded-2xl border border-slate-200 bg-white
                   p-5 shadow-sm"
        >

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm text-slate-500">
                        Inactive
                    </p>

                    <p class="mt-1 text-2xl font-extrabold text-red-500">
                        {{ $inactiveEmployees }}
                    </p>

                </div>

                <div
                    class="flex h-11 w-11 items-center justify-center
                           rounded-xl bg-red-50 text-xl"
                >
                    ⏸
                </div>

            </div>

        </div>

    </div>



    {{-- ========================================================= --}}
    {{-- Search --}}
    {{-- ========================================================= --}}

    <div
        class="rounded-2xl border border-slate-200
               bg-white p-5 shadow-sm"
    >

        <form
            method="GET"
            action="{{ route('admin.employees.index') }}"
        >

            <div class="flex flex-col gap-3 sm:flex-row">


                {{-- Search Input --}}

                <div class="relative flex-1">

                    <svg
                        class="absolute left-4 top-1/2 h-5 w-5
                               -translate-y-1/2 text-slate-400"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        viewBox="0 0 24 24"
                    >

                        <circle
                            cx="11"
                            cy="11"
                            r="7"
                        ></circle>

                        <path
                            d="m20 20-3.5-3.5"
                        ></path>

                    </svg>


                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search employee by name or email..."
                        class="w-full rounded-xl border border-slate-300
                               bg-white py-3 pl-12 pr-4 text-sm
                               text-slate-700 outline-none
                               transition
                               focus:border-indigo-500
                               focus:ring-4
                               focus:ring-indigo-500/10"
                    >

                </div>



                {{-- Search Button --}}

                <button
                    type="submit"
                    class="rounded-xl bg-indigo-600 px-6 py-3
                           text-sm font-semibold text-white
                           transition hover:bg-indigo-700"
                >

                    Search

                </button>



                {{-- Reset Button --}}

                @if(request('search'))

                    <a
                        href="{{ route('admin.employees.index') }}"
                        class="rounded-xl border border-slate-300
                               bg-white px-6 py-3 text-center
                               text-sm font-semibold text-slate-700
                               transition hover:bg-slate-50"
                    >

                        Reset

                    </a>

                @endif

            </div>

        </form>

    </div>



    {{-- ========================================================= --}}
    {{-- Employee Table --}}
    {{-- ========================================================= --}}

    <div
        class="overflow-hidden rounded-2xl
               border border-slate-200 bg-white shadow-sm"
    >


        {{-- Table Header --}}

        <div class="border-b border-slate-200 p-5">

            <div>

                <h2 class="font-bold text-slate-900">
                    All Employees
                </h2>

                <p class="mt-1 text-xs text-slate-500">
                    Manage your registered team members.
                </p>

            </div>

        </div>



        {{-- ===================================================== --}}
        {{-- Employees Found --}}
        {{-- ===================================================== --}}

        @if($employees->count())


            <div class="overflow-x-auto">

                <table class="w-full text-left">


                    {{-- Table Head --}}

                    <thead class="bg-slate-50">

                        <tr>

                            <th
                                class="px-6 py-4 text-xs font-bold
                                       uppercase tracking-wider text-slate-500"
                            >
                                Employee
                            </th>


                            <th
                                class="px-6 py-4 text-xs font-bold
                                       uppercase tracking-wider text-slate-500"
                            >
                                Status
                            </th>


                            <th
                                class="px-6 py-4 text-xs font-bold
                                       uppercase tracking-wider text-slate-500"
                            >
                                Joined
                            </th>


                            <th
                                class="px-6 py-4 text-right text-xs font-bold
                                       uppercase tracking-wider text-slate-500"
                            >
                                Actions
                            </th>

                        </tr>

                    </thead>



                    {{-- Table Body --}}

                    <tbody class="divide-y divide-slate-100">


                        @foreach($employees as $employee)


                            <tr
                                class="group transition hover:bg-slate-50"
                            >


                                {{-- Employee --}}

                                <td class="px-6 py-5">

                                    <div class="flex items-center gap-4">


                                        {{-- Avatar --}}

                                        <div
                                            class="flex h-11 w-11 shrink-0
                                                   items-center justify-center
                                                   rounded-xl
                                                   bg-gradient-to-br
                                                   from-indigo-500
                                                   to-purple-600
                                                   font-bold text-white
                                                   shadow-md"
                                        >

                                            {{ strtoupper(substr($employee->name, 0, 1)) }}

                                        </div>



                                        {{-- Name + Email --}}

                                        <div class="min-w-0">

                                            <p
                                                class="truncate font-bold
                                                       text-slate-800"
                                            >
                                                {{ $employee->name }}
                                            </p>

                                            <p
                                                class="truncate text-sm
                                                       text-slate-500"
                                            >
                                                {{ $employee->email }}
                                            </p>

                                        </div>

                                    </div>

                                </td>



                                {{-- Status --}}

                                <td class="px-6 py-5">

                                    @if($employee->status)

                                        <span
                                            class="inline-flex items-center gap-2
                                                   rounded-full bg-emerald-50
                                                   px-3 py-1.5 text-xs
                                                   font-bold text-emerald-700"
                                        >

                                            <span
                                                class="h-2 w-2 rounded-full
                                                       bg-emerald-500"
                                            ></span>

                                            Active

                                        </span>

                                    @else

                                        <span
                                            class="inline-flex items-center gap-2
                                                   rounded-full bg-red-50
                                                   px-3 py-1.5 text-xs
                                                   font-bold text-red-600"
                                        >

                                            <span
                                                class="h-2 w-2 rounded-full
                                                       bg-red-500"
                                            ></span>

                                            Inactive

                                        </span>

                                    @endif

                                </td>



                                {{-- Joined Date --}}

                                <td class="px-6 py-5">

                                    <p
                                        class="text-sm font-medium
                                               text-slate-700"
                                    >
                                        {{ $employee->created_at->format('d M Y') }}
                                    </p>

                                    <p
                                        class="text-xs text-slate-400"
                                    >
                                        {{ $employee->created_at->diffForHumans() }}
                                    </p>

                                </td>



                                {{-- Actions --}}

                                <td class="px-6 py-5">

                                    <div
                                        class="flex justify-end gap-2"
                                    >


                                        {{-- Edit --}}

                                        <a
                                            href="{{ route('admin.employees.edit', $employee) }}"
                                            title="Edit employee"
                                            class="rounded-xl border
                                                   border-slate-200
                                                   bg-white p-2.5
                                                   text-slate-500 shadow-sm
                                                   transition
                                                   hover:border-indigo-200
                                                   hover:bg-indigo-50
                                                   hover:text-indigo-600"
                                        >

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
                                                    d="M12 20h9"
                                                />

                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M16.5 3.5a2.1 2.1 0 013 3L8 18l-4 1 1-4L16.5 3.5z"
                                                />

                                            </svg>

                                        </a>

{{-- View Tasks --}}

<a
    href="{{ route('admin.employees.tasks', $employee) }}"
    title="View employee tasks"
    class=" rounded-xl border
           border-slate-200
           bg-white p-2.5
           text-slate-500 shadow-sm
           transition
           hover:border-blue-200
           hover:bg-blue-50
           hover:text-blue-600"
>
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
            d="M9 5h6M9 9h6M9 13h6M9 17h4"
        />

        <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M5 3h14a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2z"
        />
    </svg>
</a>


                                        {{-- Toggle Status --}}

                                        <form
                                            action="{{ route('admin.employees.toggle-status', $employee) }}"
                                            method="POST"
                                        >

                                            @csrf

                                            @method('PATCH')


                                            <button
                                                type="submit"
                                                title="{{ $employee->status ? 'Deactivate' : 'Activate' }}"
                                                class="rounded-xl border
                                                       border-slate-200
                                                       bg-white p-2.5
                                                       text-slate-500 shadow-sm
                                                       transition
                                                       hover:border-amber-200
                                                       hover:bg-amber-50
                                                       hover:text-amber-600"
                                            >

                                                @if($employee->status)

                                                    ⏸

                                                @else

                                                    ▶

                                                @endif

                                            </button>

                                        </form>



                                        {{-- Delete --}}

                                        <form
                                            action="{{ route('admin.employees.destroy', $employee) }}"
                                            method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this employee?')"
                                        >

                                            @csrf

                                            @method('DELETE')


                                            <button
                                                type="submit"
                                                title="Delete employee"
                                                class="rounded-xl border
                                                       border-slate-200
                                                       bg-white p-2.5
                                                       text-slate-500 shadow-sm
                                                       transition
                                                       hover:border-red-200
                                                       hover:bg-red-50
                                                       hover:text-red-600"
                                            >

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
                                                        d="M3 6h18"
                                                    />

                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M8 6V4h8v2"
                                                    />

                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M19 6l-1 15H6L5 6"
                                                    />

                                                    <path
                                                        stroke-linecap="round"
                                                        d="M10 11v6M14 11v6"
                                                    />

                                                </svg>

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>


                        @endforeach

                    </tbody>

                </table>

            </div>



            {{-- ================================================= --}}
            {{-- Pagination --}}
            {{-- ================================================= --}}

            @if($employees->hasPages())

                <div
                    class="border-t border-slate-200
                           px-6 py-4"
                >

                    {{ $employees->links() }}

                </div>

            @endif


        @else


            {{-- ================================================= --}}
            {{-- No Employees / No Search Results --}}
            {{-- ================================================= --}}

            <div class="px-6 py-16 text-center">

                <div
                    class="mx-auto flex h-20 w-20 items-center
                           justify-center rounded-3xl
                           bg-indigo-50 text-3xl"
                >
                    👥
                </div>


                @if(request('search'))

                    <h3
                        class="mt-5 text-xl font-bold
                               text-slate-900"
                    >
                        No employees found
                    </h3>

                    <p
                        class="mx-auto mt-2 max-w-md
                               text-sm text-slate-500"
                    >
                        No employee matches
                        "<strong>{{ request('search') }}</strong>".
                        Try another name or email.
                    </p>


                    <a
                        href="{{ route('admin.employees.index') }}"
                        class="mt-6 inline-flex items-center
                               gap-2 rounded-xl
                               border border-slate-300
                               bg-white px-5 py-3
                               text-sm font-bold
                               text-slate-700
                               transition hover:bg-slate-50"
                    >
                        Clear Search
                    </a>

                @else

                    <h3
                        class="mt-5 text-xl font-bold
                               text-slate-900"
                    >
                        No employees yet
                    </h3>

                    <p
                        class="mx-auto mt-2 max-w-md
                               text-sm text-slate-500"
                    >
                        Start building your team by adding
                        your first employee.
                    </p>


                    <a
                        href="{{ route('admin.employees.create') }}"
                        class="mt-6 inline-flex items-center
                               gap-2 rounded-xl
                               bg-indigo-600 px-5 py-3
                               text-sm font-bold text-white
                               shadow-lg shadow-indigo-600/20
                               transition hover:bg-indigo-700"
                    >

                        + Add First Employee

                    </a>

                @endif

            </div>

        @endif

    </div>

</div>

@endsection