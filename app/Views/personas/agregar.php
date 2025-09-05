<?= $header; ?>
<div class="container mt-2">
  <div class="my-2">
    <div class="my-2">
      <h4>registro de Personas</h4>
      <button type="button" id="toast" >Mostrar Toast</button>
    </div>
    <form action="<?=base_url('personas/guardar')?>" method="post" id="personas">
    <div class="card">
      <div class="card-header">Registrar</div>
      <div class="card-body">
        <div class="mb-2">
          <label for="">Buscar Por DNI</label><small class="d-none" id="searching">Por Favor espere .... </small>
          <div class="input-group">
              <input type="text" name="dni" id="dni" class="form-control" maxlength="8" >
              <button type="button" class="btn btn-outline-success" id="buscar-dni">Buscar</button>
          </div>
        </div>
        <div class="row g-2">

            <div class="col-md-6 mb-2">
              <label for="apellidos">Apellidos</label>
              <input type="text" class="form-control" id="apellidos" name="apellidos" > 
            </div>
            <div class="col-md-6 mb-2">
              <label for="nombres">Nombres</label>
              <input type="text" class="form-control" id="nombres" name="nombres" > 
            </div>
        </div>

        <div class="row g-2">
            <div class="col-md-4 mb-2">
              <label for="telefono">Telefono</label>
              <input type="number" class="form-control" id="telefono" name="telefono"  maxlength="9"> 
            </div>
            <div class="col-md-8 mb-2">
              <label for="direccion">Direccion</label>
              <input type="text" class="form-control" id="direccion" name="direccion" > 
            </div>
        </div>
        <div class="row g-2">
            <div class="col-md-4 mb-2">
              <label for="departamento">Departamento</label>
              <select name="departamentos" id="departamentos" class="form-select" >
                <option value="">--Seleccione--</option>
                <?php foreach($departamentos as $departamento):?>
                  <option value="<?=$departamento['iddepartamento']?>"><?=$departamento['departamento']?></option>
                <?php endforeach?>
              </select>            
            </div>
            <div class="col-md-4 mb-2">
              <label for="provincia">Provincia</label>
              <select name="provincias" id="provincias" class="form-select" >
                  <option value="">--Seleccione--</option>
              </select>            
            </div>  
            <div class="col-md-4 mb-2">
              <label for="distritos">Distrito</label>
              <select name="iddistrito" id="distritos" class="form-select" >
                  <option value="">Seleccione</option>
              </select>
            </div>
        </div>
      </div>
      <div class="card-footer text-end">
        <button class="btn btn-sm btn-outline-secondary">Cancelar</button>
        <button type="submit" class="btn btn-sm btn-primary">Guardar</button>
      </div>
    </div>
  </div>
</div>

