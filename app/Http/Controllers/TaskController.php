<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Category;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        return view('app', [
            'categories' => Category::all(),
            'tasks' => Task::query()->latest()->get(),
        ]);
    }

    public function store(TaskRequest $request)
    {

        $task = Task::create([
            'is_done' => false,
            'title' => $request->title,
            'user_id' => auth()->id()
        ]);

        // dd($task->categories(), $request);
        $task->categories()->sync($request->categories);

        return back();
    }

    public function toggle($id)
    {
        $task = Task::find($id);

        $task->update([
            'is_done' => !$task->is_done
        ]);

        return back();
    }
}
