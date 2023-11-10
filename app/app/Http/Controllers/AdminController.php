<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // afficher tous les roles
    public function getRole()
    {
        $data = Role::all();
        return response()->json($data);
    }

    // créer un utilisateur
    public function createAdmin(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'email' => 'required',
            'password' => 'required',
            'role' => 'required'
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);
        $roleName = $validatedData['role'];


        $emailExist = User::where("email", $validatedData['email'])->first();

        if ($emailExist) {
            return response()->json(["status" => 500, "message" => "L'email existe déjà"]);
        }
        unset($validatedData['role']);
        $user = User::create($validatedData);

        if ($user) {
            $role = Role::where('nom_role', $roleName)->first();
            if ($role) {
                $user->roles()->attach($role->id);
            }
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

    // connexion
    public function login(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $admin = User::where('email', $validatedData['email'])->first();

        if ($admin && Hash::check($validatedData['password'], $admin->password)) {
            $admin->roles->pluck('role');

            $token = $admin->createToken('authToken')->plainTextToken;

            $data = [
                "data" => $admin,
                "token" => $token,
                "status" => 200,
                "message" => "Connexion reussie !"
            ];
        } else {
            $data = [
                "status" => 500,
                "message" => "Informations de connexion incorrect"
            ];
        }

        return response()->json($data);
    }

    // déconnexion
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Vous êtes maintenant déconnecté', 'status' => 200]);
    }

    // modifier le profil
    public function editAdmin(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'email' => 'required',
            'role' => 'required'
        ]);

        $id = $request->input('id');

        $admin = User::find($id);
        $roleName = $validatedData['role'];
        unset($validatedData['role']);
        if ($admin->update($validatedData)) {

            $roles = Role::where('nom_role', $roleName)->first();
            if ($roles) {
                $admin->roles()->sync([$roles->id]); // Utilisez sync() pour synchroniser les rôles de l'utilisateur
            }

            $data = [
                "status" => 200,
                "message" => "Modification reussie !"
            ];
        } else {
            $data = [
                "status" => 500,
                "message" => "Modification échouée !"
            ];
        }

        return response()->json($data);
    }

    // afficher tous les profils
    public function indexAdmin(Request $request)
    {
        $search = $request->input('search');

        $data = User::select('*')->where(function ($query) use ($search) {
            $query->where("nom", "LIKE", "%" . $search . "%")
                ->orWhere("prenom", "LIKE", "%" . $search . "%")
                ->orWhere("email", "LIKE", "%" . $search . "%");
        })
            ->with('roles')
            ->orderByDesc('id')
            ->paginate(10);

        return response()->json($data);
    }

    // afficher un profil
    public function getAdmin(Request $request)
    {
        $admin = User::where('id', $request->input('id'))->with('roles')->with('permissions')->first();
        return response()->json($admin);
    }

    // supprimer un profil
    public function deleteAdmin(Request $request)
    {
        if (User::findOrFail($request->input('id'))->delete()) {
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

    // ajouter des permissions à un utilisateur
    public function addPermission(Request $request, $userId)
    {
        $validatedData = $request->validate([
            'permission_id' => 'required|array',
            'permission_id.*' => 'exists:permissions,id',
        ]);
        
        $user = User::findOrFail($userId);
        $check = $user->permissions()->sync($validatedData['permission_id']);
        if ($check) {
            $data = [
                'status' => 200,
                'message' => 'Permissions mise à jour !'
            ];
        } else {
            $data = [
                'status' => 500,
                'message' => 'Une erreur est survenue !'
            ];
        }

        return response()->json($data);
    }

    // afficher toutes les permissions
    public function getAllPermissions()
    {
        $permissions = Permission::all();
        return response()->json(['permissions' => $permissions]);
    }
}
