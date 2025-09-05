<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\Distritos;
class DistritoController extends BaseController
{
    public function getDistritosByProvincia($idprovincia=""){
      $distrito= new Distritos();
      $this->response->setContentType("application/json");
      
      $listadistritos = $distrito->where('idprovincia',$idprovincia)->findAll();
      return $this->response->setJSON($listadistritos);

    }
}
