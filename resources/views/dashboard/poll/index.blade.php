@extends('dashboard.layouts.app')

@section('page-links')

@endsection

@section('content_title')
    Minhas votações
@endsection

@section('content_header')
    <li><a href="/admin/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Minhas votações</li>
@endsection

@section('main-content')
    <div class="box box-primary">
        <div class="box-body">

            <vue-table title="Tabela de votações"
               :has-actions="true"
               :fields="['Id', 'Titulo', 'Situação', 'Criada em', 'Ação']"
               :fillable="['id', 'title', 'status', 'created_at']"
               source-data="polls/getMyPolls"
               delete-api="polls/delete/"
               :actions="['view', 'remove']"
               ></vue-table>

        </div>
    </div>


    </div>

@endsection
@section('page-scripts')

@endsection