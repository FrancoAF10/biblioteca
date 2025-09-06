<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\Subcategorias;
class SubcategoriaController extends BaseController
{
    public function getSubcategoriasByCategoria($idcategoria=""){
        $subcategorias= new Subcategorias();
        $this->response->setContentType("application/json");
      
      $listasubcategorias = $subcategorias->where('idcategoria',$idcategoria)->findAll();
        return $this->response->setJSON($listasubcategorias);

    }
}
