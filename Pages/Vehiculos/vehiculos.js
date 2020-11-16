//Script que manipula el Combo de Status Activo / Inactivo

function getComboStatus(selectObject) {
    var miobj_z = document.getElementById("status");
    var lblfecbaj_z = document.getElementById("lbl_fecbaj");
    var mifecbaj_z = document.getElementById("fecbaj");
    //console.log("Estoy en getComboStatus");


    var selector_z =  miobj_z.value; 
    switch(selector_z){
      case "ACTIVO":
          mifecbaj_z.style = "display:none";
          lblfecbaj_z.style = "display:none";
          //console.log("Estoy en Activo getComboStatus");
        break;
      case "BAJA":
        var mifecha_z = new Date();
        var mes_z = mifecha_z.getMonth()+1; //obteniendo mes
        var dia_z = mifecha_z.getDate(); //obteniendo dia
        var anu_z = mifecha_z.getFullYear(); //obteniendo año
        //console.log("Estoy en Baja getComboStatus");
        if(dia_z<10)
           dia_z='0'+dia_z; //agrega cero si el menor de 10
        if(mes_z<10)
          mes='0'+mes_z; //agrega cero si el menor de 10
          mifecbaj_z.value = anu_z + "-" + mes_z + "-" + dia_z;
          mifecbaj_z.style = "display:block";
          lblfecbaj_z.style = "display:block";
        break;
    }
}

window.onload = function() {
  getComboStatus(this);
}
//-->
