<?php
namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'title', 'description', 'price', 'category', 'size', 
        'brand', 'condition', 'images', 'seller_id', 'status',
        'created_at', 'updated_at'
    ];
    
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    
    protected $validationRules = [
        'title' => 'required|min_length[3]|max_length[255]',
        'description' => 'required',
        'price' => 'required|decimal',
        'category' => 'required',
        'seller_id' => 'required|integer'
    ];
}