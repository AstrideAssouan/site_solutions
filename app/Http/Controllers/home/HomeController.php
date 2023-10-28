<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use App\Models\Candidat;
use App\Models\Categorie;
use App\Models\Emploi;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index()
    {
        $emploi = Emploi::orderByDesc('id')->paginate(3);
        return view('index', ["emploi" => $emploi]);
    }

    public function indexJob()
    {
        $allJob = Emploi::all();
        return view('layouts.emploi', ["allJob" => $allJob]);
    }

    public function jobDetails($job_id)
    {
        $job = Emploi::findOrFail($job_id);
        $missions = explode(', ', $job->missions);
        $categorie = Categorie::findOrFail($job->categorie_id);
        return view('layouts.job_details', ["job" => $job, "categorie" => $categorie->libelle_cat, "missions" => $missions]);
    }

    // enregistrer les candidatures en base de données
    public function Candidature()
    {
        // Validez les données du formulaire
        $validatedData = [
            'nom' => $_POST['nom'],
            'prenom' => $_POST['prenom'],
            'email' => $_POST['email'],
            'numero' => $_POST['numero'],
            'lieu_residence' => $_POST['lieu_residence'],
            'cv_pdf' => $_POST['cv_pdf'],
            'niveau' => $_POST['niveau'],
            'emploi_id' => $_POST['emploi_id']
        ];

        // Validez le fichier CV
        if (isset($_FILES['cv_pdf']) && $_FILES['cv_pdf']['error'] === UPLOAD_ERR_OK) {
            $cvPath = 'public/cvs/' . $_FILES['cv_pdf']['name'];
            move_uploaded_file($_FILES['cv_pdf']['tmp_name'], $cvPath);
            $validatedData['cv_pdf'] = $cvPath;
        }

        // Créez la candidature
        $candidat = Candidat::create($validatedData);

        return dd($candidat);
    }
}
