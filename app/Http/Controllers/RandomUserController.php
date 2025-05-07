<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\User;

class RandomUserController extends Controller
{ 
    public function generar(Request $request)
    {
        try {
            $cantidad = $request->input('cantidad', 1);
    
            $response = Http::withOptions(['verify' => false])->get("https://randomuser.me/api/", [
                'results' => $cantidad,
            ]);
    
            if (!$response->successful()) {
                return response()->json(['success' => false, 'mensaje' => 'Error al obtener datos del API'], 500);
            }
    
            $usuarios = $response->json()['results'];
    
            $usuariosGenerados = collect(); 
    
            foreach ($usuarios as $user) {
                $nuevoUsuario = User::create([
                    'uuid' => $user['login']['uuid'],
                    'gender' => $user['gender'],
                    'name' => $user['name']['first'] . ' ' . $user['name']['last'],
                    'email' => $user['email'],
                    'username' => $user['login']['username'],
                    'password' => $user['login']['password'],
                    'salt' => $user['login']['salt'],
                    'md5' => $user['login']['md5'],
                    'sha1' => $user['login']['sha1'],
                    'sha256' => $user['login']['sha256'],
                    'picture' => $user['picture']['thumbnail'],
                ]);
                
                $usuariosGenerados->push($nuevoUsuario); 
            }
    
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'mensaje' => 'Error en el servidor: ' . $e->getMessage()
            ], 500);
        }
    
        return response()->json([
            'success' => true,
            'usuarios' => $usuariosGenerados->map(function ($u) {
                return [
                    'name' => $u->name,
                    'email' => $u->email,
                    'picture' => $u->picture
                ];
            })
        ]);
    }
}    
