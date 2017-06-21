@extends('dashboard.layouts.app')

@section('page-links')

@endsection

@section('content_title')
    Criar apoiador
@endsection

@section('content_header')
    <li><a href="/admin/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Criar apoiador</li>
@endsection

@section('main-content')
    <div class="col-md-6">
    <div class="box box-primary col-md-6">
        <div class="box-body">
            <form method="POST" action="{{ route('supporter_store') }}" id="main-form" enctype="multipart/form-data">
                <div class="row">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for='name'>Nome:</label>
                        <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required>
                    </div>

                    <div class="form-group">
                        <label for='image'>Imagem:</label>
                        <input type="file" id="image" name="image" class="form-control">
                    </div>

                    <div class="form-group">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="status" checked>Ativo
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="link">Link:</label>
                        <input type="text" class="form-control" id="link" name="link">
                    </div>
                </div>

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary" form="main-form">Concluir</button>
                </div>

            </form>
        </div>
    </div>
    </div>
@endsection
@section('page-scripts')

@endsection