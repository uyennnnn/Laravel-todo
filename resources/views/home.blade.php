@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4>TodoList</h4>
                        <a href="{{ route('todos.create') }}" class="btn btn-success">
                            <i class="fa fa-plus"></i> Add New Todo</a>
                    </div>
                </div>
                <div class="card-body">
                    @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Status</th>
                                <th>Todo Name</th>
                                <th>Deadline</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($todos as $index => $todo)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <form action="{{ route('todos.update', $todo->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="todo_id" value="{{ $todo->id }}">
                                        <input type="checkbox" name="complete" value="1" {{ $todo->complete ? 'checked' : '' }} onchange="this.form.submit()">
                                        <!-- Thêm onchange="this.form.submit()" để tự động gửi form khi checkbox thay đổi -->
                                    </form>
                                </td>
                                <td>{{ $todo->todo_name }}</td>
                                <td>{{ $todo->deadline }}</td>
                                <td>
                                    <form action="{{ route('todos.destroy',$todo->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn text-danger btn-sm " onclick="return confirm('Are you sure you want to delete this todo?')"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection