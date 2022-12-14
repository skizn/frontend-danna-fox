<?php

require(__DIR__ . '/../../vendor/autoload.php');  
$dotenv = Dotenv\Dotenv::createImmutable('../');
$dotenv->load();
require(__DIR__ . '/../../config/bootstrap.php');

$em = GetEntityManager();

$localidades = $em->getRepository('Models\Locality')->findAll();
$cantidadCampanias = $em->getRepository('Models\Campaign')->count([]);

$cantidadUsuarios = $em->getRepository('Models\User')->count([]);
$user = isset($_GET['id']) ? $em->getRepository('Models\User')->find($_GET['id']) : null;

$campaign = isset($_GET['id']) ? $em->getRepository('Models\Campaign')->find($_GET['id']) : null;
$client = $campaign ? $campaign->getCliente() : null;
$localidadesCampania = $campaign ? $campaign->getLocalidades() : null;
$idLocalidadesCampania = [];

if (isset($localidadesCampania)) {
  foreach ($localidadesCampania as $localidadCampania) {
    array_push($idLocalidadesCampania, $localidadCampania->getId());
  }
}


?>


<!-- Home -->
<div class="content-box -active" id="home">

  <div class="content-header">
    <h2 class="title">Campañas Actuales</h2>
    <!-- TODO: Insertar cantidad dinamicamente -->
    <span class="quantity"><?php echo $cantidadCampanias . '/' . $cantidadCampanias ?></span>
  </div>

  <div class="content-body">
    <!-- TODO: Cargar dinamicamente las campañas -->
    <?php include("./includes/campaigns.php") ?>
  </div>

</div>


<!-- Agregar Campaña -->
<div class="content-box" id="add-campaign">
  <div class="content-header">
    <h2 class="title">Agregar Campaña</h2>
  </div>

  <div class="content-body">
    <form action="./public/add.php" method="post" name="add">
      <div class="row content-form">

        <h3>Cliente</h3><br>

        <div class="col-xs-12 col-sm-4 form-group">
          <label for="nombre">Nombre</label>
          <input class="form-control" type="text" name="nombre" id="nombre" maxlength="255" required>
        </div>

        <div class="col-xs-12 col-sm-4 form-group">
          <label for="apellido">Apellido</label>
          <input class="form-control" type="text" name="apellido" id="apellido" maxlength="255" required>
        </div>

        <div class="col-xs-12 col-sm-4 form-group">
          <label for="telefono">Telefono</label>
          <input class="form-control" type="number" name="telefono" id="telefono" maxlength="10" required>
        </div>

        <div class="col-xs-12 col-sm-4 form-group">
          <label for="razon_social">Razón Social</label>
          <input class="form-control" type="text" name="razon_social" id="razon_social" maxlength="255" required>
        </div>

        <div class="col-xs-12 col-sm-4 form-group">
          <label for="cuitcuil">Cuit/Cuil</label>
          <input class="form-control" type="number" name="cuitcuil" id="cuitcuil" maxlength="11" required>
        </div>

        <div class="col-xs-12 col-sm-4 form-group">
          <label for="email">Email</label>
          <input class="form-control" type="email" name="email" id="email" maxlength="255" required>
        </div>

        <h3>Campaña</h3><br>

        <div class="col-xs-12 form-group">
          <label for="nombre_campania">Nombre</label>
          <input class="form-control" type="text" name="nombre_campania" id="nombre_campania" maxlength="50" required>
        </div>

        <div class="col-xs-12 form-group">
          <label for="cantidad_mensajes">Cantidad Mensajes</label>
          <select class="form-control" name="cantidad_mensajes" id="cantidad_mensajes" required>
            <option value="7000">7000</option>
            <option value="14000">14000</option>
            <option value="21000">21000</option>
            <option value="28000">28000</option>
            <option value="35000">35000</option>
            <option value="42000">42000</option>
            <option value="49000">49000</option>
            <option value="56000">56000</option>
            <option value="63000">63000</option>
            <option value="70000">70000</option>
          </select>
        </div>

        <div class="col-xs-12 form-group">
          <label for="text">Descripción</label>
          <textarea class="form-control" name="text" id="text" maxlength="160" required></textarea>
        </div>

        <div class="col-xs-12 form-group">
          <label for="localidades">Localidades</label>
          <select class="form-control" name="localidades[]" id="localidades" required multiple="multiple">
            <?php
            foreach ($localidades as $localidad) {
              echo '<option value="' . $localidad->getId() . '">' . $localidad->getNombre() . '</option>';
            }
            ?>
          </select>
        </div>

        <div class="col-xs-12 form-group">
          <button class="btn btn-block" name="submit">Agregar</button>
        </div>
      </div>
    </form>
  </div>
