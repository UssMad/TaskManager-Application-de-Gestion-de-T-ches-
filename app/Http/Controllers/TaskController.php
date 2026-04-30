<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    public function index(Request $request)
    {
        $query = Task::with('category')
            ->where('user_id', auth()->id())
            ->latest();


        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $tasks = $query->paginate(8);
        $categories = Category::all();

            // Task counts by status for the welcome banner
        $taskCounts = [
            'total'       => Task::where('user_id', auth()->id())->count(),
            'todo'        => Task::where('user_id', auth()->id())->where('status', 'todo')->count(),
            'in_progress' => Task::where('user_id', auth()->id())->where('status', 'in_progress')->count(),
            'done'        => Task::where('user_id', auth()->id())->where('status', 'done')->count(),
            'overdue'     => Task::where('user_id', auth()->id())
                                ->where('status', '!=', 'done')
                                ->whereNotNull('due_date')
                                ->where('due_date', '<', now()->toDateString())
                                ->count(),
        ];

        return view('tasks.index', compact('tasks', 'categories', 'taskCounts'));
    }

    /**
     * Show the form for creating a new task.
     */
    public function create()
    {
        $categories = Category::all();
        return view('tasks.create', compact('categories'));
    }

    /**
     * Store a newly created task in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:todo,in_progress,done',
            'due_date' => 'nullable|date',
            'category_id' => 'required|exists:categories,id',
        ]);

        $validated['user_id'] = auth()->id();

        Task::create($validated);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    /**
     * Display the specified task.
     */
    public function show(Task $task)
    {
        // Mandatory ownership check
        if ($task->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $task->load(['category', 'user']);
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified task.
     */
    public function edit(Task $task)
    {
        // Mandatory ownership check
        if ($task->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $categories = Category::all();
        return view('tasks.edit', compact('task', 'categories'));
    }

    /**
     * Update the specified task in storage.
     */
    public function update(Request $request, Task $task)
    {
        // Mandatory ownership check
        if ($task->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:todo,in_progress,done',
            'due_date' => 'nullable|date',
            'category_id' => 'required|exists:categories,id',
        ]);

        $task->update($validated);

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    /**
     * Remove the specified task from storage.
     */
    public function destroy(Task $task)
    {
        // Mandatory ownership check
        if ($task->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }

    /**
     * Quickly update the status of a task (US7).
     */
    public function updateStatus(Request $request, Task $task)
    {
        // Mandatory ownership check
        if ($task->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'status' => 'required|in:todo,in_progress,done',
        ]);

        $task->update(['status' => $validated['status']]);

        return redirect()->route('tasks.index')->with('success', 'Task status updated successfully.');
    }
}
