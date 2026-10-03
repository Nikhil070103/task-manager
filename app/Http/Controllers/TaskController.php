<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = auth()->user()->tasks()->latest()->get();
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        $request->user()->tasks()->create($data);
        return redirect()->route('tasks.index')->with('success', 'Task added');
    }

    public function edit(Task $task)
    {
        $this->own($task);
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $this->own($task);
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        $data['is_done'] = $request->has('is_done');
        $task->update($data);
        return redirect()->route('tasks.index')->with('success', 'Task updated');
    }

    public function destroy(Task $task)
    {
        $this->own($task);
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted');
    }

    private function own(Task $task)
    {
        abort_if($task->user_id !== auth()->id(), 403);
    }
}
