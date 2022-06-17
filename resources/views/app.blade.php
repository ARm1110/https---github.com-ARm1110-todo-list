<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>



    <div class="px-96">
        <div class="text-3xl text-center font-bold py-6 border-b ">
            My Dummpy ToDo List
        </div>
        @auth
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
            </div>
        </div>
    @endauth
</body>

</html>
