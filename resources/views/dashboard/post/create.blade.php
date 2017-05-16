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
    Criar postagem
@endsection

@section('content_header')
    <li><a href="/admin/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Criar postagem</li>
@endsection

@section('main-content')
<div class="box box-primary">
	<div class="box-body">
      <form role="form" action="{{route('post_create')}}" id="post-form">
      {{ csrf_field() }}
      <input name="galleryKey" type="hidden" value="{{ $galleryKey }}">
        <!-- text input -->
        <div class="form-group">
          <label>Título</label>
          <input type="text" class="form-control" name="title" placeholder="Digite aqui o título da postagem">
        </div>

        <div class="form-group">
          <label>Subtítulo</label>
          <input type="text" class="form-control" name="subtitle" placeholder="Digite aqui o subtítulo da postagem">
        </div>
		
		<div class="form-group">
          <label>Categoria</label>
          <select class="form-control" name="category_id">
            @foreach($categories as $category)
              <option>Selecione uma categoria</option>
              <option value="{{$category->id}}">{{ $category->name  }}</option>
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
            
        </textarea>
        </div>

        
      </form>

      <div class="form-group">
        <label>Galeria</label>
        <form action="{{route('send_gallery')}}" method="post" class="dropzone" id="dropzone-id">
        {{ csrf_field() }}
        <input id="galleryKey" name="galleryKey" type="hidden" value="{{ $galleryKey }}">
            <div class="dz-message">
                <i class="fa fa-cloud-upload fa-3" aria-hidden="true"></i><h3>Clique aqui ou arraste as imagens para envia-las</h3>
            </div>

            <div class="fallback">
                <input name="images" type="file" enctype="multipart/form-data" />
            </div>
        </form>

        <div class="box-footer">
          <button type="submit" class="btn btn-primary" form="post-form" id="sendForm">Enviar</button>
        </div>
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

<script>
Dropzone.options.dropzoneId = {
  paramName: "images", // Name que será usado para mandar as imagens
  maxFilesize: 12, // MB
  addRemoveLinks: true,
  acceptedFiles: ".png,.jpg,.bmp,.jpeg",
  dictRemoveFile: 'Remover',
  myDropzone: this,
  
  init: function() {
    this.on("removedfile", function(file) {
      console.log();
      if(file.status == 'success'){
        axios.post('gallery/deleteGalleryImg', {
          galleryKey: $("#galleryKey").val(),
          fileName: file.name
        }).then(function(response){
          console.log(response);
        });
      }
    });
  }
};

$("#sendForm").on('click', function(e){
  e.preventDefault();
  console.log(Dropzone);
})
</script>

@endsection