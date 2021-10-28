@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="{{ route('todo.create') }}" class="btn btn-primary mb-3">新規作成</a>
                @foreach ($todo_list as $todo)
                    <div class="card">
                        <div class="card-header">
                            <label>
                                <input type="checkbox" class="todo-checkbox" data-id="{{ $todo['id'] }}" @if ($todo['status'])checked @endif>
                            </label>
                            {{ ($todo['title']) }}
                        </div>
                        <div class="d-flex flex-row">
                            <div class="card-body">
                                {{ ($todo['detail']) }}
                            </div>
    
                            <div class="d-flex justify-content-end align-items-center mr-3">
                                <div class="mr-3">
                                    <a href="{{ route('todo.show', $todo['id'])}}" class="btn btn-outline-primary">詳細</a>
                                </div>
                                <form action="{{ route('todo.delete', $todo['id'])}}" method="post">
                                    @csrf
                                    <input type="submit" class="btn btn-outline-secondary" value="削除">
                                </form>
                            </div>
                        </div>
                    </div>
                <br>
            @endforeach
        </div>
    </div>
</div>

@section('js')
<script src="{{ asset('js/update_status.js') }}"></script>
@endsection
@endsection