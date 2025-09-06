<?= $header; ?>
<div class="container mt-2">
  <div class="my-2">
    <h4>Lista de Recursos</h4>
    <a href="<?=base_url('recursos/registrar')?>" class="btn btn-sm btn-info">Registrar</a>
    <br>
    <br>
  <div class="table-responsive">
    <table class="table table-sm table-striped table-bordered w-100">
        <colgroup>
            <col style="width: 5%;">
            <col style="width: 10%;">
            <col style="width: 10%;">
            <col style="width: 10%;">
            <col style="width: 15%;">
            <col style="width: 10%;">
            <col style="width: 10%;">
            <col style="width: 10%;">
            <col style="width: 10%;">
            <col style="width: 5%;">
            <col style="width: 5%;">
        </colgroup>
      <thead>
        <tr>
          <th>ID</th>
          <th>TIPO</th>
          <th>TITULO</th>
          <th>AÑO PUBLICACION</th>
          <th>ISBN</th>
          <th>N° PAGINAS</th>
          <th>RUTA PORTADA</th>
          <th>RUTA RECURSOS</th>
          <th>ESTADO</th>
          <th>CREADO</th>
          <th>CATEGORIA</th>
          <th>SUBCATEGORIA</th>
          <th>EDITORIAL</th>
          <th>NACIONALIDAD</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($recursos as $recurso) :?>
            <tr>
                <td><?=$recurso['idrecurso']?></td>
                <td><?=$recurso['tipo']?></td>
                <td><?=$recurso['titulo']?></td>
                <td><?=$recurso['apublicacion']?></td>
                <td><?=$recurso['isbn']?></td>
                <td><?=$recurso['numpaginas']?></td>
                <td><?=$recurso['rutaportada']?></td>
                <td><?=$recurso['rutarecurso']?></td>
                <td><?=$recurso['estado']?></td>
                <td><?=$recurso['creado']?></td>
                <td><?=$recurso['categoria']?></td>
                <td><?=$recurso['subcategoria']?></td>
                <td><?=$recurso['editorial']?></td>
                <td><?=$recurso['nacionalidad']?></td>
            </tr>
        <?php endforeach ;?>
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