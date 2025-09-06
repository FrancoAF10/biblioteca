<?php

namespace App\Models;
use CodeIgniter\Model;

class Recursos extends Model{

  protected $table = 'recursos';
  protected $primaryKey = "idrecurso";
  protected $allowedFields = [
                              "tipo",
                              "titulo",
                              "apublicacion",
                              "isbn",
                              "numpaginas",
                              "rutaportada",
                              "rutarecurso",
                              "estado",
                              "creado",
                              "modificado",
                              "ideditorial",
                              "idsubcategoria"];
  public function vistar_ECS(){
    $query =$this->db->query("SELECT * FROM mostrar_ecs ORDER BY idrecurso ASC");
    return $query->getResultArray();
  }
}   