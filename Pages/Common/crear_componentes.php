<?php 

function caja_ciudades ($idciudadini_z) {
  $componente_z = "";
  $componente_z = " <div class=\"form-group\"><div class=\"col-sm-6\">
  <label for=\"ciudad\">Ciudad:</label></div>
  <div class=\"col-sm-6\">
  <select  class=\"form-control\" 
  id=\"idciudad\" name=\"idciudad\"
  value = \"" . $idciudadini_z . "\" >";
    $url = "http://localhost/mantove/Pages/Common/busca_datos.php?modo=BUSCA_CIUDADES";
    $ciudades_z = json_decode(file_get_contents($url));
    foreach ($ciudades_z as $miciudad_z) {
      $componente_z = $componente_z . "\"<option value = \"" . $miciudad_z->ciudad . "\"";
      if ($miciudad_z->idciudad == $idciudadini_z ) {
         $componente_z = $componente_z . "selected=\"selected\"";
      }
      $componente_z = $componente_z .  ">";
      $componente_z = $componente_z . $miciudad_z->ciudad   . "</option>\n";
   }
   $componente_z = $componente_z . "</select></div></div>";
   return ($componente_z);
}


function caja_tipovehiculos ($idtipovehiculoini_z) {
  $componente_z = "";
  $componente_z = " <div class=\"row\"><div class=\"col-sm-3\">
  <label for=\"tipovehiculo\">Tipo de Vehiculo:</label></div>
  <div class=\"col-sm-6\">
  <select  class=\"form-control\" 
  id=\"tipovehiculo\" name=\"idtipoveh\"
  value = \"" . $idtipovehiculoini_z . "\" >";
  
    $tiposvehiculo_z = json_decode(busca_tipovehiculos());
    foreach ($tiposvehiculo_z as $mitipovehiculo_z) {
      $componente_z = $componente_z . "\"<option value = \"" . $mitipovehiculo_z->idtipovehiculo . "\"";
      if ($mitipovehiculo_z->idtipovehiculo == $idtipovehiculoini_z) {
         $componente_z = $componente_z . " selected=\"selected\"";
      }
      $componente_z = $componente_z .  ">";
      $componente_z = $componente_z . $mitipovehiculo_z->descripcion   . "</option>\n";
   }
   $componente_z = $componente_z . "</select></div></div>";
   return ($componente_z);
}

function caja_tipocombustibles ($idtipocombustibleini_z, $funonchange_z) {
  $componente_z = "";
  $componente_z = " <div class=\"row\"><div class=\"col-sm-3\">
  <label for=\"tipovehiculo\">Combustible:</label></div>
  <div class=\"col-sm-6\">
  <select  class=\"form-control\" 
  id=\"tipocombustible\" name=\"idcombustible\"";
  if($funonchange_z <> "") {
    $componente_z = $componente_z . " ". $funonchange_z;

  }
  $componente_z = $componente_z . " value = \"" . $idtipocombustibleini_z . "\" >";
  
    $tiposcombustibles_z = json_decode(busca_combustibles());
    foreach ($tiposcombustibles_z as $mitipocombustible_z) {
      $componente_z = $componente_z . "<option value = \"" . $mitipocombustible_z->idcombustible . "\"";
      if ($mitipocombustible_z->idcombustible == $idtipocombustibleini_z) {
         $componente_z = $componente_z . "selected=\"selected\"";
      }
      $componente_z = $componente_z .  ">";
      $componente_z = $componente_z . $mitipocombustible_z->descripcion   . "</option>\n";
   }
   $componente_z = $componente_z . "</select></div></div>";
   return ($componente_z);
}


