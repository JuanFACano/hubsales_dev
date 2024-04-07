<div class="alerta_contenedor">
  <?php
  foreach ($alertas as $key => $mensajes) :
    foreach ($mensajes as $mensaje) :
  ?>

      <div class="alerta mostrar <?php echo $key ?>">
        <?php echo $mensaje; ?>
      </div>

  <?php
    endforeach;
  endforeach;


  ?>
</div>