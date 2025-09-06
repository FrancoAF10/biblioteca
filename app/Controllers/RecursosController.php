<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\Categoria;
use App\Models\Editoriales;
use App\Models\Recursos;



class RecursosController extends BaseController
{
    public function index()
    {
    $recursos=new Recursos();
    $datos['recursos']=$recursos->vistar_ECS();
    $datos['header'] = view('Layouts/header');
    $datos['footer'] = view('Layouts/footer');
    return view('recursos/index', $datos);
    }
    public function crear()
    {
        $editoriales=new Editoriales();
        $categorias=new Categoria();
        $datos['editoriales']=$editoriales->orderBy('editorial','ASC')->findAll();
        $datos['categorias']=$categorias->orderBy('categoria','ASC')->findAll();
        $datos['header'] = view('Layouts/header');
        $datos['footer'] = view('Layouts/footer');
        return view('recursos/registrar', $datos);
    }
    public function guardar(){
      $recursos=new Recursos();
      $datos=[
        "tipo"=>$this->request->getVar('tipo'),
        "titulo"=>$this->request->getVar('titulo'),
        "apublicacion"=>$this->request->getVar('apublicacion'),
        "isbn"=>$this->request->getVar('isbn'),
        "numpaginas"=>$this->request->getVar('numpaginas'),
        "rutaportada"=>$this->request->getVar('rutaportada'),
        "rutarecurso"=>$this->request->getVar('rutarecurso'),
        "estado"=>$this->request->getVar('estado'),
        "creado"=>$this->request->getVar('creado'),
        "modificado"=>$this->request->getVar('modificado'),
        "ideditorial"=>$this->request->getVar('ideditorial'),
        "idsubcategoria"=>$this->request->getVar('idsubcategoria'),
      ];
      $recursos->insert($datos);
      return $this->response->redirect(base_url('/recursos'));  
    }

}