function caja_almacenes ($idalmacen_z) {
  $componente_z = "";
  $componente_z = " <div class=\"row\"><div class=\"col-sm-3\">
  <label for=\"almacenes\">Almacen:</label></div>
  <div class=\"col-sm-6\">
  <select  class=\"form-control\" 
  id=\"almacen\" name=\"almacen\"
  value = \"" . $idalmacen_z . "\" >";
  
  $almacenes_z = json_decode(busca_almacenes());
  foreach ($almacenes_z as $mialmacen_z) {
      $componente_z = $componente_z . "\"<option value = \"" . $mialmacen_z->idalmacen . "\"";
      if ($mialmacen_z->idalmacen == $idalmacen_z) {
         $componente_z = $componente_z . "selected=\"selected\"";
      }
      $componente_z = $componente_z .  ">";
      $componente_z = $componente_z . $mialmacen_z->clave . " " . $mialmacen_z->nombre   . "</option>\n";
   }
   $componente_z = $componente_z . "</select></div></div>";
   return ($componente_z);
}

function caja_choferes ($idchofer_z) {
  $componente_z = "";
  $componente_z = " <div class=\"row\"><div class=\"col-sm-3\">
  <label for=\"idchofer\">Chofer:</label></div>
  <div class=\"col-sm-6\">
  <select  class=\"form-control\" 
  id=\"idchofer\" name=\"idchofer\"
  value = \"" . $idchofer_z . "\" >";
  
  $choferes_z = json_decode(busca_choferes());
  foreach ($choferes_z as $michofer_z) {
      $componente_z = $componente_z . "\"<option value = \"" . $michofer_z->idchofer . "\"";
      if ($michofer_z->idchofer == $idchofer_z) {
         $componente_z = $componente_z . "selected=\"selected\"";
      }
      $componente_z = $componente_z .  ">";
      $componente_z = $componente_z . $michofer_z->codigo . " " . $michofer_z->nombres . " " . $michofer_z->apellidos  . "</option>\n";
   }
   $componente_z = $componente_z . "</select></div></div>";
   return ($componente_z);
}

function caja_marcas ($idmarca_z) {
  $componente_z = "";
  $componente_z = " <div class=\"row\"><div class=\"col-sm-3\">
  <label for=\"choferes\">Marca:</label></div>
  <div class=\"col-sm-6\">
  <select  class=\"form-control\" 
  id=\"marca\" name=\"idmarca\"
  value = \"" . $idmarca_z . "\" >";
  
  $marcas_z = json_decode(busca_marcas());
  foreach ($marcas_z as $mimarca_z) {
      $componente_z = $componente_z . "\"<option value = \"" . $mimarca_z->idmarca . "\"";
      if ($mimarca_z->idmarca == $idmarca_z) {
         $componente_z = $componente_z . "selected=\"selected\"";
      }
      $componente_z = $componente_z .  ">";
      $componente_z = $componente_z . $mimarca_z->marca  . "</option>\n";
   }
   $componente_z = $componente_z . "</select></div></div>";
   return ($componente_z);
}

function caja_zonas ($idzona_z) {
  $componente_z = "";
  $componente_z = " <div class=\"row\"><div class=\"col-sm-3\">
  <label for=\"idzona\">Zona:</label></div>
  <div class=\"col-sm-6\">
  <select  class=\"form-control\" 
  id=\"idzona\" name=\"idzona\"
  value = \"" . $idzona_z . "\" >";
    $url = "../../Common/busca_datos.php?modo=BUSCA_ZONAS";
    $zonas_z = json_decode(busca_zonas());
  
    foreach ($zonas_z as $mizona_z) {
      $componente_z = $componente_z . "<option value = \"" . $mizona_z->idzona . "\"";
      if ($mizona_z->idzona == $idzona_z) {
         $componente_z = $componente_z . "selected=\"selected\"";
      }
      $componente_z = $componente_z .  ">";
      $componente_z = $componente_z . $mizona_z->zona  . "</option>\n";
   }
   $componente_z = $componente_z . "</select></div></div>";
   return ($componente_z);
}

