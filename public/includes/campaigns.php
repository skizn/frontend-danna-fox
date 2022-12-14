<?php

$campaigns = $em->getRepository('Models\Campaign')->findBy([], ['id' => 'DESC']);

foreach ($campaigns as $campania) {
  switch ($campania->getEstado()) {
    case 'CREADA':
      echo "
        <div class='campaign-box'>
          <div class='campaign-left'>
            <div class='icon -created'>
              <i class='bx bx-message-square-add'></i>
            </div>

            <div class='campaign-data'>
              <h3 class='title'>{$campania->getNombre()}</h3>

              <div class='campaign-tags'>
                <span class='tag'>
                  <i class='bx bx-calendar-alt'></i> {$campania->getFormattedFechaInicio()}
                </span>
                <span class='tag'>
                  <i class='bx bx-pulse'></i> {$campania->getEstado()}
                </span>
                <span class='tag'>
                  <i class='bx bx-comment'></i> {$campania->getCantidadMensajes()}
                </span>
              </div>
            </div>
          </div>

          <div class='campaign-right'>
            <span class='icon'>
              <i class='bx bx-dots-vertical-rounded'></i>
            </span>

            <div class='campaign-menu' data-campaign='{$campania->getId()}'>
              <a class='button' href='?id={$campania->getId()}' data-target='#show-campaign'>
                <i class='bx bx-show'></i> Ver
              </a>

              <a class='button' href='?id={$campania->getId()}' data-target='#edit-campaign'>
                <i class='bx bx-pencil'></i> Editar
              </a>

              <a class='button' href='./public/delete.php?id={$campania->getId()}' data-target='#home'>
                <i class='bx bx-x-circle'></i> Eliminar
              </a>
            </div>
          </div>
        </div>
      ";
      break;
    case 'EN EJECUCIÓN':
      echo "
        <div class='campaign-box'>
          <div class='campaign-left'>
            <div class='icon -executed'>
              <i class='bx bx-message-square-detail'></i>
            </div>

            <div class='campaign-data'>
              <h3 class='title'>{$campania->getNombre()}</h3>

              <div class='campaign-tags'>
                <span class='tag'>
                  <i class='bx bx-calendar-alt'></i> {$campania->getFormattedFechaInicio()}
                </span>
                <span class='tag'>
                  <i class='bx bx-pulse'></i> {$campania->getEstado()}
                </span>
                <span class='tag'>
                  <i class='bx bx-comment'></i> {$campania->getCantidadMensajes()}
                </span>
              </div>
            </div>
          </div>

          <div class='campaign-right'>
            <span class='icon'>
              <i class='bx bx-dots-vertical-rounded'></i>
            </span>

            <div class='campaign-menu' data-campaign='{$campania->getId()}'>
              <a class='button' href='?id={$campania->getId()}' data-target='#show-campaign'>
                <i class='bx bx-show'></i> Ver
              </a>

              <a class='button' href='?id={$campania->getId()}' data-target='#edit-campaign'>
                <i class='bx bx-pencil'></i> Editar
              </a>

              <a class='button' href='./public/delete.php?id={$campania->getId()}' data-target='#home'>
                <i class='bx bx-x-circle'></i> Eliminar
              </a>
            </div>
          </div>
        </div>
      ";
      break;
    case 'FINALIZADA':
      echo "
        <div class='campaign-box'>
          <div class='campaign-left'>
            <div class='icon -ended'>
              <i class='bx bx-message-square-x'></i>
            </div>

            <div class='campaign-data'>
              <h3 class='title'>{$campania->getNombre()}</h3>

              <div class='campaign-tags'>
                <span class='tag'>
                  <i class='bx bx-calendar-alt'></i> {$campania->getFormattedFechaInicio()}
                </span>
                <span class='tag'>
                  <i class='bx bx-pulse'></i> {$campania->getEstado()}
                </span>
                <span class='tag'>
                  <i class='bx bx-comment'></i> {$campania->getCantidadMensajes()}
                </span>
              </div>
            </div>
          </div>

          <div class='campaign-right'>
            <span class='icon'>
              <i class='bx bx-dots-vertical-rounded'></i>
            </span>

            <div class='campaign-menu' data-campaign='{$campania->getId()}'>
              <a class='button' href='?id={$campania->getId()}' data-target='#show-campaign'>
                <i class='bx bx-show'></i> Ver
              </a>

              <a class='button' href='?id={$campania->getId()}' data-target='#edit-campaign'>
                <i class='bx bx-pencil'></i> Editar
              </a>

              <a class='button' href='./public/delete.php?id={$campania->getId()}' data-target='#home'>
                <i class='bx bx-x-circle'></i> Eliminar
              </a>
            </div>
          </div>
        </div>
      ";
      break;
  }
}
