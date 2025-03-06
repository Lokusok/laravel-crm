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

                    {{ $users->links() }}
                </section>
            </div>
        </div>
    </div>
</x-app-layout>