function caja_vehiculos ($idvehiculo_z, $funonchange_z) {
  $componente_z = "";
  $componente_z = " <div class=\"row\"><div class=\"col-sm-3\">
  <label for=\"idvehiculo\">Vehiculo:</label></div>
  <div class=\"col-sm-6\">
  <select  class=\"form-control\" 
  id=\"idvehiculo\" name=\"idvehiculo\"";
  if($funonchange_z <> "") {
    $componente_z = $componente_z . $funonchange_z ;

  }

  $componente_z = $componente_z  . " value = \"" . $idvehiculo_z . "\" >";
  
    $vehiculos_z = json_decode(busca_vehiculos());
    foreach ($vehiculos_z as $mivehiculo_z) {
      $componente_z = $componente_z . " <option value = \"" . $mivehiculo_z->idvehiculo . "\" ";
      if ($mivehiculo_z->idvehiculo == $idvehiculo_z) {
         $componente_z = $componente_z . " selected=\"selected\"";
      }
      $componente_z = $componente_z .  ">";
      $componente_z = $componente_z . $mivehiculo_z->codigo . " "  . $mivehiculo_z->descri . "</option>\n";
   }
   $componente_z = $componente_z . "</select></div></div>";
   return ($componente_z);
}

function caja_tipospago ($idtipopago_z) {
  $componente_z = "";
  $componente_z = " <div class=\"row\"><div class=\"col-sm-3\">
  <label for=\"idtipopago\">Tipo Pago:</label></div>
  <div class=\"col-sm-6\">
  <select  class=\"form-control\" 
  id=\"idtipopago\" name=\"idtipopago\"
  value = \"" . $idtipopago_z . "\" >";
  
    $tipospago_z = json_decode(busca_tipopagos());
    foreach ($tipospago_z as $mitipopago_z) {
      $componente_z = $componente_z . "<option value = \"" . $mitipopago_z->idtipopago . "\"";
      if ($mitipopago_z->idtipopago == $idtipopago_z) {
         $componente_z = $componente_z . "selected=\"selected\"";
      }
      $componente_z = $componente_z .  ">";
      $componente_z = $componente_z . $mitipopago_z->descripcion . "</option>\n";
   }
   $componente_z = $componente_z . "</select></div></div>";
   return ($componente_z);
}

function input_en_row($nombrecampo_z, $tipocampo_z, $etiqueta_z, $valorcampo_z, 
  $maxlargo_z, $funcion_z) {
  $cadena_z = "";
  $cadena_z = "<div class=\"container\">
  <div class=\"row\">
  <div class=\"col-sm-3\">
    <label for=\"" . $nombrecampo_z . "\"id=\"lbl_" . $nombrecampo_z . "\" > ".
    $etiqueta_z . "</label>
  </div>
  <div class=\"col-sm-6\">
    <input type=\"" . $tipocampo_z . "\" class=\"form-control\" 
      id=\"". $nombrecampo_z . "\" name=\"" . $nombrecampo_z . "\"  maxlength=\"". $maxlargo_z . "\"
      value = \"". $valorcampo_z . "\"";
  if ($funcion_z >= "") {
    $cadena_z .= $funcion_z;
  }
  $cadena_z .= " >
  </div>
  </div>
  </div>";
  return ($cadena_z);
}

