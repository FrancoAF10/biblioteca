<?= $header ?>
<div class="container">
  <div class="my-2">
    <h4>Crear Editorial</h4>
    <a href="<?= base_url("editorial"); ?>">Volver</a>
  </div>

  <form method="POST" action="<?= base_url('editorial/guardar')?>" enctype="multipart/form-data">
    <div class="card">
      <div class="card-body">
        <div class="mb-2">
          <label for="nombre">Nombre del Editorial</label>
          <input type="text" class="form-control mb-2" name="nombre" id="nombre" autofocus required>
        </div>
          <div class="mb-2">
          <label for="telefono">Número de telefono</label>
          <input type="number" class="form-control mb-2" name="telefono" id="telefono" autofocus required>
        </div>
          <div class="mb-2">
          <label for="direccion">Direccion</label>
          <input type="text" class="form-control mb-2" name="direccion" id="direccion" autofocus required>
        </div>
      </div>
      <div class="card-footer text-end">
        <button type="reset" class="btn btn-sm btn-outline-secondary">Cancelar</button>
        <button type="submit" class="btn btn-sm btn-primary">Guardar</button>
      </div>
    </div>
  </form>
</div>
<?=$footer ?>