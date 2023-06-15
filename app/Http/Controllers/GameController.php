<?php

namespace App\Http\Controllers;

use App\Events\GameOver;
use App\Events\Play;
use App\Game;
use App\Turn;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function board(Request $request, $id)
    {
        // Si la partida esta terminada redirige
        if (Game::find($id)->end_date != null) {
            return redirect('/home');
        }


        $user = $request->user();
        $players = Turn::where('game_id', '=', $id)->select('player_id', 'type')->distinct()->get();
        $playerType = $user->id == $players[0]->player_id ? $players[0]->type : $players[1]->type;
        $otherPlayerId = $user->id == $players[0]->player_id ? $players[1]->player_id : $players[0]->player_id;
        
        // Coge la id y obtiene turnos pasados
        $pastTurns = Turn::where('game_id', '=', $id)->whereNotNull('location')->orderBy('id')->get();
        //Coge la id para el siguiente turno
        $nextTurn = Turn::where('game_id', '=', $id)->whereNull('location')->orderBy('id')->first();
         // Set class names for each square and checked or not
        $locations = [
            1 => [
                "class" => "top left",
                "checked" => false,
                "type" => ""
            ],
            2 => [
                "class" => "top middle",
                "checked" => false,
                "type" => ""
            ],
            3 => [
                "class" => "top right",
                "checked" => false,
                "type" => ""
            ],
            4 => [
                "class" => "center left",
                "checked" => false,
                "type" => ""
            ],
            5 => [
                "class" => "center middle",
                "checked" => false,
                "type" => ""
            ],
            6 => [
                "class" => "center right",
                "checked" => false,
                "type" => ""
            ],
            7 => [
                "class" => "bottom left",
                "checked" => false,
                "type" => ""
            ],
            8 => [
                "class" => "bottom middle",
                "checked" => false,
                "type" => ""
            ],
            9 => [
                "class" => "bottom right",
                "checked" => false,
                "type" => ""
            ]
        ];
         //Actualiza partes de tablero del 3 en raya
        foreach ($pastTurns as $pastTurn) {
            $locations[$pastTurn->location]["checked"] = true;
            $locations[$pastTurn->location]["type"] = $pastTurn->type;
        }
        return view('board', compact('user', 'id', 'nextTurn', 'locations', 'playerType', 'otherPlayerId'));
    }

    public function play(Request $request, $id)
    {
        $user = $request->user();
        $location = $request->get('location');
        //Guarda el turno de ese jugador
        $turn = Turn::where('game_id', '=', $id)->whereNull('location')->orderBy('id')->first();
        $turn->location = $location;
        $turn->save();

        event(new Play($id, $turn->type, $location, $user->id));
        return response()->json(["status" => "success", "data" => "Saved"]);
    }

    public function gameOver(Request $request, $id)
    {
        $user = $request->user();
        $location = $request->get('location');
          //Guarda el turno de ese jugador
        $turn = Turn::where('game_id', '=', $id)->whereNull('location')->orderBy('id')->first();
        $turn->location = $location;
        $turn->save();
        if ($request->result == "win") {
            $user->score++;
            $user->save();
        }
        $game = Game::find($id);
        $game->end_date = date("Y-m-d H:i:s");
        $game->winner_id=$user->id;
        $game->save();

        //Emite evento al oponente de que se ha acabado
        event(new GameOver($id, $user->id, $request->get('result'), $location, $turn->type));
        return response()->json(["status" => "success", "data" => "Saved"]);
    }
}
