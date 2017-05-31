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
      <form role="form" action="{{route('post_store')}}" id="post-form" method="POST" enctype="multipart/form-data">
      {{ csrf_field() }}
      <input name="galleryKey" type="hidden" value="{{ $galleryKey }}">
      <input name="PostGalleryImgs" type="hidden" value="">
        <!-- text input -->
        <div class="form-group">
          <label>Título</label>
          <input type="text" class="form-control" id="title" name="title" placeholder="Digite aqui o título da postagem" value="{{ old('title') }}">
        </div>

        <div class="form-group">
          <label>Subtítulo</label>
          <input type="text" class="form-control" id="subtitle" name="subtitle" placeholder="Digite aqui o subtítulo da postagem" value="{{ old('subtitle') }}">
        </div>
		
		<div class="form-group">
          <label>Categoria</label>
          <select class="form-control" name="category_id">
          <option>Selecione uma categoria</option>
            @foreach($categories as $category)              
              <option value="{{$category->id}}" {{ (old('category_id')? 'selected': '') }}>{{ $category->name }}</option>
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
          <button type="submit" class="btn btn-primary" form="post-form" id="sendForm">Concluir</button>
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
var myDropzone = new Dropzone("form#dropzone-id", { 
  paramName: "images", // Name que será usado para mandar as imagens
  maxFilesize: 12, // MB
  acceptedFiles: ".png,.jpg,.bmp,.jpeg"
  });
  
  //criar botao de remover
  myDropzone.on("addedfile", function(file) {
      // Create the remove button
        var removeButton = Dropzone.createElement("<button class='btn btn-danger btn-sm center-block'>Remover</button>");
        // Capture the Dropzone instance as closure.
        var _this = this;

        // Listen to the click event
        removeButton.addEventListener("click", function(e) {
          // Make sure the button click doesn't submit the form:
          e.preventDefault();
          e.stopPropagation();

          // Remove the file preview.
          _this.removeFile(file);
          // If you want to the delete the file on the server as well,
          // you can do the AJAX request here.
        });

        // Add the button to the file preview element.
        file.previewElement.appendChild(removeButton);
    });

  myDropzone.on("removedfile", function(file) {
      console.log(this);
      if(file.status == 'success'){
        axios.post('gallery/deleteGalleryImg', {
          galleryKey: $("#galleryKey").val(),
          fileName: file.name
        })

        .then(function(response){
          toastr.success(response.data['status']);
        })
        .catch(function(error){
          toastr.error("Ocorreu um erro ao deletar arquivo")
        });
      }
    });

$("#sendForm").on('click', function(e){
  e.preventDefault();
  var acceptedFiles = myDropzone.getAcceptedFiles();
  
  var filesName = [];
    for(i=0; i<acceptedFiles.length; i++){
      filesName[i] = acceptedFiles[i]['name'];  
    }

  $("[name='PostGalleryImgs']").val(filesName);

  e.target.form.submit();
})
</script>

@endsection