<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoRequest;
use App\Models\Todo;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class TodoController extends Controller
{

public function getUserTodos()
{
    $user = auth()->user(); // Get the authenticated user
    $todos = Todo::where('user_id', $user->id)->get(); // Fetch todos for the user

    return response()->json(['todos' => $todos], 200);
}

    public function index()
{
    // Get the currently authenticated user
    $user = auth()->user();

    // Retrieve and display only the todos associated with the user
    $todos = $user->todos;

    $countCompletedTodos = $this->countCompletedTodos();
    $countNotCompletedTodos = $this->countNotCompletedTodos();

    return view('todos.index', [
        'todos' => $todos,
        'countCompletedTodos' => $countCompletedTodos,
        'countNotCompletedTodos' => $countNotCompletedTodos,
    ]);
}

    public function countCompletedTodos()
    {
        $user = auth()->user();
        return $user->todos()->where('is_completed', 1)->count();
    }
    
    public function countNotCompletedTodos()
    {
        $user = auth()->user();
        return $user->todos()->where('is_completed', 0)->count();
    }

    public function create()
    {
        return view('todos.create');

    }
    public function store(TodoRequest $request)
    {
        // Get the currently authenticated user
        $user = auth()->user();
        // Create a new todo associated with the user
        $todo = $user->todos()->create([
            'title' => $request->title,
            'description' => $request->description,
            'is_completed' => 0
        ]);

        // Flash a success message
        $request->session()->flash('alert-success', 'Todo Created Successfully');

        return redirect()->route('todos.index');

    } public function show($id): View
    {
        $todo = Todo::find($id);

        if (!$todo) {
            return redirect()->route('todos.index')->with('error', 'Unable to locate the Todo');
        }

        // Check if the authenticated user owns the todo
        if ($todo->user_id !== auth()->user()->id) {
            return redirect()->route('todos.index')->with('error', 'Unauthorized');
        }

        return view('todos.show', ['todo' => $todo]);
    }

    public function edit($id): View
    {
        $todo = Todo::find($id);

        if (!$todo) {
            return redirect()->route('todos.index')->with('error', 'Unable to locate the Todo');
        }

        // Check if the authenticated user owns the todo
        if ($todo->user_id !== auth()->user()->id) {
            return redirect()->route('todos.index')->with('error', 'Unauthorized');
        }

        return view('todos.edit', ['todo' => $todo]);
    }

    public function update(TodoRequest $request): RedirectResponse
    {
        $todo = Todo::find($request->todo_id);

        if (!$todo) {
            return redirect()->route('todos.index')->with('error', 'Unable to locate the Todo');
        }

        // Check if the authenticated user owns the todo
        if ($todo->user_id !== auth()->user()->id) {
            return redirect()->route('todos.index')->with('error', 'Unauthorized');
        }

        $todo->update([
            'title' => $request->title,
            'description' => $request->description,
            'is_completed' => $request->is_completed,
        ]);

        return redirect()->route('todos.index')->with('alert-info', 'Todo Updated Successfully');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $todo = Todo::find($request->todo_id);

        if (!$todo) {
            return redirect()->route('todos.index')->with('error', 'Unable to locate the Todo');
        }

        // Check if the authenticated user owns the todo
        if ($todo->user_id !== auth()->user()->id) {
            return redirect()->route('todos.index')->with('error', 'Unauthorized');
        }

        $todo->delete();

        $request->session()->flash('alert-success', 'Todo Deleted Successfully');
    return redirect()->route('todos.index');
    }

}
