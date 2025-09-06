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

}