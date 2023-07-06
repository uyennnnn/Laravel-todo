@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h2>User Details</h2>

    <h3>Name: {{ $user->name }}</h3>
    <h3>Email: {{ $user->email }}</h3>

    <h3>Todos:</h3>
    <ul>
        @foreach ($todos as $todo)
        <li>
            <strong>Todo Name:</strong> {{ $todo->todo_name }}<br>
            <strong>Deadline:</strong> {{ $todo->deadline }}<br>
            <strong>Status:</strong>
            @if ($todo->complete)
            <span class="text-success">Completed</span>
            @else
            <span class="text-danger">Incompleted</span>
            @endif
        </li>
        @endforeach
    </ul>
</div>
@endsection