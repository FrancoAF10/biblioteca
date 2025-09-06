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
        $validacion = $this->validate([
        'rutaportada'  => [
        'uploaded[rutaportada]',
        'mime_in[rutaportada,image/jpg,image/jpeg,image/png]',
        'max_size[rutaportada,1024]'
        ],
        'rutarecurso' => [
        'if_exist',
        'mime_in[rutarecurso,application/pdf]',
        'max_size[rutarecurso,2048]'
        ]
        ]);

        if (!$validacion){
        $session = session();
        $session->setFlashdata('mensaje', 'Revise la información');
        return redirect()->back()->withInput();
        }    
        $imagen = $this->request->getFile('rutaportada');
        $nuevoNombre = $imagen->getRandomName();
        $imagen->move('../public/uploads/',  $nuevoNombre);

        $registro=[
            "tipo"=>$this->request->getVar('tipo'),
            "titulo"=>$this->request->getVar('titulo'),
            "apublicacion"=>$this->request->getVar('apublicacion'),
            "isbn"=>$this->request->getVar('isbn'),
            "numpaginas"=>$this->request->getVar('numpaginas'),
            "rutaportada"=>$nuevoNombre,
            "estado"=>$this->request->getVar('estado'),
            "creado"=>$this->request->getVar('creado'),
            "modificado"=>$this->request->getVar('modificado'),
            "ideditorial"=>$this->request->getVar('ideditorial'),
            "idsubcategoria"=>$this->request->getVar('idsubcategoria'),
        ];

        $rutarecurso=$this->request->getFile('rutarecurso');

        if($rutarecurso && $rutarecurso->isValid() && !$rutarecurso->hasMoved()) {
                $nombrePDF = $rutarecurso->getRandomName();
                $rutarecurso->move('../public/uploads/', $nombrePDF);
                $registro['rutarecurso'] = $nombrePDF;
        }
        $recursos->insert( $registro);
        return $this->response->redirect(base_url('/recursos'));  
    }
    public function searchById($idrecurso="")
        {
            $recursos = new Recursos();

            $recurso = $recursos->db->table('mostrar_ecs')
                        ->where('idrecurso', $idrecurso)
                        ->get()
                        ->getRowArray();

            if ($recurso) {
                return $this->response->setJSON([
                    'success' => true,
                    'tipo' => $recurso['tipo'],
                    'titulo' => $recurso['titulo'],
                    'anio' => $recurso['apublicacion'],
                    'isbn' => $recurso['isbn'],
                    'numpaginas' => $recurso['numpaginas'],
                    'rutaportada' => $recurso['rutaportada'],
                    'rutarecurso' => $recurso['rutarecurso'],
                    'estado' => $recurso['estado'],
                    'creado' => $recurso['creado'],
                    'modificado' => $recurso['modificado'],
                    'ideditorial' => $recurso['ideditorial'],
                    'idcategoria' => $recurso['idcategoria'],
                    'idsubcategoria' => $recurso['idsubcategoria']
                ]);
            } else {
                return $this->response->setJSON(['success' => false]);
            }
    }
}