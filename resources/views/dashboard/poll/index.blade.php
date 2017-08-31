@extends('dashboard.layouts.app')

@section('page-links')

@endsection

@section('content_title')
    Minhas enquetes
@endsection

@section('content_header')
    <li><a href="/admin/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Minhas enquetes</li>
@endsection

@section('main-content')
    <div class="box box-primary">
        <div class="box-body">
            <vue-table title="Tabela de enquetes"
                       :has-actions="true"
                       :fields="[
                          {
                            name: 'Id',
                            dbName: 'id'
                          },
                          {
                            name: 'Titulo',
                            dbName: 'title'
                          },
                          {
                            name: 'Situação',
                            dbName: 'status'
                          },
                          {
                            name: 'Criada em',
                            dbName: 'created_at'
                          },
                          {
                            name: '__actions'
                          }
                       ]"
                       source-data="polls/getMyPolls"
                       delete-api="polls/delete/"
                       :tb-buttons="[
                            { name: 'create-button', class: 'btn btn-primary', href: 'admin/polls/create', text: 'Criar'},
                        ]"
                       :actions="[
                    { name: 'view-item', icon: 'glyphicon glyphicon-search', class: 'btn btn-info', href: 'admin/polls/view/', param: 'true'},
                    { name: 'delete-item', icon: 'glyphicon glyphicon-trash', class: 'btn btn-danger'}
                ]"></vue-table>
        </div>
    </div>


    </div>

@endsection
@section('page-scripts')

@endsection