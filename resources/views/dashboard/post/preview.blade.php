@extends('dashboard.layouts.app')

@section('page-links')
<link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
<style>
    .box{
        padding-left: 15%;
        padding-right: 15%;
    }
</style>
@endsection

@section('content_title')
    Pré-visualização de postagem
@endsection

@section('content_header')
    <li><a href="/admin/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Criar postagem</li>
@endsection

@section('main-content')
    @if(Auth::user()->is_master == 'Sim' && !$post->allowed)
        <div class="row">
            <div class="col-md-2 pull-right">
                <div class="box box-solid" style="padding:5px">
                    <div class="btn-group">
                        <form method="POST" action="{{route('post_allow', ['post' => $post->id])}}">
                            {{ csrf_field() }}
                            <input type="hidden" value="1" name="allowed">
                            <button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-ok"></i> Aprovar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="box box-primary">
        <div class="box-body">
            <div class="col-md-12 text-center">
                <img src="{{ $post->thumbnail }}" class="img-responsive">
                <p class="description">Criado por: {{ $post->user()->get()[0]->name }} | Postado dia: {{ $post->published_at }}</p>
            </div>
            <div class="row text-center">
                <h1>{{ $post->title }}</h1>
                    
            </div>
            <div class="row">
                <div class="text-center">
                    {!! $post->content !!}

                    <vue-gallery source-api="/admin/posts/getGallery/{{ $post->id }}"></vue-gallery>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('page-scripts')


@endsection