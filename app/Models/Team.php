<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use app\Http\Requests\createTeamRequest;

use function PHPUnit\Framework\fileExists;

class Team extends Model
{
    private $path = 'db/teams.json';


    public function getAll()
    {
        $teams = Storage::get($this->path);
        return json_decode($teams, true);
    }

    public function getById($id)
    {
        $teamId = collect($this->getAll())->where('id', $id)->first();
        return $teamId;
    }

    public function getWithoutPlayers()
    {
        $teamWithoutPlayer = collect($this->getAll())->where('players', null);

        return $teamWithoutPlayer;
    }

    public function createTeam(createTeamRequest $request)
    {

        $validatedData = $request->validated();

        // $organizedData = [
        //     'id' => $validatedData['id'],
        //     'nameTime' => $validatedData['nameTime'],
        //     'players' => $validatedData['players'],
        //     'foundation_date' => $validatedData['foundation_date'],
        // ];

        $teams = $this->getAll();

        $teams[] = $validatedData;

        if (Storage::put($this->path, json_encode($teams))) {
            return $validatedData;
        }

        return false;
    }

    public function updateTeam($id, $updateTeam)
    {
        $teams = collect($this->getAll());

        foreach ($teams as $key => $team) {
            if ($team['id'] == $id) {
                $teams[$key] = array_merge($team, $updateTeam);
                Storage::put($this->path, json_encode($teams, true));
                return $team;
            }
        }

        return false;
    }

    public function deleteTeam($id)
    {
        $teams = collect($this->getAll());

        $team = $teams->search(fn($team) => $team['id'] == $id);

        if ($team !== false) {
            $teams->splice($team, 1);
            Storage::put($this->path, json_encode($teams->values()->all()));
            return true;
        }
        return false;
    }
}
