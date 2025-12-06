<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    
    // Esto corrige el error de "productos no existe"
    protected $table = 'products'; 
    
    protected $fillable = [
        'name', 
        'stock', 
        'price', 
        'category_id'
    ]; 
}