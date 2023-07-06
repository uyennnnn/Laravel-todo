@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h4>Add New Todo</h4>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('todos.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="todo_name">Todo Name</label>
                            <input type="text" class="form-control" id="todo_name" name="todo_name" required>
                        </div>
                        <div class="form-group">
                            <label for="deadline">Deadline</label>
                            <input type="date" class="form-control" id="deadline" name="deadline" required>
                        </div>

                        <div class="form-group  mt-3">
                        <button type="submit" class="btn btn-primary">Create Todo</button>
                        <a href="{{ route('home') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
