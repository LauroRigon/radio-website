@extends('layouts.app')

@section('page-links')

@endsection

@section('content_title')
    Notícia
@endsection

@section('main-content')
    <div class="col-md-9">
        <div class="row">
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="span8">
                        <div class="post-item well text-center">
                            <a href="{{ route('post_show', $post->slug) }}"><h2>{{ $post->title }}</h2></a>
                            <div class="clearfix">
                                <p class="text-center">
                                    <i class="fa fa-user"></i> Por <a>{{ $post->user()->name }}</a> | <i class="fa fa-list"></i> Categoria <a href="{{ route('post_getByCategory', $post->category_id) }}">{{ $post->category_id }}</a> | <i class="fa fa-clock-o"></i> Em {{ $post->published_at }}
                                <p><img src="{{ $post->thumbnail }}" width="100%"></p>
                                <p>{!! $post->content !!}</p>
                                <vue-gallery source-api="{{ route('get_public_gallery', $post->id) }}"></vue-gallery>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

