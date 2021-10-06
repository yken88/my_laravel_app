@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @foreach ($todo_list as $todo)
            <a href="{{ route('todo.show')}}">
                <div class="card">
                    <div class="card-header">{{ __($todo->title) }}</div>

                    <div class="card-body">
                        {{ __($todo->detail) }}
                    </div>
                </div>
            </a>
                <br>
            @endforeach
        </div>
    </div>
</div>
@endsection