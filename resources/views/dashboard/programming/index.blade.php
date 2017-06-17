@extends('dashboard.layouts.app')

@section('page-links')

@endsection

@section('content_title')
    Programação atual
@endsection

@section('content_header')
    <li><a href="/admin/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Programação atual</li>
@endsection

@section('main-content')
    <div class="row">
        <div class="col-md-12">
            <tabs>
                <tab name="Segunda" :selected="true">
                    <div id="segunda">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Gênero</th>
                                    <th>Horário</th>
                                    <th>Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($programs as $program)
                                        @if($program->day_of_week == 'segunda-feira')
                                        <tr>
                                            <td>{{ $program->name }}</td>
                                            <td>{{ $program->type }}</td>
                                            <td>{{ $program->time }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a class="btn btn-danger" href="{{ route('programming_delete', $program->id) }}"><i class="glyphicon glyphicon-trash"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </tab>

                <tab name="Terça">
                    <div id="segunda">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Gênero</th>
                                <th>Horário</th>
                                <th>Ação</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($programs as $program)
                                @if($program->day_of_week == 'terca-feira')
                                    <tr>
                                        <td>{{ $program->name }}</td>
                                        <td>{{ $program->type }}</td>
                                        <td>{{ $program->time }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a class="btn btn-danger" href="{{ route('programming_delete', $program->id) }}"><i class="glyphicon glyphicon-trash"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </tab>

                <tab name="Quarta">
                    <div id="segunda">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Gênero</th>
                                <th>Horário</th>
                                <th>Ação</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($programs as $program)
                                @if($program->day_of_week == 'quarta-feira')
                                    <tr>
                                        <td>{{ $program->name }}</td>
                                        <td>{{ $program->type }}</td>
                                        <td>{{ $program->time }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a class="btn btn-danger" href="{{ route('programming_delete', $program->id) }}"><i class="glyphicon glyphicon-trash"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </tab>

                <tab name="Quinta">
                    <div id="segunda">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Gênero</th>
                                <th>Horário</th>
                                <th>Ação</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($programs as $program)
                                @if($program->day_of_week == 'quinta-feira')
                                    <tr>
                                        <td>{{ $program->name }}</td>
                                        <td>{{ $program->type }}</td>
                                        <td>{{ $program->time }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a class="btn btn-danger" href="{{ route('programming_delete', $program->id) }}"><i class="glyphicon glyphicon-trash"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </tab>

                <tab name="Sexta">
                    <div id="segunda">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Gênero</th>
                                <th>Horário</th>
                                <th>Ação</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($programs as $program)
                                @if($program->day_of_week == 'sexta-feira')
                                    <tr>
                                        <td>{{ $program->name }}</td>
                                        <td>{{ $program->type }}</td>
                                        <td>{{ $program->time }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a class="btn btn-danger" href="{{ route('programming_delete', $program->id) }}"><i class="glyphicon glyphicon-trash"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </tab>

                <tab name="Sábado">
                    <div id="segunda">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Gênero</th>
                                <th>Horário</th>
                                <th>Ação</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($programs as $program)
                                @if($program->day_of_week == 'sabado')
                                    <tr>
                                        <td>{{ $program->name }}</td>
                                        <td>{{ $program->type }}</td>
                                        <td>{{ $program->time }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a class="btn btn-danger" href="{{ route('programming_delete', $program->id) }}"><i class="glyphicon glyphicon-trash"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </tab>

                <tab name="Domingo">
                    <div id="segunda">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Gênero</th>
                                <th>Horário</th>
                                <th>Ação</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($programs as $program)
                                @if($program->day_of_week == 'domingo')
                                    <tr>
                                        <td>{{ $program->name }}</td>
                                        <td>{{ $program->type }}</td>
                                        <td>{{ $program->time }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a class="btn btn-danger" href="{{ route('programming_delete', $program->id) }}"><i class="glyphicon glyphicon-trash"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </tab>
            </tabs>
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