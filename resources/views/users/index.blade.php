<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }} ({{ $users->total() }})
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg py-[20px]">

                <section class="container px-4 mx-auto">
                    <div class="mb-[20px]">
                        <a href="{{ route('users.create') }}" class="text-blue-500 hover:text-blue-600 hover:underline active:opacity-60">
                            Add new user
                        </a>
                    </div>

                    <div class="flex flex-col">
                        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                                <div class="overflow-hidden border border-gray-200 md:rounded-lg">
                                    <table class="min-w-full divide-y divide-gray-200 ">
                                        <thead class="bg-gray-50 ">
                                            <tr>
                                                <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 ">
                                                    FIRST NAME
                                                </th>

                                                <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 ">
                                                    LAST NAME
                                                </th>

                                                <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 ">
                                                    EMAIL
                                                </th>

                                                <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 ">
                                                    ACTIONS
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200 ">
                                            @foreach ($users as $user)
                                            <tr>
                                                <td class="px-4 py-4 text-sm font-medium text-gray-700 whitespace-nowrap">
                                                    <div class="inline-flex items-center gap-x-3">
                                                        <span>{{ $user->first_name }}</span>
                                                    </div>
                                                </td>
                                                <td class="px-4 py-4 text-sm font-medium text-gray-700 whitespace-nowrap">
                                                    <div class="inline-flex items-center gap-x-3">
                                                        <span>{{ $user->last_name }}</span>
                                                    </div>
                                                </td>
                                                <td class="px-4 py-4 text-sm font-medium text-gray-700 whitespace-nowrap">
                                                    <div class="inline-flex items-center gap-x-3">
                                                        <span>{{ $user->email }}</span>
                                                    </div>
                                                </td>
                                                <td class="px-4 py-4 text-sm whitespace-nowrap">
                                                    <div class="flex items-center gap-x-6">
                                                        <a href="{{ route('users.edit', $user) }}" class="text-gray-500 transition-colors duration-200 hover:text-gray-800 active:opacity-60 focus:outline-none">
                                                            Edit
                                                        </a>

                                                        @unless ($user->is(Auth::user()))
                                                            <form
                                                                action="{{ route('users.destroy', $user) }}"
                                                                method="POST"
                                                                onsubmit="return confirm('Are you sure?')"
                                                            >
                                                                @csrf
                                                                @method('DELETE')

                                                                <button
                                                                    type="submit"
                                                                    class="text-red-500 transition-colors duration-200 hover:text-red-800 active:opacity-60 focus:outline-none"
                                                                >
                                                                    Delete
                                                                </button>
                                                            </form>
                                                        @endunless
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if ($users->lastPage() !== 1)
                        <div class="flex items-center justify-between mt-6">
                            <a
                                href="{{ $users->previousPageUrl() }}"
                                @class([
                                    "flex items-center px-5 py-2 text-sm text-gray-700 capitalize transition-colors duration-200 bg-white border rounded-md gap-x-2 hover:bg-gray-100 ",
                                    "pointer-events-none opacity-50" => ! $users->previousPageUrl()
                                ])
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 rtl:-scale-x-100">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
                                </svg>

                                <span>
                                    previous
                                </span>
                            </a>

                            <div class="items-center hidden md:flex gap-x-3">
                                @for ($page = 1; $page <= $users->lastPage(); $page++)
                                    <a
                                        href="{{ route('users.index', ['page' => $page]) }}"
                                        @class([
                                            "px-2 py-1 text-sm text-blue-500 rounded-md bg-blue-100/60",
                                            "bg-blue-700 text-white font-bold" => $page === $users->currentPage(),
                                        ])
                                    >
                                        {{ $page }}
                                    </a>
                                @endfor
                            </div>

                            <a
                                href="{{ $users->nextPageUrl() }}"
                                @class([
                                    "flex items-center px-5 py-2 text-sm text-gray-700 capitalize transition-colors duration-200 bg-white border rounded-md gap-x-2 hover:bg-gray-100 ",
                                    "pointer-events-none opacity-50" => ! $users->nextPageUrl()
                                ])
                            >
                                <span>
                                    Next
                                </span>

                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 rtl:-scale-x-100">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                                </svg>
                            </a>
                        </div>
                    @endif
                </section>
            </div>
        </div>
    </div>
</x-app-layout>
