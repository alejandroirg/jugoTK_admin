<!DOCTYPE html>
<html class="no-js" lang="">
    <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="/css/main.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,700" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script
  src="https://code.jquery.com/jquery-3.3.1.js"
  integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
  crossorigin="anonymous"></script>
        <title></title>
        @include('partials/adminbar')
    </head>
    <body style="background-color:#f7f7f7">
    	@include('partials/header')
   <div class="upper-bar" style="background-color:white">
        <div class="upper-bar-title" style="width:21%">Agregar Ingrediente</div>
    </div>

    <div class="container add-ingredient-container">
        <div style="width:100%;height:50px"></div>
    
    <div class="add-ingredient-title">Nombre</div>
    <input type="text" id="nombre"><br>

    <div class="add-ingredient-title">Precio</div>
    <input type="number" id="precio"><br>

    <div class="add-ingredient-title">Icono</div>
    <input style="margin-bottom:0px" type="file" name="fileToUpload" id="icono"><br><!-- Este no lo invocamos en la funcion de agregar -->
    <div class="upload-img" onclick="uploadIcon()">Subir Imagen</div><br>
    <input type="text" id="iconourl"><br> <!-- Este si -->

    <div class="add-ingredient-title">Disponible</div>
    <select id="disponible">
        <option value="1">Si</option>
        <option value="0">No</option>
    </select>

    <div class="add-ingredient-title">Tipo</div>
    <select id="tipo"><br>
        <option value="Frutas">Frutas</option>
        <option value="Verduras">Verduras</option>
        <option value="Cereales">Cereales</option>
        <option value="Endulzantes">Endulzantes</option>
        <option value="Yogurt">Yogurt</option>
        <option value="Bases">Bases</option>
    </select>

    <div class="add-ingredient-title">Producto</div>
    <select id="producto"><br>
        <option value="Jugos">Jugos</option>
        <option value="Licuados">Licuados</option>
        <option value="Cocktail">Cocktail</option>
    </select>

    <div class="add-ingredient-title">Porcion</div>
    <input type="text" id="porcion"><br>

    <div class="add-ingredient-title">Calorías</div>
    <input type="number" id="cal"><br>

    <div class="add-button" onclick="agregar()">Agregar</div>
    <div style="width:100%;height:75px"></div>

</div>

    </body>
    <script>

    function uploadIcon(){

    var data = new FormData();
    data.append('fileToUpload',$('#icono')[0].files[0]);
    console.log(data);

    jQuery.ajax({
    url: 'https://jugotk3.000webhostapp.com/upload-file.blade.php',
    data: data,
    cache: false,
    contentType: false,
    processData: false,
    method: 'POST',
    success: function(response){
        var v_response = JSON.parse(response);

        $("#iconourl").val("https://jugotk3.000webhostapp.com/img/ingredientes/"+ v_response["filename"]);
    }
    
    });

    }

    function agregar(){
   
    //faltó orden !!
     
    var v_nombre = $("#nombre").val();
    var v_precio = ($("#precio").val()*100); //
    var v_icono = $("#iconourl").val();
    var v_disponible = $("#disponible").val(); //
    var v_tipo = $("#tipo").val();
    var v_producto = $("#producto").val();
    var v_porcion = $("#porcion").val();
    var v_cal = $("#cal").val(); //

     $.ajax({
                 dataType: 'json',
                 url:'https://jugotk3.000webhostapp.com/admin-add-ingredient.blade.php',
                 type:'post',
                data:{nombre:v_nombre,precio:v_precio,icono:v_icono,disponible:v_disponible,tipo:v_tipo,producto:v_producto,porcion:v_porcion,cal:v_cal},
                success:function(response){ 
                    if(response["status"] == 1){ 
                    alert("Ingrediente creado!");

                    }else{
                    console.log(response["message"]);
                    
                    }
                },
                error:function(response){
                  console.log(response);
                }
        });

    }    
    </script>
  
</html>