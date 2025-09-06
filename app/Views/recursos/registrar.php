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
        <form action="<?=base_url('recursos/guardar')?>" method="post" id="recursos">
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
                            <select  class="form-select" name="tipo" id="tipo">
                                <option value="">Seleccione</option>
                                <option value="digital">Digital</option>
                                <option value="fisico">Fisico</option>
                            </select>
                            <label for="">Seleccione Tipo</label>
                        </div>
                    </div>  
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="titulo" name="titulo">
                            <label for="">Titulo</label>
                        </div>
                    </div>            
                    <div class="col-md-3">
                        <div class="form-floating">
                            <input type="number" class="form-control" id="apublicacion" name="apublicacion">
                            <label for="">Año Publicación</label>
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-5">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="isbn" name="isbn">
                            <label for="">ISBN</label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-floating">
                            <input type="number " class="form-control" id="numpaginas" name="numpaginas">
                            <label for="">N° Paginas</label>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="rutaportada" name="rutaportada">
                            <label for="">Ruta de portada</label>
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="rutarecurso" name="rutarecurso">
                            <label for="">Ruta Recurso</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <select name="estado" id="estado" class="form-select">
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
                            <select  class="form-select" name="ideditorial" id="editorial">
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
                            <select  class="form-select" name="idcategoria" id="categoria">
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
                            <select  class="form-select" name="idsubcategoria" id="subcategoria">
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
        const categorias=document.querySelector("#categoria")
        const subcategorias=document.querySelector("#subcategoria")

        categorias.addEventListener('change', async()=>{
            const idcategoria=categoria.value

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
    })//DOMContentLoaded
</script>
<?= $footer; ?>
