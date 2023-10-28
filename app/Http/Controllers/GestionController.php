<?php

namespace App\Http\Controllers;

use App\Models\Projet;
use Illuminate\Http\Request;

class GestionController extends Controller
{
    // créer les projets
    public function createProject(Request $request)
    {
        $validatedData = $request->validate([
            "nom_projet" => "required",
            "statut" => "required"
        ]);

        $project = Projet::create($validatedData);

        if ($project) {
            $data = [
                "status" => 200,
                "message" => "Créé avec succès"
            ];
        } else {
            $data = [
                "status" => 500,
                "message" => "Création échouée"
            ];
        }

        return response()->json($data);
    }

    // modifier un projet
    public function editProject(Request $request)
    {
        $validatedData = $request->validate([
            "nom_projet" => "required",
            "statut" => "required"
        ]);

        $projet = Projet::find($request->input('id'));

        if ($projet->update($validatedData)) {
            $data = [
                "status" => 200,
                "message" => "Modification reussie !"
            ];
        } else {
            $data = [
                "status" => 200,
                "message" => "Modification échouée !"
            ];
        }

        return response()->json($data);
    }

    // afficher tous les projets
    public function indexProject(Request $request)
    {
        $search = $request->input('search');
        $projet = Projet::select('*')->where(function ($query) use ($search) {
            $query->where('nom_projet', 'LIKE', '%' . $search . '%')
                ->orWhere('nom_projet', 'LIKE', '%' . $search . '%');
        })
            ->orderByDesc('id')
            ->paginate(10);

        return response()->json($projet);
    }

    // afficher un seul projet
    public function getProject(Request $request)
    {
        $projet = Projet::findOrFail($request->input('id'));
        return response()->json($projet);
    }

    // supprimé un projet
    public function deleteProject(Request $request)
    {
        if (Projet::findOrFail($request->input('id'))->delete()) {
            $data = [
                "status" => 200,
                "message" => "Suppression effectuée !"
            ];
        } else {
            $data = [
                "status" => 500,
                "message" => "Suppression échouée !"
            ];
        }

        return response()->json($data);
    }
}