</div>


<!-- Mostrar Campaña -->
<div class="content-box" id="show-campaign">
  <div class="content-header">
    <h2 class="title">Información Campaña</h2>
  </div>

  <div class="content-body">
    <form>
      <div class="row content-form">

        <h3>Cliente</h3><br>

        <div class="col-xs-4 form-group">
          <label for="nombre">Nombre</label>
          <input class="form-control" type="text" name="nombre" id="nombre" maxlength="255" readonly value="<?php echo $client ? $client->getNombre() : ''; ?>">
        </div>

        <div class="col-xs-4 form-group">
          <label for="apellido">Apellido</label>
          <input class="form-control" type="text" name="apellido" id="apellido" maxlength="255" readonly value="<?php echo $client ? $client->getApellido() : ''; ?>">
        </div>

        <div class="col-xs-4 form-group">
          <label for="telefono">Telefono</label>
          <input class="form-control" type="number" name="telefono" id="telefono" maxlength="10" readonly value="<?php echo $client ? $client->getTelefono() : ''; ?>">
        </div>

        <div class="col-xs-4 form-group">
          <label for="razon_social">Razón Social</label>
          <input class="form-control" type="text" name="razon_social" id="razon_social" maxlength="255" readonly value="<?php echo $client ? $client->getRazonSocial() : ''; ?>">
        </div>

        <div class="col-xs-4 form-group">
          <label for="cuitcuil">Cuit/Cuil</label>
          <input class="form-control" type="number" name="cuitcuil" id="cuitcuil" maxlength="11" readonly value="<?php echo $client ? $client->getCuilCuit() : ''; ?>">
        </div>

        <div class="col-xs-4 form-group">
          <label for="email">Email</label>
          <input class="form-control" type="email" name="email" id="email" maxlength="255" readonly value="<?php echo $client ? $client->getEmail() : ''; ?>">
        </div>

        <h3>Campaña</h3><br>

        <div class="col-xs-6 form-group">
          <label for="nombre_campania">Nombre</label>
          <input class="form-control" type="text" name="nombre_campania" id="nombre_campania" maxlength="50" readonly value="<?php echo $client ? $campaign->getNombre() : ''; ?>">
        </div>

        <div class="col-xs-6 form-group">
          <label for="cantidad_mensajes">Cantidad Mensajes</label>
          <select class="form-control" name="cantidad_mensajes" id="cantidad_mensajes" readonly>
            <option value="<?php echo $client ? $campaign->getCantidadMensajes() : ''; ?>"><?php echo $client ? $campaign->getCantidadMensajes() : ''; ?></option>
          </select>
        </div>

        <div class="col-xs-12 form-group">
          <label for="text">Descripción</label>
          <textarea class="form-control" name="text" id="text" maxlength="160" readonly><?php echo $client ? $campaign->getTexto() : ''; ?></textarea>
        </div>

        <div class="col-xs-12 form-group">
          <label for="localidades">Localidades</label>
          <select class="form-control" name="localidades[]" id="localidades" readonly multiple="multiple">
            <?php
            foreach ($localidadesCampania as $localidad) {
              echo '<option checked value="' . $localidad->getId() . '">' . $localidad->getNombre() . '</option>';
            }
            ?>
          </select>
        </div>
      </div>
    </form>
  </div>
</div>


