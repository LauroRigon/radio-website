@extends('dashboard.layouts.app')

@section('page-links')
    <link rel="stylesheet" type="text/css" href="{{ asset('js/dashboard/plugins/dropzone/dist/dropzone.css') }}">

    <style>
        .fa-3{
            font-size: 50px;
        }

        .dz-remove{
            background-color: #D4D8DF;
            width: 80px;
            height: 20px;
            margin: 0 auto;
            border-radius: 10%;
            box-shadow: 2px 2px 5px black;
        }
    </style>
@endsection

@section('content_title')
    Editar postagem
@endsection

@section('content_header')
    <li><a href="/admin/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Editar postagem</li>
@endsection

@section('main-content')
    @if (count($errors) > 0)
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>

                @endforeach
            </ul>
        </div>
    @endif
    <div class="box box-primary">
        <div class="box-body">
            <form role="form" action="{{route('post_update', ['post' => $post->id])}}" id="post-form" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input name="galleryKey" type="hidden" value="">
                <input name="PostGalleryImgs" type="hidden" value="">
                <!-- text input -->
                <div class="form-group">
                    <label>Título</label>
                    <input type="text" class="form-control" name="title" placeholder="Digite aqui o título da postagem" value="{{ $post->title }}">
                </div>

                <div class="form-group">
                    <label>Subtítulo</label>
                    <input type="text" class="form-control" name="subtitle" placeholder="Digite aqui o subtítulo da postagem" value="{{ $post->subtitle }}">
                </div>

                <div class="form-group">
                    <label>Categoria</label>
                    <select class="form-control" name="category_id">
                        <option>Selecione uma categoria</option>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}" {{ ($category->name == $post->category_id)? 'selected': '' }}>{{ $category->name  }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Foto de capa</label>
                    <input type="file" id="exampleInputFile" name="thumbnail">

                    <p class="help-block">Essa será a capa da postagem.</p>
                </div>

                <!-- textarea -->
                <div class="form-group">
                    <label>Conteúdo</label>
            <textarea name="content" id="editor1" rows="1" cols="80" class="form-control">
                {{ $post->content }}
            </textarea>
                </div>


            </form>

            <div class="box-footer">
                <button type="submit" class="btn btn-primary" form="post-form" id="sendForm">Enviar</button>
            </div>
        </div>


    </div>

@endsection
@section('page-scripts')
    <script type="text/javascript" src="{{ asset('js/dashboard/plugins/ckeditor/ckeditor.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/dashboard/plugins/dropzone/dist/dropzone.js') }}"></script>
    <script>
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace( 'editor1' );
    </script>
@endsection