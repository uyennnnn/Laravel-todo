<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user();

        $todos = User::find($user->id)->todos;

        return view('home', compact('todos'));
    }

    public function updateTodo(Request $request)
    {
        $todoId = $request->input('todo_id');
        $complete = $request->has('complete');

        // Lấy thông tin todo từ ID
        $todo = Todo::find($todoId);

        if ($todo) {
            $todo->complete = $complete;
            $todo->save();

            return redirect()->back()->with('success', 'Todo status updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Todo not found.');
        }
    }

    public function create()
    {
        return view('todos_create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'todo_name' => 'required',
            'deadline' => 'required',
        ]);

        $todo = new Todo;
        $todo->todo_name = $request->input('todo_name');
        $todo->user_id = auth()->user()->id; // Lấy user_id từ người đăng nhập
        $todo->deadline = $request->input('deadline');
        $todo->complete = false;
        $todo->save();

        return redirect()->route('home')->with('success', 'Todo created successfully.');
    }


    public function destroy($id)
    {
        $todo = Todo::find($id);

        if ($todo) {
            $todo->delete();
            return redirect()->back()->with('success', 'Todo deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Todo not found.');
        }
    }
}
