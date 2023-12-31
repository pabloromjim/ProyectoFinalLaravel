@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="profile-info">
                    <div class="profile-username">
                        {{ $user->id == $nextTurn->player_id ? "Te toca seleccionar" : "Esperando al oponente..." }}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tic-tac-toe">
                    @foreach($locations as $index => $location)
                        <input type="radio" class="player-{{ $location["checked"] ? $location["type"] : $playerType}} {{ $location["class"] }}" id="block-{{ $index }}" value="{{ $index }}" {{ $location["checked"] ? "checked" : "" }} {{ $user->id != $nextTurn->player_id ? "disabled" : "" }}>
                        <label for="block-{{ $index }}"></label>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <a href="<?=env('APP_URL')?>/public/home" id="exit-button" class="btn btn-lg btn-primary" style="display: none;">Salir de la partida</a>
            </div>
        </div>
    </div>
    {{ csrf_field() }}
@endsection

@section('scripts')
    <script language="JavaScript">

        function checkResult() {
            var win = false;
            //top row win
            if(
                $('#block-1.player-{{$playerType}}:checked').length &&
                $('#block-2.player-{{$playerType}}:checked').length &&
                $('#block-3.player-{{$playerType}}:checked').length
            ){
                win = true;
            }
            //middle row win
            else if(
                $('#block-4.player-{{$playerType}}:checked').length &&
                $('#block-5.player-{{$playerType}}:checked').length &&
                $('#block-6.player-{{$playerType}}:checked').length
            ){
                win = true;
            }
            //bottom row win
            else if(
                $('#block-7.player-{{$playerType}}:checked').length &&
                $('#block-8.player-{{$playerType}}:checked').length &&
                $('#block-9.player-{{$playerType}}:checked').length
            ){
                win = true;
            }
            //left column win
            else if(
                $('#block-1.player-{{$playerType}}:checked').length &&
                $('#block-4.player-{{$playerType}}:checked').length &&
                $('#block-7.player-{{$playerType}}:checked').length
            ){
                win = true;
            }
            //middle column win
            else if(
                $('#block-2.player-{{$playerType}}:checked').length &&
                $('#block-5.player-{{$playerType}}:checked').length &&
                $('#block-8.player-{{$playerType}}:checked').length
            ){
                win = true;
            }
            //right column win
            else if(
                $('#block-3.player-{{$playerType}}:checked').length &&
                $('#block-6.player-{{$playerType}}:checked').length &&
                $('#block-9.player-{{$playerType}}:checked').length
            ){
                win = true;
            }
            //back diagonal win
            else if(
                $('#block-1.player-{{$playerType}}:checked').length &&
                $('#block-5.player-{{$playerType}}:checked').length &&
                $('#block-9.player-{{$playerType}}:checked').length
            ){
                win = true;
            }
            //forward diagonal win
            else if(
                $('#block-3.player-{{$playerType}}:checked').length &&
                $('#block-5.player-{{$playerType}}:checked').length &&
                $('#block-7.player-{{$playerType}}:checked').length
            ){
                win = true;
            }

            if(!win){
                if($('input[type=radio]:checked').length == 9){
                    return 'tie';
                }
            } else {
                return 'win';
            }

            return false;
        }

        var pusher = new Pusher('734af0a06250095c33eb', {'cluster':'mt1'});
        var gamePlayChannel = pusher.subscribe('game-channel-{{ $id }}-{{ $otherPlayerId }}');
        var gameOverChannel = pusher.subscribe('game-over-channel-{{ $id }}-{{ $otherPlayerId }}');
        gamePlayChannel.bind('App\\Events\\Play', function(data) {
            $('#block-' + data.location).removeClass('player-{{ $playerType }}').addClass('player-' + data.type);
            $('#block-' + data.location).attr('checked', true);
            $('input[type=radio]').removeAttr('disabled');
            $('.profile-username').html("Te toca");
        });
        gameOverChannel.bind('App\\Events\\GameOver', function(data) {
            $('#block-' + data.location).removeClass('player-{{ $playerType }}').addClass('player-' + data.type);
            $('#block-' + data.location).attr('checked', true);
            if(data.result == 'win') {
                $('.profile-username').html('Has perdido...');
            } else {
                $('.profile-username').html("Empate!");
            }
            $('#exit-button').show();
        });
        $(document).ready(function () {
            $('input[type=radio]').on('click', function(){
                $('input[type=radio]').attr('disabled', true);
                var result = checkResult();
                if(!result){
                    $('.profile-username').html('Esperando a tu oponente...');
                    $.ajax({
                        url: '<?=env('APP_URL')?>/public/play/{{$nextTurn->game_id}}',
                        method: 'post',
                        data: {
                            location: $(this).val(),
                            _token: $('input[name=_token]').val()
                        },
                        success: function(data){

                        }
                    });
                } else {
                    if(result == 'win') {
                        $('.profile-username').html("Has ganado!");
                    } else {
                        $('.profile-username').html("Empate!");
                    }
                    $('#exit-button').show();
                    $.ajax({
                        url: '<?=env('APP_URL')?>/public/game-over/{{$nextTurn->game_id}}',
                        method: 'post',
                        data: {
                            location: $(this).val(),
                            result: result,
                            _token: $('input[name=_token]').val()
                        },
                        success: function(data){

                        }
                    });
                }
            });
        });
    </script>
@endsection
