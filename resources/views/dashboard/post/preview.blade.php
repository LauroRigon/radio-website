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
    <li class="active">Pré-visualização de postagem</li>
@endsection

@section('main-content')
    @if(Auth::user()->is_master == 'Sim' && !$post->allowed)
        <post-authorizer approve-api="{{ route('post_approve', $post->id) }}"
                         disapprove-api="{{ route('post_disapprove', $post->id) }}"
                         delete-post-api="{{ route('post_delete', $post->id) }}"></post-authorizer>
    @endif
    @if(!$post->is_about)
        <div class="row">
            <div class="col-4 pull-right" style="position:absolute;bottom:5px;right:5px;margin:0;padding:5px 3px;">
                <div class="box box-solid" style="padding:5px">
                    <a class="btn btn-primary" >Substituir sessão "Sobre"</a>
                </div>
            </div>
        </div>
    @endif
    <div class="box box-primary">

        <div class="box-body">
            <div class="col-md-12 text-center">
                <img src="{{ $post->thumbnail }}" class="img-responsive">
                <p class="description">Criado por: {{ $post->user()->get()[0]->name }} | Publicado dia: {{ $post->published_at }}</p>
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