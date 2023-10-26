<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodosApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // app/Http/Controllers/Api/TodosApiController.php

public function index()
{
    
    $todos = Todo::where('user_id', auth()->user()->id)->get();

    return response()->json(['data' => $todos], 200);
}



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         // Validate the request data
    $validatedData = $request->validate([
        'title' => 'required|max:255',
        'description' => 'required|max:800',
    ]);

    // Create a new todo for the authenticated user
    $validatedData['user_id'] = auth()->user()->id;
    $validatedData['is_completed'] = 0;

    $todo = Todo::create($validatedData);

    return response()->json($todo, 201); 
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $todo = Todo::findOrFail($id);

        // Check if the authenticated user owns the todo
        if (auth()->user()->id !== $todo->user_id) {
            return response()->json(['error' => 'Unauthorized' , 'message' => 'This todo does not belong to you.'], 401);
        }
    
        $todo->delete();
    
        return response()->json(['message' => 'Todo deleted successfully'], 200);
    }
}
