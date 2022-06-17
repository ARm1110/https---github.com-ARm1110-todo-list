<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="px-96">
        <div class="text-3xl text-center font-bold py-6 border-b ">
            My Dummpy ToDo List
        </div>

        @if (Auth::user()->is_admin)
            <!-- create category -->
            <div class="py-5 border-b">
                <div class="text-xl mb-5">
                    Category
                </div>
                <form action="{{ route('categories.store') }}" method="post">
                    @csrf
                    <div class="flex gap-3">
                        <input class="border rounded px-2 py-1 w-full" type="text" name="title"
                            placeholder="Create Category">
                        <input type="submit" class="bg-blue-400 text-white px-3 py-1 rounded-md" value="Create">
                    </div>
                </form>
            </div>
            <!-- create task -->
        @endif
        @if (!Auth::user()->is_admin)
            <div class="py-5 border-b">
                <div class="text-xl mb-5">
                    Task
                </div>
                <form action="{{ route('tasks.store') }}" method="post">
                    @csrf
                    <div class="flex gap-3 items-center">
                        <input class="border rounded px-2 py-1 w-full" type="text" name="title"
                            placeholder="Create Task">
                        <select name="categories[]" multiple class="border w-full rounded">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                            @endforeach
                        </select>
                        <input type="submit" class="bg-blue-400 text-white px-3 py-1 rounded-md" value="Create">
                    </div>
                </form>
            </div>
            <!-- tasks -->
            <div class="py-5 border-b space-y-4">
                @forelse($tasks as $task)
                    <div class="border rounded px-3 py-2 flex justify-between items-center">
                        <div class="space-y-1">
                            <div>
                                {{ $task->title }}
                            </div>
                            <div class="flex gap-1">
                                @foreach ($task->categories as $category)
                                    <div class="text-sm text-gray-600 px-2 rounded-xl bg-gray-200">
                                        {{ $category->title }}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div>
                            <form action="{{ route('tasks.toggle', $task->id) }}" method="post">
                                @csrf
                                @method('patch')
                                <button
                                    class="px-3 py-1 rounded text-white {{ $task->is_done ? 'bg-green-400' : 'bg-red-400' }}">
                                    {{ $task->is_done ? 'Done' : 'Not Done' }}
                                </button>
                            </form>
                        </div>
                    </div>

                @empty
                    <div class="text-center text-2xl">
                        There is no task. 🙂
                    </div>
                @endforelse

        @endif
    </div>
    </div>
    {{-- <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    You're logged in!
                </div>
            </div>
        </div>
    </div> --}}


</x-app-layout>
