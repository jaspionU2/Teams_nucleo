<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\createTeamRequest;
use App\Models\Team;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;



class TeamController extends Controller
{
    private $team, $request;

    public function __construct(Team $team, Request $request)
    {
        $this->team = $team;
        $this->request = $request;
    }

    public function getAll()
    {

        return $this->team->getAll();
    }

    public function getById($id)
    {

        $team = $this->team->getById($id);

        if ($team == null) {
            return response(["message" => "Registro não encontrado!"], 404);
        }

        return $team;
    }

    public function getWithoutPlayers()
    {
        $team = $this->team->getWithoutPlayers();

        if ($team == null) {
            return response()->json(['message' => 'não existe time sem jogadores'], 200);
        }

        return  response()->json($team, 200);
    }

    public function createTeam(createTeamRequest $request)
    {
       $validatedTeam = $this->team->createTeam($request);

        if($validatedTeam !== false)
        {
            // return response()->json([
            //     'message' => 'Time criado com sucesso',
            //     'team' => $validatedTeam,
            // ], 201);

            return dd($validatedTeam);
        }


        // return response()->json([
        //     'message' => 'Erro ao gravar o time'
        // ], 500); 
          return dd($validatedTeam);
        }

        public function deleteTeam($id)
        {

           $deletedTeam = $this->team->deleteTeam($id);
             
           if($deletedTeam)
           {
             return response()->json(['message' => 'o time foi deletado com sucesso'], 200);
           }

            return response()->json(['message' => 'time não encontrado'], 404);
        }
    }

