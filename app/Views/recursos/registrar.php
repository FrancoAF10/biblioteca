<?= $header; ?>
<div class="container mt-2">
    <div class="my-2">
        <div class="my-2">
            <h4>Registrar de Recursos</h4>
        </div>
        <div>
            <a href="<?=base_url('recursos')?>">Volver</a>
        </div>
        <br>
        <form method="POST" action="<?=base_url('recursos/guardar')?>"  id="recursos" enctype="multipart/form-data">
            <div class="card">
            <div class="card-header">Registrar</div>
            <div class="card-body">
                <div class="mb-2">
                    <div class="input-group ">
                        <div class="form-floating">
                            <input type="number" name="idrecurso" id="idrecurso" class="form-control">
                            <label for="">Buscar Por ID</label><small class="d-none" id="searching"> Por Favor espere .... </small>
                        </div>
                        <button type="button" class="btn btn-outline-success" id="buscar-id">Buscar</button>
                </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-floating">
                            <select  class="form-select" name="tipo" id="tipo" required>
                                <option value="">Seleccione</option>
                                <option value="digital">Digital</option>
                                <option value="fisico">Fisico</option>
                            </select>
                            <label for="">Seleccione Tipo</label>
                        </div>
                    </div>  
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="titulo" name="titulo" required>
                            <label for="">Titulo</label>
                        </div>
                    </div>            
                    <div class="col-md-3">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="apublicacion" name="apublicacion" maxlength="4" pattern="^[0-9]{4}$" required>
                            <label for="">Año Publicación</label>
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-5">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="isbn" name="isbn" maxlength="17" pattern="^[0-9\-]{17}$" required>
                            <label for="">ISBN</label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-floating">
                            <input type="number" class="form-control" id="numpaginas" name="numpaginas" required>
                            <label for="">N° Paginas</label>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-floating">
                        <input type="file" class="form-control" name="rutaportada" id="rutaportada" required>
                            <label for="rutaportada">Ruta de portada</label>
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-6">
                        <div class="form-floating">
                        <input type="file" class="form-control" id="rutarecurso" name="rutarecurso" accept="application/pdf" required>
                        <label for="">Ruta Recurso</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <select name="estado" id="estado" class="form-select" required>
                                <option value="">Seleccione</option>
                                <option value="bueno">Bueno</option>
                                <option value="regular">Regular</option>
                                <option value="malo">Malo</option>
                            </select>
                            <label for="">Estado</label>
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="date" class="form-control" id="creado" name="creado" required>
                            <label for="">Creado</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="date" class="form-control" id="modificado" name="modificado">
                            <label for="">Modificado</label>
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-4">
                        <div class="form-floating">
                            <select  class="form-select" name="ideditorial" id="editorial" required>
                                <option value="">Seleccione</option>
                                <?php foreach($editoriales as $editorial):?>
                                    <option value="<?=$editorial['ideditorial']?>"><?=$editorial['editorial']?> (<?=$editorial['nacionalidad']?>)</option>
                                <?php endforeach;?>
                            </select>
                            <label for="">Editorial</label>
                        </div>
                    </div>  
                    <div class="col-md-4">
                        <div class="form-floating">
                            <select  class="form-select" name="idcategoria" id="categoria" required>
                                <option value="">Seleccione</option>
                                    <?php foreach($categorias as $categoria):?>
                                        <option value="<?=$categoria['idcategoria']?>"><?=$categoria['categoria']?></option>
                                <?php endforeach;?>
                            </select>
                            <label for="">Categoria</label>
                        </div>
                    </div>  
                    <div class="col-md-4">
                        <div class="form-floating">
                            <select  class="form-select" name="idsubcategoria" id="subcategoria" required>
                                <option value="">Seleccione</option>
                            </select>
                            <label for="">Subcategoria</label>
                        </div>
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
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded',()=>{
        const idrecurso= document.querySelector("#idrecurso");
        const titulo= document.querySelector("#titulo");
        const numpaginas= document.querySelector("#numpaginas");
        const categorias=document.querySelector("#categoria")
        const subcategorias=document.querySelector("#subcategoria")
        const tipo=document.querySelector("#tipo")
        const anio = document.querySelector("#apublicacion")
        const rutarecurso=document.querySelector("#rutarecurso")
        const estado=document.querySelector("#estado")
        const isbn = document.querySelector("#isbn")

        const buscando = document.querySelector("#searching");
        const buscar=document.querySelector("#buscar-id")
        const form=document.querySelector("#recursos")

        //mensaje del toast
        function showToast(message=``){
            Swal.fire({
            text:message,
            showConfirmButton:false,
            icon:'info',
            toast:true,
            position:'top-end',
            timer:3000,
            timerProgressBar:true,
            background:'#ff5f00',
            iconColor:'#FFF',
            color:'#FFF'
        })
        }

        isbn.addEventListener("input", () => {
            isbn.value = isbn.value.replace(/[^0-9-]/g, ""); // elimina lo que no sea número o guion
            if (isbn.value.length > 17) {
                isbn.value = isbn.value.slice(0, 17); // solo deja ingresar 17 caracteres
            }
        });


        //para que el ingreso sea solo números
        anio.addEventListener("input", () => {
        anio.value = anio.value.replace(/\D/g, ""); //para que no admina letras(elimina)    
        anio.value = anio.value.slice(0, 4); 
        });

        tipo.addEventListener("change",()=>{
            if(tipo.value==="digital"){
                rutarecurso.disabled=false
            }else if(tipo.value==="fisico"){
                rutarecurso.disabled=true
                rutarecurso.value=""
            }else{
                rutarecurso.disabled=true,
                rutarecurso.value=""
            }
        })//tipo/dependiendo del select seleccionado(fisico-digital)

        //Para que inicie bloqueado al entrar o recargar la pagina
        if(tipo.value==="" || tipo.value==="fisico"){
            rutarecurso.disabled=true
            rutarecurso.value=""
        }else{
            rutarecurso.disabled=false
        }

        async function buscarID() {
            if (!idrecurso.value) {
            alert('Escriba ID');
            return;
            }

            try {
            buscando.classList.remove("d-none");

            const response = await fetch(`http://biblioteca.test/api/recursos/buscarId/${idrecurso.value}`, {
                method: 'GET',
                headers: { 'Content-type': 'application/json' }
            });

            if (!response.ok) {
                throw new Error('Error en la solicitud');
            }

            const data = await response.json();
            buscando.classList.add("d-none");

            if (data.success) {
                tipo.value = data.tipo;
                titulo.value = data.titulo;
                apublicacion.value = data.anio;
                isbn.value = data.isbn;
                numpaginas.value = data.numpaginas;
                estado.value = data.estado;
                creado.value = data.creado;
                editorial.value = data.ideditorial;
                categoria.value = data.idcategoria;
                if(categoria.value){
                    try {
                        const responseSub = await fetch(`<?= base_url()?>api/subcategoria/${categoria.value}`);
                        const subData = await responseSub.json();
                        subcategorias.innerHTML = `<option value=''>Seleccione</option>`;
                        subData.forEach(subc => {
                            subcategorias.innerHTML += `<option value='${subc.idsubcategoria}'>${subc.subcategoria}</option>`;
                        });
                        // asignamos la subcategoría del recurso
                        if(data.idsubcategoria){
                            subcategorias.value = data.idsubcategoria;
                        }
                    } catch (error) {
                        console.error(error);
                        showToast("Error cargando subcategorías");
                    }
                }
            } else {
                tipo.value = "";
                titulo.value = "";
                apublicacion.value = "";
                isbn.value = "";
                numpaginas.value ="";
                rutaportada.value = "";
                rutarecurso.value = "";
                estado.value = "";
                creado.value = "";
                editorial.value ="";
                categoria.value = "";
                subcategoria.value = "";
                showToast("Recurso no encontrado"); 
            }

            } catch (error) {
                console.error(error);
                buscando.classList.add("d-none"); // para asegurarte de ocultar el loader también en caso de error
            }
       }


        buscar.addEventListener("click",buscarID)

        categorias.addEventListener('change', async()=>{
            const idcategoria=categorias.value

            if(!idcategoria){
                subcategorias.innerHTML=`<option value''>Seleccione</option>`
                return
            }

            try{
                const response=await fetch(`<?= base_url()?>api/subcategoria/${idcategoria}`,{
                method:'GET',
                headers:{'Content-Type': 'application/json'}
                })

                if(!response.ok){
                    throw new Error('Error en la solicitud al servidor')
                }

                const data = await response.json()
                if(data.length){
                    subcategorias.innerHTML=`<option value=''>Seleccione</option>`
                    data.forEach(subcategoria => {
                        subcategorias.innerHTML+=`<option value='${subcategoria.idsubcategoria}'>${subcategoria.subcategoria}</option>`
                    });
                }
            }catch(error){
                console.error(error)
            }
        })//categoria
        
        //para confirmar el registro de una nueva inserción de datos
      form.addEventListener("submit", function (event) {
        event.preventDefault();

        Swal.fire({
          title: '¿Registrar?',
          text: 'Confirme si desea registrar el nuevo recurso',
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
    })//DOMContentLoaded
</script>
<?= $footer; ?>