<!-- Editar Campaña -->
<div class="content-box" id="edit-campaign">
  <div class="content-header">
    <h2 class="title">Editar Campaña</h2>
  </div>

  <div class="content-body">
    <form action="./public/edit.php?id=<?php echo $_GET['id'] ?? '' ?>" method="post" name="edit">
      <div class="row content-form">

        <h3>Cliente</h3><br>

        <div class="col-xs-12 col-sm-4 form-group">
          <label for="nombre">Nombre</label>
          <input class="form-control" type="text" name="nombre" id="nombre" maxlength="255" value="<?php echo $client ? $client->getNombre() : ''; ?>" required>
        </div>

        <div class="col-xs-12 col-sm-4 form-group">
          <label for="apellido">Apellido</label>
          <input class="form-control" type="text" name="apellido" id="apellido" maxlength="255" value="<?php echo $client ? $client->getApellido() : ''; ?>" required>
        </div>

        <div class="col-xs-12 col-sm-4 form-group">
          <label for="telefono">Telefono</label>
          <input class="form-control" type="number" name="telefono" id="telefono" maxlength="10" value="<?php echo $client ? $client->getTelefono() : ''; ?>" required>
        </div>

        <div class="col-xs-12 col-sm-4 form-group">
          <label for="razon_social">Razón Social</label>
          <input class="form-control" type="text" name="razon_social" id="razon_social" maxlength="255" value="<?php echo $client ? $client->getRazonSocial() : ''; ?>" required>
        </div>

        <div class="col-xs-12 col-sm-4 form-group">
          <label for="cuitcuil">Cuit/Cuil</label>
          <input class="form-control" type="number" name="cuitcuil" id="cuitcuil" maxlength="11" value="<?php echo $client ? $client->getCuilCuit() : ''; ?>" required readonly>
        </div>

        <div class="col-xs-12 col-sm-4 form-group">
          <label for="email">Email</label>
          <input class="form-control" type="email" name="email" id="email" maxlength="255" value="<?php echo $client ? $client->getEmail() : ''; ?>" required>
        </div>

        <h3>Campaña</h3><br>

        <div class="col-xs-12 form-group">
          <label for="nombre_campania">Nombre Campaña</label>
          <input class="form-control" type="text" name="nombre_campania" id="nombre_campania" maxlength="50" value="<?php echo $client ? $campaign->getNombre() : ''; ?>" required>
        </div>

        <div class="col-xs-12 form-group">
          <label for="cantidad_mensajes">Cantidad Mensajes</label>
          <select class="form-control" name="cantidad_mensajes" id="cantidad_mensajes">
            <option selected value></option>
            <option value="7000">7000</option>
            <option value="14000">14000</option>
            <option value="21000">21000</option>
            <option value="28000">28000</option>
            <option value="35000">35000</option>
            <option value="42000">42000</option>
            <option value="49000">49000</option>
            <option value="56000">56000</option>
            <option value="63000">63000</option>
            <option value="70000">70000</option>
          </select>
        </div>

        <div class="col-xs-12 form-group">
          <label for="estado">Estado</label>
          <select class="form-control" name="estado" id="estado">
            <option selected value></option>
            <option value="CREADA">Creada</option>
            <option value="EN EJECUCIÓN">En Ejecución</option>
            <option value="FINALIZADA">Finalizada</option>
          </select>
        </div>

        <div class="col-xs-12 form-group">
          <label for="text">Descripción</label>
          <textarea required class="form-control" name="text" id="text" maxlength="160"><?php echo $client ? $campaign->getTexto() : ''; ?></textarea>
        </div>

        <div class="col-xs-12 form-group">
          <label for="localidades">Localidades</label>
          <select class="form-control" name="localidades[]" id="localidades" multiple="multiple" required>
            <?php
            foreach ($localidades as $localidad) {
              if (in_array($localidad->getId(), $idLocalidadesCampania)) {
                echo '<option selected value="' . $localidad->getId() . '">' . $localidad->getNombre() . '</option>';
              } else {
                echo '<option value="' . $localidad->getId() . '">' . $localidad->getNombre() . '</option>';
              }
            }
            ?>
          </select>
        </div>

        <div class="col-xs-12 form-group">
          <button class="btn btn-block" name="edit" <?php echo $client ? '' : 'disabled'; ?>>Editar</button>
        </div>
      </div>
    </form>
  </div>
</div>





<!-- Home -->
<div class="content-box" id="home-user">

  <div class="content-header">
    <h2 class="title">Usuarios Actuales</h2>
     <!--TODO: Insertar cantidad dinamicamente -->
     <span class="quantity"><?php echo $cantidadUsuarios . '/' . $cantidadUsuarios ?></span>
  </div>

  <div class="content-body-user">
    <!--TODO: Cargar dinamicamente los usuarios -->
    <?php include("list-user.php") ?> 
  </div>
</div>



