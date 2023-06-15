<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WelcomeController extends Controller
{
    public function index()
    {
        $datos = DB::select('SELECT
        (SELECT COUNT(*)
        FROM users) AS total_users,
        (SELECT COUNT(*)FROM games) AS total_games;'); // Ejecuta la consulta SQL y obtén los resultados

        return view('welcome', ['datos' => $datos]); // Retorna la vista "welcome" y pasa los datos a la misma
    }
}