function opciones_en_list($nombrecampo_z, $arraydevalores_z, $etiqueta_z, $valorcampo_z, $funonchange_z) {
  $componente_z = "";
  $componente_z = " <div class=\"row\"><div class=\"col-sm-3\">
  <label for=\"" . $nombrecampo_z . "\"  id=\"lbl_" . $nombrecampo_z . "\" >" . $etiqueta_z . " </label></div>
  <div class=\"col-sm-6\">
  <select  class=\"form-control\" 
  id=\"" . $nombrecampo_z . "\" name=\"". $nombrecampo_z . "\"
  value = \"" . $valorcampo_z . "\"";
  if($funonchange_z <> "") {
    $componente_z = $componente_z . $funonchange_z;

  }
  $componente_z = $componente_z . " >";
  
  foreach ($arraydevalores_z as $mimarca_z) {
      $componente_z = $componente_z . "<option value = \"" . $mimarca_z . "\"";
      if ($mimarca_z == $valorcampo_z ) {
         $componente_z = $componente_z . " selected=\"selected\"";
      }
      $componente_z = $componente_z .  ">";
      $componente_z = $componente_z . $mimarca_z  . "</option>\n";
   }
   $componente_z = $componente_z . "</select></div></div>";
   return ($componente_z);
  }

  function caja_talleres ($idtaller_z, $funonchange_z) {
    $componente_z = "";
    $componente_z = " <div class=\"row\"><div class=\"col-sm-3\">
    <label for=\"idtaller\">Taller:</label></div>
    <div class=\"col-sm-6\">
    <select  class=\"form-control\" 
    id=\"idtaller\" name=\"idtaller\"
    value = \"" . $idtaller_z . "\"";
    if($funonchange_z <> "") {
      $componente_z = $componente_z . $funonchange_z;
  
    }
    $componente_z = $componente_z . " >";
    $talleres_z = json_decode(busca_talleres());
      foreach ($talleres_z as $mitaller_z) {
        $componente_z = $componente_z . "<option value = \"" . $mitaller_z->idtaller . "\"";
        if ($mitaller_z->idtaller == $idtaller_z) {
           $componente_z = $componente_z . " selected=\"selected\"";
        }
        $componente_z = $componente_z .  ">";
        $componente_z = $componente_z . $mitaller_z->nombre . "</option>\n";
     }
     $componente_z = $componente_z . "</select></div></div>";
     return ($componente_z);
  }

  function caja_servicios($idservicio_z, $funonchange_z) {
    $componente_z = "";
    $componente_z = " <div class=\"row\"><div class=\"col-sm-3\">
    <label for=\"idservmanto\">Servicio:</label></div>
    <div class=\"col-sm-6\">
    <select  class=\"form-control\" 
    id=\"idservmanto\" name=\"idservmanto\"
    value = \"" . $idservicio_z . "\"";
    if($funonchange_z <> "") {
      $componente_z = $componente_z . $funonchange_z;
  
    }
    $componente_z = $componente_z . " >";
    $servicios_z = json_decode(busca_mantenimientos());
      foreach ($servicios_z as $miservicio_z) {
        $componente_z = $componente_z . "<option value = \"" . $miservicio_z->idservmanto . "\"";
        if ($miservicio_z->idservmanto == $idservicio_z) {
           $componente_z = $componente_z . " selected=\"selected\"";
        }
        $componente_z = $componente_z .  ">";
        $componente_z = $componente_z . $miservicio_z->descri . "</option>\n";
     }
     $componente_z = $componente_z . "</select></div></div>";
     return ($componente_z);
  }
  
  function input_en_text($nombrecampo_z, $tipocampo_z, $etiqueta_z, $valorcampo_z, 
  $maxlargo_z, $funcion_z) {
  $cadena_z = "";
  $cadena_z = "<div class=\"container\">
  <div class=\"row\">
  <div class=\"col-sm-3\">
    <label for=\"" . $nombrecampo_z . "\">". $etiqueta_z . "</label>
  </div>
  <div class=\"col-sm-6\">
    <textarea class=\"form-control\" 
      id=\"". $nombrecampo_z . "\" name=\"" . $nombrecampo_z . "\" ";
      
  if ($maxlargo_z <> ""){
    $cadena_z .= " " . $maxlargo_z . " ";
  }
  if ($funcion_z >= "") {
    $cadena_z .= $funcion_z;
  }
  $cadena_z .= " > ";
  $cadena_z . $valorcampo_z ;
  $cadena_z .= "</textarea>
  </div>
  </div>
  </div>";
  return ($cadena_z);
}

?>
