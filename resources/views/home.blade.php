@extends('layouts.app')

@section('page-links')

@endsection

@section('content_title')
    Página inicial
@endsection

@section('main-content')
    <div class="col-md-3 hidden-sm hidden-xs">
        <div class="row">
            <div class="panel panel-default poll">
                <div class="panel-heading">
                    Programação de hoje
                </div>
                <ul class="list-group">
                    @foreach($programmingOfDay as $program)
                        <li class="list-group-item"><span class="time">{{ $program->time }}</span> {{ $program->name }}</li>
                    @endforeach
                </ul>
                <div class="panel-footer text-center">
                    <a href="/programacao">Programação completa</a>
                </div>
            </div>

            @foreach($supporters as $supporter)
                @if($supporter->side == 'left')
                    <div class="panel panel-default poll">
                        <div class="panel-heading">
                            <i class="fa fa-edit"></i> {{ $supporter->name }}
                        </div>
                        <div class="panel-body">
                            <a target="_blank" href="{{ $supporter->link }}"><img src="{{ $supporter->image }}" width="100%"></a>
                        </div>
                        @if($supporter->link)
                            <div class="panel-footer">
                                <a target="_blank" href="{{ $supporter->link }}">Saiba mais</a>
                            </div>
                        @endif
                    </div>
                @endif
            @endforeach
        </div>
    </div>

    <div class="col-md-6">
        @foreach($posts as $post)
        <div class="row">
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="span8">
                        <div class="post-item well">
                            <a href="{{ route('post_show', $post->slug) }}"><h2>{{ $post->title }}</h2></a>
                            <div class="clearfix">
                                <p class="pull-left">
                                    <i class="fa fa-user"></i> Por <a>{{ $post->user()->name }}</a> | <i class="fa fa-list"></i> Categoria <a href="{{ route('post_getByCategory', $post->category_id) }}">{{ $post->category_id }}</a> | <i class="fa fa-clock-o"></i> Em {{ $post->published_at }}
                                    <p><img src="{{ $post->thumbnail }}" width="100%"></p>
                                    <p>{{ $post->subtitle }}</p>
                                    <a href="{{ route('post_show', $post->slug) }}">Ler mais...</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

        <div class="text-center">
            @if($posts->hasPages())
                {{ $posts->links() }}
            @endif
        </div>
    </div>
@endsection

