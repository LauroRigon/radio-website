@extends('layouts.app')

@section('page-links')

@endsection

@section('content_title')
    Sobre
@endsection

@section('main-content')
    <div class="col-md-9">
        <div class="row">
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="span8">
                        <div class="post-item well text-center">
                            <h2>{{ $post->title }}</h2>
                            <div class="clearfix">
                                <p class="text-center">
                                <p><img src="{{ $post->thumbnail }}" width="100%"></p>
                                <p>{!! $post->content !!}</p>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection