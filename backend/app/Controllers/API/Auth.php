<?php
namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use App\Models\UserModel;
use Config\Services;

class Auth extends ResourceController
{
    protected $model;
    protected $validation;
    
    public function __construct()
    {
        $this->model = new UserModel();
        $this->validation = Services::validation();
    }
    
    public function register()
    {
        // Règles de validation
        $rules = [
            'username' => 'required|min_length[3]|max_length[100]|is_unique[users.username]',
            'email'    => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]'
        ];
        
        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }
        
        $data = [
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT)
        ];
        
        try {
            $userId = $this->model->insert($data);
            
            if ($userId) {
                return $this->respond([
                    'status' => 'success',
                    'message' => 'Utilisateur créé avec succès',
                    'data' => [
                        'user_id' => $userId
                    ]
                ]);
            } else {
                return $this->fail('Erreur lors de la création du compte');
            }
        } catch (\Exception $e) {
            return $this->fail('Erreur serveur: ' . $e->getMessage());
        }
    }
    
    // public function login()
    // {
    //     $rules = [
    //         'email'    => 'required|valid_email',
    //         'password' => 'required'
    //     ];
        
    //     if (!$this->validate($rules)) {
    //         return $this->failValidationErrors($this->validator->getErrors());
    //     }
        
    //     $email = $this->request->getPost('email');
    //     $password = $this->request->getPost('password');
        
    //     $user = $this->model->where('email', $email)->first();
        
    //     if ($user && password_verify($password, $user['password'])) {
    //         // Générer un token (simplifié pour l'exemple)
    //         $token = bin2hex(random_bytes(32));
            
    //         // Enregistrer le token en session
    //         session()->set([
    //             'user_id' => $user['id'],
    //             'username' => $user['username'],
    //             'email' => $user['email'],
    //             'token' => $token
    //         ]);
            
    //         return $this->respond([
    //             'status' => 'success',
    //             'message' => 'Connexion réussie',
    //             'data' => [
    //                 'user' => [
    //                     'id' => $user['id'],
    //                     'username' => $user['username'],
    //                     'email' => $user['email']
    //                 ],
    //                 'token' => $token
    //             ]
    //         ]);
    //     }
        
    //     return $this->failUnauthorized('Email ou mot de passe incorrect');
    // }

    public function login()
    {
        // Vérifier que c'est une requête POST
        if ($this->request->getMethod() !== 'post') {
            return $this->fail('Méthode non autorisée', 405);
        }
        
        $rules = [
            'email'    => 'required|valid_email',
            'password' => 'required'
        ];
        
        $messages = [
            'email' => [
                'required' => 'L\'email est requis.',
                'valid_email' => 'Veuillez fournir un email valide.'
            ],
            'password' => [
                'required' => 'Le mot de passe est requis.'
            ]
        ];
        
        if (!$this->validate($rules, $messages)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }
        
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        
        // Debug logging
        log_message('info', 'Login attempt for email: ' . $email);
        
        $user = $this->model->where('email', $email)->first();
        
        if (!$user) {
            log_message('warning', 'User not found: ' . $email);
            return $this->failUnauthorized('Email ou mot de passe incorrect');
        }
        
        // Debug logging
        log_message('info', 'User found: ' . $user['email']);
        log_message('info', 'Password verification: ' . (password_verify($password, $user['password']) ? 'success' : 'failed'));
        
        if ($user && password_verify($password, $user['password'])) {
            // Générer un token
            $token = bin2hex(random_bytes(32));
            
            // Mettre à jour le last_login
            $this->model->update($user['id'], ['last_login' => date('Y-m-d H:i:s')]);
            
            // Enregistrer en session
            session()->set([
                'user_id' => $user['id'],
                'username' => $user['username'],
                'email' => $user['email'],
                'token' => $token,
                'logged_in' => true
            ]);
            
            // Préparer la réponse utilisateur
            $userResponse = [
                'id' => $user['id'],
                'username' => $user['username'],
                'email' => $user['email']
            ];
            
            // Ajouter bio si elle existe
            if (isset($user['bio'])) {
                $userResponse['bio'] = $user['bio'];
            }
            
            log_message('info', 'Login successful for user: ' . $user['email']);
            
            return $this->respond([
                'success' => true,
                'message' => 'Connexion réussie',
                'user' => $userResponse,
                'token' => $token
            ]);
        }
        
        log_message('warning', 'Login failed for user: ' . $email);
        return $this->failUnauthorized('Email ou mot de passe incorrect');
    }
    
    public function logout()
    {
        session()->destroy();
        return $this->respond([
            'status' => 'success',
            'message' => 'Déconnexion réussie'
        ]);
    }
    
    public function checkAuth()
    {
        $userId = session()->get('user_id');
        
        if ($userId) {
            $user = $this->model->find($userId);
            return $this->respond([
                'status' => 'success',
                'data' => [
                    'user' => [
                        'id' => $user['id'],
                        'username' => $user['username'],
                        'email' => $user['email']
                    ]
                ]
            ]);
        }
        
        return $this->failUnauthorized('Non authentifié');
    }
}