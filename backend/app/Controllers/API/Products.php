<?php
namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use App\Models\ProductModel;

class Products extends ResourceController
{
    protected $model;
    
    public function __construct()
    {
        $this->model = new ProductModel();
    }
    
    public function index()
    {
        // Récupérer tous les produits disponibles
        $products = $this->model->select('products.*, users.username as seller_name')
                               ->join('users', 'users.id = products.seller_id')
                               ->where('products.status', 'available')
                               ->orderBy('products.created_at', 'DESC')
                               ->findAll();
        
        return $this->respond([
            'status' => 'success',
            'data' => [
                'products' => $products
            ]
        ]);
    }
    
    public function show($id = null)
    {
        $product = $this->model->select('products.*, users.username as seller_name, users.bio as seller_bio')
                              ->join('users', 'users.id = products.seller_id')
                              ->where('products.id', $id)
                              ->first();
        
        if (!$product) {
            return $this->failNotFound('Produit non trouvé');
        }
        
        return $this->respond([
            'status' => 'success',
            'data' => [
                'product' => $product
            ]
        ]);
    }
    
    public function create()
    {
        // Vérifier l'authentification
        if (!session()->get('user_id')) {
            return $this->failUnauthorized('Authentification requise');
        }
        
        $rules = [
            'title' => 'required|min_length[3]|max_length[255]',
            'description' => 'required',
            'price' => 'required|decimal',
            'category' => 'required'
        ];
        
        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }
        
        $data = [
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'price' => $this->request->getPost('price'),
            'category' => $this->request->getPost('category'),
            'size' => $this->request->getPost('size'),
            'brand' => $this->request->getPost('brand'),
            'condition' => $this->request->getPost('condition') ?? 'good',
            'seller_id' => session()->get('user_id'),
            'images' => json_encode($this->request->getPost('images') ?? [])
        ];
        
        try {
            $productId = $this->model->insert($data);
            
            if ($productId) {
                return $this->respondCreated([
                    'status' => 'success',
                    'message' => 'Produit créé avec succès',
                    'data' => [
                        'product_id' => $productId
                    ]
                ]);
            } else {
                return $this->fail('Erreur lors de la création du produit');
            }
        } catch (\Exception $e) {
            return $this->fail('Erreur serveur: ' . $e->getMessage());
        }
    }
    
    public function byCategory($category)
    {
        $products = $this->model->select('products.*, users.username as seller_name')
                               ->join('users', 'users.id = products.seller_id')
                               ->where('products.category', $category)
                               ->where('products.status', 'available')
                               ->orderBy('products.created_at', 'DESC')
                               ->findAll();
        
        return $this->respond([
            'status' => 'success',
            'data' => [
                'products' => $products
            ]
        ]);
    }
}