<!-- Mostrar Usuario -->
 <div class="content-box" id="show-user">
  <div class="content-header">
    <h2 class="title">Información Usuario</h2>
  </div>

  <div class="content-body">
    <form>
      <div class="row content-form">

        <h3>Usuario</h3><br>

        <div class="col-xs-12 col-sm-4 form-group">
          <label for="nombre">Nombre</label>
          <input class="form-control" type="text" name="nombre" id="nombre" maxlength="255" readonly value="<?php echo $user ? $user->getNombre() : ''; ?>">
        </div>

        <div class="col-xs-12 col-sm-4 form-group">
          <label for="apellido">Apellido</label>
          <input class="form-control" type="text" name="apellido" id="apellido" maxlength="255" readonly value="<?php echo $user ? $user->getApellido() : ''; ?>">
        </div>

        <div class="col-xs-12 col-sm-4 form-group">
          <label for="telefono">Telefono</label>
          <input class="form-control" type="number" name="telefono" id="telefono" maxlength="10" readonly value="<?php echo $user ? $user->getTelefono() : ''; ?>">
        </div>

        <div class="col-xs-12 col-sm-4 form-group">
          <label for="tipo-documento">Tipo de Documento</label>
          <input class="form-control" type="text" name="tipo-documento" id="tipo-documento" maxlength="255" readonly value="<?php echo $user ? $user->getTipoDocumento() : ''; ?>">
        </div>

        <div class="col-xs-12 col-sm-4 form-group">
          <label for="numero-documento">Numero de Documento</label>
          <input class="form-control" type="number" name="numero-documento" id="numero-documento" maxlength="11" readonly value="<?php echo $user ? $user->getNumeroDocumento() : ''; ?>">
        </div>

        <div class="col-xs-12 col-sm-4 form-group">
          <label for="email">Email</label>
          <input class="form-control" type="email" name="email" id="email" maxlength="255" readonly value="<?php echo $user ? $user->getEmail() : ''; ?>">
        </div>

        <div class="col-xs-12 col-sm-4 form-group">
          <label for="fecha-nacimiento">Fecha de Nacimiento</label>
          <input class="form-control" type="date" name="fecha-nacimiento" id="fecha-nacimiento" maxlength="255" readonly value="<?php echo $user ? $user->getNacimiento() : ''; ?>">
        </div>
      </div>
    </form>
  </div>
</div> 



<!-- editar usuario -->
<div class="content-box" id="edit-user">
  <div class="content-header">
    <h2 class="title">Editar Usuario</h2>
  </div>

  <div class="content-body">
    <form action="./public/edit-user.php?id=<?php echo $_GET['id'] ?? '' ?>" method="post" name="edit-user">
      <div class="row content-form">

        <h3>Usuario</h3><br>

        <div class="col-xs-12 col-sm-4 form-group">
          <label for="nombre">Nombre</label>
          <input class="form-control" type="text" name="nombre" id="nombre" maxlength="255" value="<?php echo $user ? $user->getNombre() : ''; ?>" required>
        </div>

        <div class="col-xs-12 col-sm-4 form-group">
          <label for="apellido">Apellido</label>
          <input class="form-control" type="text" name="apellido" id="apellido" maxlength="255" value="<?php echo $user ? $user->getApellido() : ''; ?>" required>
        </div>

        <div class="col-xs-12 col-sm-4 form-group">
          <label for="telefono">Telefono</label>
          <input class="form-control" type="number" name="telefono" id="telefono" maxlength="10" value="<?php echo $user ? $user->getTelefono() : ''; ?>" required>
        </div>

        <div class="col-xs-12 col-sm-4 form-group">
          <label for="tipodocumento">Tipo de documento</label>
          <input class="form-control" type="text" name="tipodocumento" id="tipodocumento" maxlength="255" value="<?php echo $user ? $user->getTipoDocumento() : ''; ?>" required>
        </div>

        <div class="col-xs-12 col-sm-4 form-group">
          <label for="numerodocumento">Numero de documento</label>
          <input class="form-control" type="number" name="numerodocumento" id="numerodocumento" maxlength="11" value="<?php echo $user ? $user->getNumeroDocumento() : ''; ?>" required readonly>
        </div>

        <div class="col-xs-12 col-sm-4 form-group">
          <label for="email">Email</label>
          <input class="form-control" type="email" name="email" id="email" maxlength="255" value="<?php echo $user ? $user->getEmail() : ''; ?>" required>
        </div>

        <div class="col-xs-12 col-sm-4 form-group">
          <label for="fechanacimiento">Fecha de nacimiento</label>
          <input class="form-control" type="text" name="nacimiento" id="nacimiento" maxlength="255" value="<?php echo $user ? $user->getNacimiento() : ''; ?>" required readonly>
        </div>

        <div class="col-xs-12 form-group">
          <button class="btn btn-block" name="edit-usuario" <?php echo $user ? '' : 'disabled'; ?>>Editar</button>
        </div>
      </div>
    </form>
  </div>
</div>

