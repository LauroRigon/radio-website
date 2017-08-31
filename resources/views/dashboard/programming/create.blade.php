@extends('dashboard.layouts.app')

@section('page-links')

@endsection

@section('content_title')
    Adicionar programação
@endsection

@section('content_header')
    <li><a href="/admin/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Adicionar programação</li>
@endsection

@section('main-content')
    <div class="box box-primary">
        <div class="box-body">
                <form method="POST" action="{{ route('programming_store') }}" id="main-form">
                    <div class="row">
                        {{ csrf_field() }}
                        <div class="form-group col-md-5">
                            <label for='name'>Nome do programa:</label>
                            <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}">
                        </div>

                        <div class="form-group col-md-3">
                            <label for='type'>Gênero do programa:</label>
                            <input type="text" id="type" name="type" class="form-control" value="{{ old('type') }}">
                        </div>

                        <div class="form-group col-md-5">
                            <label for='type'>Dia da semana:</label>
                            <select class="form-control" name="day_of_week">
                                <option value='segunda-feira' selected>Segunda-feira</option>
                                <option value='terca-feira'>Terça-feira</option>
                                <option value='quarta-feira'>Quarta-feira</option>
                                <option value='quinta-feira'>Quinta-feira</option>
                                <option value='sexta-feira'>Sexta-feira</option>
                                <option value='sabado'>Sábado</option>
                                <option value='domingo'>Domingo</option>
                            </select>
                        </div>
                        <div class="form-group col-md-5">
                            <label for="time">Horário:</label>
                            <input type="text" class="form-control timepicker" id="time" name="time">
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
<script>
    $(function () {
        //Timepicker
        $(".timepicker").timepicker({
            showInputs: false,
            minuteStep: 10,
            showMeridian: false,
            explicitMode: true
        });
    });
</script>
@endsection