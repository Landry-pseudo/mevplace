<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;

class Install extends Controller
{
    public function createDefaultUser()
    {
        $model = new UserModel();
        
        // Vérifier si l'utilisateur existe déjà
        $existingUser = $model->where('email', 'friendlandry08@gmail.com')->first();
        
        if (!$existingUser) {
            $userData = [
                'username' => 'landry',
                'email'    => 'friendlandry08@gmail.com',
                'password' => password_hash('1234', PASSWORD_DEFAULT),
                'bio'      => 'Vendeur et acheteur passionné sur MEV-PLACE. Je propose des articles de qualité et recherche de bonnes affaires !'
            ];
            
            if ($model->insert($userData)) {
                echo "Utilisateur Landry créé avec succès!";
            } else {
                echo "Erreur lors de la création de l'utilisateur";
            }
        } else {
            echo "L'utilisateur Landry existe déjà";
        }
    }
}