@extends('dashboard.layouts.app')

@section('page-links')

@endsection

@section('content_title')
    Visualizar enquetes
@endsection

@section('content_header')
    <li><a href="/admin/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Visualizar enquetes</li>
@endsection

@section('main-content')
<div class="row">
    <div class="col-md-5">
        <div class="box box-primary">
            <div class="box-body box-profile">

                <h3 class="profile-username text-center">{{ $poll->title }}</h3>

                <p class="text-muted text-center">Criador: {{ $poll->user()->get()[0]->name }}</p>

                <ul class="list-group list-group-unbordered">
                    @foreach ($poll->options()->get() as $option)
                        <li class="list-group-item">
                            <b>{{ $option->name }}</b> <a class="pull-right">{{ $option->vote_count }}</a>
                        </li>
                    @endforeach
                </ul>
                @if($poll->status == "Aberta")
                    <form method="POST" action="{{route('poll_close', ['poll' => $poll->id])}}" id="closePollForm">
                        {{ csrf_field() }}
                        <a class="btn btn-danger btn-block" id="closePollButton"><b>Encerrar enquete</b></a>
                    </form>
                @else
                    <a class="btn btn-danger btn-block" disabled><b>Enquete encerrada!</b></a>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-7">
        <div class="box box-success">
            <div class="box-body">
              <div class="chart">
                <canvas id="pollChart" width="400" height="200%" poll-id="{{ $poll->id }}" data="{{$poll->options()->get()}}"></canvas>
              </div>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
</div>

@endsection
@section('page-scripts')
<script>
var ctx = document.getElementById("pollChart").getContext('2d');
var data = $('#pollChart').attr('data');
var myBarChart = new Chart(ctx, {
    type: 'bar',
    data: data,
    options: options
});

//axios.get(admin/polls/getPollOptions)

</script>
    <script>

        $('#closePollButton').on('click', function(){
            jConfirm.confirm('Você tem certeza de encerrar esta enquete?', function(confirm){
                if(confirm){
                    $('#closePollForm').submit();
                }
            })
        });
    </script>
@endsection