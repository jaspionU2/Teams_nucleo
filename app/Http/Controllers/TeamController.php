<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\createTeamRequest;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
   private $team, $request;

   public function __construct(Team $team, Request $request)
   {
      $this->team = $team;
      $this->request = $request;
   }

   public function getAll(){

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

        return $team;
   }

   public function createTeam(createTeamRequest $request)
   {
       $teamValidated = $this->team->createTeam($request);

       
   }
}
