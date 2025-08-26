<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Libro;

class LibroController extends BaseController
{

  public function index(): string
  {
    $libro = new Libro();

    $datos['libros'] = $libro->orderBy('id', 'ASC')->findAll();

    //Solicitar las secciones: HEADER+FOOTER
    $datos['header'] = view('Layouts/header');
    $datos['footer'] = view('Layouts/footer');

    return view('libros/listar', $datos);
  }

  public function buscar(){
    $libro = new Libro();
    $datos['header'] = view('Layouts/header');
    $datos['footer'] = view('Layouts/footer');
    return view('libros/buscar', $datos);

  }
  public function buscarLibro(){
    //recibir un Json con los datos solicitados de la búsqueda
    //Consulta utilizando query builder en la BD.tabla
    //Retorna un Json informando el resultado de la consulta
    $libro = new Libro();
    //encabezado de la respuesta JSON
    $this->response->setContentType('application/json');
    //Leer el archivo JSON de la solicitud
    $input= $this->request->getJSON();

    //Validar si existe la clave necesaria para la consulta
    if(empty($input->id)){
      return $this->response->setJSON(
        ['success' => false,
        'mensaje' => 'Debe inicidicar el ID']);
    }
    //Leemos el id enviado
    $id = $input->id;
    //Buscamos el libro
    $registro=$libro->where('id', $id)->first();

    // NO existe el libro
    if(!$registro){
      return $this->response->setJSON([
        'success' => false,
        'mensaje' => 'No se encontraron registros']);
    }
    // Resolvemos la consulta enviando los datos del libro
    return $this->response->setJSON([
      'success' => true,
      'nombre' => $registro['nombre'],
      'imagen'=> $registro['imagen']
    ]);
  }

  public function crear(): string
  {
    $datos['header'] = view('Layouts/header');
    $datos['footer'] = view('Layouts/footer');

    return view('libros/crear', $datos);
  }

  public function editar($id = null): string
  {
    $libro = new Libro();
    $datos['libro'] = $libro->where('id', $id)->first();

    $datos['header'] = view('Layouts/header');
    $datos['footer'] = view('Layouts/footer');

    return view('libros/editar', $datos);
  }

  //Recibe los datos desde la vista y los guarda en la BD
  public function guardar() {
    $libro = new Libro();

    $validacion = $this->validate([
      'nombre'  => 'required|min_length[3]',
      'imagen'  => [
        'uploaded[imagen]',
        'mime_in[imagen,image/jpg,image/jpeg,image/png]',
        'max_size[imagen,1024]'
      ]
    ]);

    if (!$validacion){
      $session = session();
      $session->setFlashdata('mensaje', 'Revise la información');
      //return $this->response->redirect(base_url('libros/crear'));
      return redirect()->back()->withInput();
    }

    $nombre = $this->request->getVar('nombre'); //<tag name="">
    
    //Subir archivo imagen
    if ($imagen = $this->request->getFile('imagen')){
      $nuevoNombre = $imagen->getRandomName();
      $imagen->move('../public/uploads/', $nuevoNombre);

      $registro = [
        'nombre'    => $nombre,
        'imagen'    => $nuevoNombre
      ];

      $libro->insert($registro);
    }

    return $this->response->redirect(base_url('libros'));
  }

  public function borrar($id = null){
    //echo "Borrando... " . $id;
    $libro = new Libro();

    //BUscamos el nombre de la imagen
    $datosLibro = $libro->where('id', $id)->first();
    $ruta = '../public/uploads/' . $datosLibro['imagen'];
    
    //Eliminación del archivo
    if (file_exists($ruta)) { unlink($ruta); }

    //Eliminación del registro
    $libro->where('id', $id)->delete($id);

    return $this->response->redirect(base_url('libros'));
  }

  public function actualizar(){
    $libro = new Libro();

    //Se procede a actualizar únicamente los datos
    $datos = [
      'nombre'    => $this->request->getVar('nombre')
    ];

    $id = $this->request->getVar('id');

    $libro->update($id, $datos);

    $validacion = $this->validate([
      'imagen'  => [
        'uploaded[imagen]',
        'mime_in[imagen,image/jpg,image/jpeg,image/png]',
        'max_size[imagen,1024]'
      ]
    ]);

    if ($validacion){
      if ($imagen = $this->request->getFile('imagen')){
        //Eliniamos la imagen anterior
        $datosLibro = $libro->where('id', $id)->first();
        $rutaImagen = '../public/uploads/'. $datosLibro['imagen'];
        unlink($rutaImagen);


        //Agregamos la nueva imagen
        $nuevoNombre = $imagen->getRandomName();
        $imagen->move('../public/uploads/', $nuevoNombre);

        $datos = ['imagen' => $nuevoNombre];
        $libro->update($id, $datos);
      }
    }

    return $this->response->redirect(base_url('libros'));
  }

}