</form>
<script>
  document.addEventListener("DOMContentLoaded", () => {
    const btnBuscar = document.querySelector("#buscar-dni");
    const apellidos = document.querySelector("#apellidos");
    const nombres = document.querySelector("#nombres");
    const telefono=document.querySelector("#telefono")
    const dni = document.querySelector("#dni");
    const buscando = document.querySelector("#searching");
    const form = document.querySelector("#personas");

    const departamentos=document.querySelector("#departamentos")
    const provincias=document.querySelector("#provincias")
    const distritos=document.querySelector("#distritos")

    function showToast(message=``){
        swal.fire({
        text:message,
        showConfirmButton:false,
        icon:'info',
        toast:true,
        position:'top-end',
        timer:3000,
        timerProgressBar:true,
        background:'#f0932b',
        iconColor:'#FFF',
        color:'#FFF'
      })
    }

    document.querySelector("#toast").addEventListener('click', () =>{
      showToast('No Encontrado')
    })

    departamentos.addEventListener('change',async()=>{
      const iddepartamento=departamentos.value

      if(!iddepartamento){
        provincias.innerHTML=`<option value=''>Seleccione</option>`
        distritos.innerHTML=`<option value=''>Seleccione</option>`
        return
      }

      try{
        const response=await fetch(`http://biblioteca.test/api/ubigeo/provincias/${iddepartamento}`,{
          method:'GET',
          headers:{'Content-Type': 'application/json'}
        })

        if(!response.ok){
          throw new Error('Error en la solicitud al servidor')
        }
        const data = await response.json()
        if(data.length){
            provincias.innerHTML=`<option value=''>Seleccione</option>`
            data.forEach(provincia => {
                provincias.innerHTML+=`<option value='${provincia.idprovincia}'>${provincia.provincia}</option>`
            });
        }
      }catch(error){
        console.error(error)
      }
    })

    provincias.addEventListener('change', async()=>{
      const idprovincia=provincias.value

      if(!idprovincia){
        distritos.innerHTML=`<option value''>Seleccione</option>`
        return
      }

      try{
        const response=await fetch(`<?= base_url()?>api/ubigeo/distritos/${idprovincia}`,{
          method:'GET',
          headers:{'Content-Type': 'application/json'}
        })

        if(!response.ok){
          throw new Error('Error en la solicitud al servidor')
        }
        const data = await response.json()
        if(data.length){
            distritos.innerHTML=`<option value=''>Seleccione</option>`
            data.forEach(distrito => {
                distritos.innerHTML+=`<option value='${distrito.iddistrito}'>${distrito.distrito}</option>`
            });
        }
      }catch(error){
        console.error(error)
      }
    })

    async function buscarAPI() {
        if (!dni.value) {
          alert('Escriba DNI');
          return;
        }

        try {
          buscando.classList.remove("d-none");

          const response = await fetch(`http://biblioteca.test/api/personas/buscardni/${dni.value}`, {
            method: 'GET',
            headers: { 'Content-type': 'application/json' }
          });

          if (!response.ok) {
            throw new Error('Error en la solicitud');
          }

          const data = await response.json();
          buscando.classList.add("d-none");

          if (data.success) {
            apellidos.value = `${data.apepaterno} ${data.apematerno}`;
            nombres.value = data.nombres;
          } else {
            apellidos.value = '';
            nombres.value = '';
            showToast("datos no encontrados"); 
          }

        } catch (error) {
          console.error(error);
          buscando.classList.add("d-none"); // para asegurarte de ocultar el loader también en caso de error
        }
      }


    dni.addEventListener('keydown',(event)=>{
      if(event.key==='Enter'){
        event.preventDefault();
        buscarAPI()
      }
    })

    btnBuscar.addEventListener("click",async()=>{
          if(!dni.value){
            alert('Escriba DNI')
            return
          }
          try{
            buscando.classList.remove("d-none")
            const response= await fetch(`http://biblioteca.test/api/personas/buscardni/${dni.value}`,{
              method:'GET',
              headers:{'Content-type':'application/json'}
            })
            if(!response.ok){
              throw new Error('Error en la solicitud')
            }
            const data= await response.json()
            buscando.classList.add("d-none")
            if(data.success){
              apellidos.value=`${data.apepaterno}${data.apematerno}`,
              nombres.value=data.nombres
            }else{
              showToast("datos no encontrados")
              apellidos.value='',
              nombres.value=''
            }
          }catch(error){
            console.log(error)
          }
    })

      form.addEventListener("submit", function (event) {
        event.preventDefault();

        Swal.fire({
          title: '¿Registrar?',
          text: 'Confirme si desea registrar la nueva área.',
          icon: 'question',
          showCancelButton: true,
          confirmButtonColor: '#0d6efd',
          cancelButtonColor: '#6c757d',
          confirmButtonText: 'Registrar',
          cancelButtonText: 'Cancelar'
        }).then((result) => {
          if (result.isConfirmed) {
            form.submit();
          }
        });//método fire
      });//evento submit

  }) // evento DOMContentLoades
</script>
<?= $footer; ?>