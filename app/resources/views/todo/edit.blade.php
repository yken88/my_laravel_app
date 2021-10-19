@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit') }}</div>

                <div class="card-body">
                    <form method="POST" action="">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('title') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="title" value="{{ $todo->title }}" autocomplete="title" autofocus>
                                @if($errors->has('title'))
                                    <div class="error">
                                        <p class="text-danger">{{ $errors->first('title') }}</p>
                                    </div>
                                @endif
                            </div>
                            
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Detail') }}</label>
                            <div class="col-md-6">
                                <textarea type="text" class="form-control" name="detail" autocomplete="detail">{{ $todo->detail }}</textarea>

                                @if($errors->has('detail'))
                                <div class="error">
                                    <p class="text-danger">{{ $errors->first('detail') }}</p>
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
