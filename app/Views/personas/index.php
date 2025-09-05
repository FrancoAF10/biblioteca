<?= $header; ?>
<div class="container mt-2">
  <div class="my-2">
    <h4>Lista de Personas</h4>
    <a href="<?=base_url('personas/crear')?>" class="btn btn-sm btn-info">crear</a>
  <div class="table-responsive">
    <table class="table table-sm table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>DNI</th>
          <th>Apellidos</th>
          <th>Nombres</th>
          <th>Telefono</th>
          <th>Direccion</th>
          <th>ubigeo</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($personas as $persona): ?>
            <tr>
              <td><?=$persona['idpersona']?></td>
              <td><?=$persona['dni']?></td>
              <td><?=$persona['apellidos']?></td>
              <td><?=$persona['nombres']?></td>
              <td><?=$persona['telefono']?></td>
              <td><?=$persona['direccion']?></td>
              <td><?=$persona['iddistrito']?></td>
              <td>
                <a href="#">Editar</a>
                <a href="#">Crear</a>
              </td>
            </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
  </div>
</div>
<script>
  document.addEventListener("DOMContentLoaded", () => {
    
  })
</script>
<?= $footer; ?>