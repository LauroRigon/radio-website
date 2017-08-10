@extends('dashboard.layouts.app')

@section('page-links')

@endsection

@section('content_title')
    Editar apoiador
@endsection

@section('content_header')
    <li><a href="/admin/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Editar apoiador</li>
@endsection

@section('main-content')
    <div class="col-md-6">
        <div class="box box-primary col-md-6">
            <div class="box-body">
                <form method="POST" action="{{ route('supporter_update', $supporter['id']) }}" id="main-form" enctype="multipart/form-data">
                    <div class="row">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for='name'>Nome:</label>
                            <input type="text" id="name" name="name" class="form-control" value="{{ $supporter['name'] }}" required>
                        </div>

                        <div class="form-group">
                            <label for='image'>Imagem:</label>
                            <input type="file" id="image" name="image" class="form-control">
                        </div>

                        <div class="form-group">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="status" {{ ($supporter['status'] == 1)? 'checked': ''}}>Ativo {{ $supporter['status'] }}
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Posição na página:</label>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="side" value="left" {{ ($supporter['side'] == 'left')? 'checked': ''}}>
                                    Esquerdo
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="side" value="right" {{ ($supporter['side'] == 'right')? 'checked': ''}}>
                                    Direito
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="link">Link:</label>
                            <input type="text" class="form-control" id="link" name="link" value="{{ $supporter['link'] }}">
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