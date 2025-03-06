<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tasks') }} ({{ $tasks->total() }})
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg py-[20px]">

                <section class="container px-4 mx-auto">
                    <div class="mb-[20px]">
                        <a href="{{ route('tasks.create') }}" class="text-blue-500 hover:text-blue-600 hover:underline active:opacity-60">
                            Add new task
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
                                                    TITLE
                                                </th>

                                                <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 ">
                                                    ASSIGNED TO
                                                </th>

                                                <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 ">
                                                    CLIENT
                                                </th>

                                                <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 ">
                                                    DEADLINE
                                                </th>

                                                <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 ">
                                                    STATUS
                                                </th>

                                                <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 ">
                                                    ACTIONS
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200 ">
                                            @foreach ($tasks as $task)
                                            <tr>
                                                <td class="px-4 py-4 text-sm font-medium text-gray-700 whitespace-nowrap">
                                                    <div class="inline-flex items-center gap-x-3">
                                                        <span>{{ $task->title }}</span>
                                                    </div>
                                                </td>
                                                <td class="px-4 py-4 text-sm font-medium text-gray-700 whitespace-nowrap">
                                                    <div class="inline-flex items-center gap-x-3">
                                                        <span>{{ $task->user->first_name }} {{ $task->user->last_name }}</span>
                                                    </div>
                                                </td>
                                                <td class="px-4 py-4 text-sm font-medium text-gray-700 whitespace-nowrap">
                                                    <div class="inline-flex items-center gap-x-3">
                                                        <span>{{ $task->client->company_name }}</span>
                                                    </div>
                                                </td>
                                                <td class="px-4 py-4 text-sm font-medium text-gray-700 whitespace-nowrap">
                                                    <div class="inline-flex items-center gap-x-3">
                                                        <span>{{ $task->deadline_at }}</span>
                                                    </div>
                                                </td>
                                                <td class="px-4 py-4 text-sm font-medium text-gray-700 whitespace-nowrap">
                                                    <div class="inline-flex items-center gap-x-3">
                                                        <span>{{ $task->status }}</span>
                                                    </div>
                                                </td>
                                                <td class="px-4 py-4 text-sm whitespace-nowrap">
                                                    <div class="flex items-center gap-x-6">
                                                        <a href="{{ route('tasks.edit', $task) }}" class="text-gray-500 transition-colors duration-200 hover:text-gray-800 active:opacity-60 focus:outline-none">
                                                            Edit
                                                        </a>

                                                        <form
                                                            action="{{ route('tasks.destroy', $task) }}"
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

                    {{ $tasks->links() }}
                </section>
            </div>
        </div>
    </div>
</x-app-layout>
