@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="{{ route('todo.create') }}" class="btn btn-primary mb-3">ADD</a>
                @foreach ($todo_list as $todo)
                <a href="{{ route('todo.show', $todo['id'])}}">
                    <div class="card">
                        <div class="card-header">{{ ($todo['title']) }}</div>

                        <div class="card-body">
                            {{ ($todo['detail']) }}
                        </div>
                    </div>
                </a>
                <br>
            @endforeach
        </div>
    </div>
</div>
@endsection