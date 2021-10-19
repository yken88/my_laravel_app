@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="width: 40rem;">
                <div class="card-body">
                    <h5 class="card-title">{{ $todo->title }}</h5>
                    
                    @if($todo->status === 0)
                        <h6 class="card-subtitle mb-2 text-muted">未完了</h6>
                    @else
                        <h6 class="card-subtitle mb-2 text-muted">完了</h6>
                    @endif
                    <p class="card-text">{{ $todo->detail }}</p>
                    <a href="{{ route('todo.edit', $todo->id )}}" class="card-link">編集</a>
                    <a href="#" class="card-link">削除</a>
                </div>
              </div>
        </div>
    </div>
</div>
@endsection