<?php

namespace App\Models;
use CodeIgniter\Model;

class Subcategorias extends Model{

  protected $table = 'subcategorias';
  protected $primaryKey = "idsubcategoria";
  protected $allowedFields = [
                              "subcategoria",
                              "idcategoria"];
}   