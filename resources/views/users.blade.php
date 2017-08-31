@extends('layouts.app')

@section('page-links')

@endsection

@section('content_title')
    Locutores
@endsection

@section('main-content')
    <div class="col-md-8 hidden-sm hidden-xs well">
            <div class="row">
                @foreach($users as $user)
                    <div class="col-md-3">
                        <div class="thumbnail">
                            <img src="{{ $user->avatar }}" class="img-circle img-responsive">
                            <div class="caption text-center">
                                <span>{{ $user->name }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

    </div>
@endsection

