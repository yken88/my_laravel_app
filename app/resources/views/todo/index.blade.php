@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="{{ route('todo.index')}}" method="GET">
                <div class="d-flex justify-content-center align-items-center">
                    <input class="mr-3" type="checkbox" name="status" value="1">
                    <input type="text" class="col-md-6 form-control mr-2" name="title" value="{{ old('title') }}" autofocus>
                    <input type="submit" class="btn btn-info text-light" value="検索">
                </div>
            </form>
            <br>
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

                                <label>
                                    <button class="todo-delete btn btn-secondary" data-id="{{ $todo['id'] }}"> 削除</a>
                                </label>
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
<script src="{{ asset('js/delete.js') }}"></script>
@endsection
@endsection