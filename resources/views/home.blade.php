@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="panel panel-default">
                <div class="panel-body panel-account">
                    <div class="profile-picture">
                        <img src="https://www.gravatar.com/avatar/{{ md5( strtolower( trim( $user->email ) ) ) }}?d=retro&s=200" class="img-circle img-responsive" alt="user avatar">
                    </div>
                    <div class="profile-info">
                        <div class="username">{{ $user->name }}</div>
                        <div class="profile-score">Puntuacion: {{$user->score}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="panel panel-default">
                <div class="panel-body ">
                    <div class="text-right">
                        <form action="" class="form-inline" method="get">
                            <label>Busqueda:</label>
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" value="{{ request('search') }}">
                                <span class="input-group-btn">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form>
                    </div>
                    <div class="list-group d-flex flex-row">
                        @foreach($users as $opponent)
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="our-team">
                                <div class="picture">
                                    <img class="img-fluid" src="https://www.gravatar.com/avatar/{{ md5( strtolower( trim( $opponent->email ) ) ) }}?d=retro">
                                </div>
                                <div class="team-content">
                                    <h3 class="name">{{ $opponent->name }}</h3>
                                    <h4 class="title">Puntuacion:{{ $opponent->score }}</h4>
                                </div>
                                <ul class="social">
                                    <form action="<?= env('APP_URL') ?>/public/new-game" method="post">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="user_id" value="{{ $opponent->id }}">
                                        <button type="submit" class="btn btn-primary form-button">Invitar</button>
                                    </form>
                                </ul>
                            </div>
                        </div>

                        @endforeach
                    </div>
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</div>



</div>
<div class="modal fade" id="new-game-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" aria-label="Close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Invitacion de juego</h4>
            </div>
            <div class="modal-body">
                <p><span id="from"></span> te ha invitado a jugar.</p>
            </div>
            <div class="modal-footer">

                <button class="btn btn-primary" id="play-button" type="button">Unirse</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<form action="<?= env('APP_URL') ?>/public/play" id="new-game-form" method="get">
    {{ csrf_field() }}
</form>

@endsection

@section('scripts')
<script language="javascript">
    var pusher = new Pusher('734af0a06250095c33eb', {
        'cluster': 'mt1'
    });
    var gamePlayChannel = pusher.subscribe('new-game-channel');
    gamePlayChannel.bind('App\\Events\\NewGame', function(data) {
        if (data.destinationUserId == '{{ $user->id }}') {
            $('#from').html(data.from);
            $('#new-game-form').attr('action', '<?= env('APP_URL') ?>/public/board/' + data.gameId);
            $('#new-game-modal').modal('show');
        }
    });
    $('#play-button').on('click', function() {
        $('#new-game-form').submit();
    });
</script>
@endsection