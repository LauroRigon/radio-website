<div class="col-md-3 pull-right">
    <div class="row">
        @if(isset($polls))
            @foreach($polls as $poll)
                <poll get-poll-api="{{ route('poll_get', $poll->id) }}" send-option-api="{{ route('add_vote', $poll->id) }}"></poll>
            @endforeach
            <div class="panel panel-default poll">
                <div class="panel-heading">
                    <i class="fa fa-thumbs-o-up"></i> Redes sociais
                </div>
                <div class="panel-body">
                    <div class="social-icons">
                        <a href="#"><span class="fa fa-facebook-square facebook-icon"></span></a>
                        <a href="#"><span class="fa fa-twitter-square twitter-icon"></span></a>
                    </div>
                </div>
            </div>
        @endif
        @foreach($supporters as $supporter)
            @if($supporter->side == 'right')
                <div class="panel panel-default poll">
                    <div class="panel-heading">
                        <i class="fa fa-edit"></i> {{ $supporter->name }}
                    </div>
                    <div class="panel-body">
                        <a target="_blank" href="{{ $supporter->link }}"><img src="{{ $supporter->image }}" width="100%"></a>
                    </div>
                    @if($supporter->link)
                        <div class="panel-footer">
                            <a target="_blank" href="{{ $supporter->link }}">Saiba mais</a>
                        </div>
                    @endif
                </div>
            @endif
        @endforeach
    </div>
</div>