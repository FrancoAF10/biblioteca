<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\Persona;
use App\Models\Departamentos;


class PersonaController extends BaseController
{
    public function index()
    {
    $persona=new Persona();
    $datos['personas']=$persona->orderBy('idpersona','ASC')->findAll();
    $datos['header'] = view('Layouts/header');
    $datos['footer'] = view('Layouts/footer');
    return view('personas/index', $datos);
    }
    public function crear(){
      $departamentos=new Departamentos();
      $datos['departamentos']=$departamentos->orderBy('departamento','ASC')->findAll();
      $datos['header'] = view('Layouts/header');
      $datos['footer'] = view('Layouts/footer');

      return view('personas/agregar', $datos);
    }

    public function searchByDni($dni=""){
      $api_endpoint="https://api.decolecta.com/v1/reniec/dni?numero=" . $dni;
      $api_token="sk_10065.4weVU7el7GQzWAW1tsOf4MAVecO9i2ee";
      $content_type="application/json";

      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $api_endpoint);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
      curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Content-Type:". $content_type,
        "Authorization: Bearer " . $api_token
      ]);

      //ejecutar la peticion
      $api_response = curl_exec($ch);
      $http_code=curl_getinfo($ch, CURLINFO_HTTP_CODE);
      curl_close($ch);

      if($api_response===false){
        return $this->response->setJSON([
          'success' => false,
          'mensaje' => 'Error en la conexión a la API'
        ]);
      }
      //Decodificar la respuesta JSON
      $decoded_response=json_decode($api_response,true);
      if($http_code===404){
        return $this->response->setJSON([
          'success' => false,
          'mensaje' => 'No se encontraro a la persona'
        ]);
      }
      return $this->response->setJSON([
        'success' => true,
        'apepaterno' =>  $decoded_response['first_last_name'],
        'apematerno' =>  $decoded_response['second_last_name'],
        'nombres' => $decoded_response['first_name']
      ]);
    }
    public function guardar(){
      $persona=new Persona();
      $datos=[
        "dni"=>$this->request->getVar('dni'),
        "apellidos"=>$this->request->getVar('apellidos'),
        "nombres"=>$this->request->getVar('nombres'),
        "telefono"=>$this->request->getVar('telefono'),
        "direccion"=>$this->request->getVar('direccion'),
        "iddistrito"=>$this->request->getVar('iddistrito')
      ];
      $persona->insert($datos);
      return $this->response->redirect(base_url('/personas'));  
    }
}