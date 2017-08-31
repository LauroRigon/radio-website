@extends('layouts.app')

@section('page-links')

@endsection

@section('content_title')
    Programação
@endsection

@section('main-content')
        <div class="col-md-9 well">
            <div class="row">
            <tabs size-class="col-md-12">
                <tab name="Segunda" :selected="true" style="display: none">
                    <div id="segunda">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Gênero</th>
                                <th>Horário</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($programs as $program)
                                @if($program->day_of_week == 'segunda-feira')
                                    <tr>
                                        <td>{{ $program->name }}</td>
                                        <td>{{ $program->type }}</td>
                                        <td>{{ $program->time }}</td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </tab>

                <tab name="Terça" style="display: none">
                    <div id="segunda">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Gênero</th>
                                <th>Horário</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($programs as $program)
                                @if($program->day_of_week == 'terca-feira')
                                    <tr>
                                        <td>{{ $program->name }}</td>
                                        <td>{{ $program->type }}</td>
                                        <td>{{ $program->time }}</td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </tab>

                <tab name="Quarta" style="display: none">
                    <div id="segunda">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Gênero</th>
                                <th>Horário</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($programs as $program)
                                @if($program->day_of_week == 'quarta-feira')
                                    <tr>
                                        <td>{{ $program->name }}</td>
                                        <td>{{ $program->type }}</td>
                                        <td>{{ $program->time }}</td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </tab>

                <tab name="Quinta" style="display: none">
                    <div id="segunda">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Gênero</th>
                                <th>Horário</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($programs as $program)
                                @if($program->day_of_week == 'quinta-feira')
                                    <tr>
                                        <td>{{ $program->name }}</td>
                                        <td>{{ $program->type }}</td>
                                        <td>{{ $program->time }}</td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </tab>

                <tab name="Sexta" style="display: none">
                    <div id="segunda">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Gênero</th>
                                <th>Horário</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($programs as $program)
                                @if($program->day_of_week == 'sexta-feira')
                                    <tr>
                                        <td>{{ $program->name }}</td>
                                        <td>{{ $program->type }}</td>
                                        <td>{{ $program->time }}</td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </tab>

                <tab name="Sábado" style="display: none">
                    <div id="segunda">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Gênero</th>
                                <th>Horário</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($programs as $program)
                                @if($program->day_of_week == 'sabado')
                                    <tr>
                                        <td>{{ $program->name }}</td>
                                        <td>{{ $program->type }}</td>
                                        <td>{{ $program->time }}</td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </tab>

                <tab name="Domingo" style="display: none">
                    <div id="segunda">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Gênero</th>
                                <th>Horário</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($programs as $program)
                                @if($program->day_of_week == 'domingo')
                                    <tr>
                                        <td>{{ $program->name }}</td>
                                        <td>{{ $program->type }}</td>
                                        <td>{{ $program->time }}</td>
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

