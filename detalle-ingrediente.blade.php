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
     <div class="upper-bar">
     <div class="upper-bar-title" style="width:25%">DETALLE INGREDIENTE</div> 
     </div>

 <div class="container add-ingredient-container">
        <div style="width:100%;height:50px"></div>

    <input id="ingredienteid" type="hidden">    
    
    <div class="add-ingredient-title">Nombre</div>
    <input type="text" id="nombre"><br>

    <div class="add-ingredient-title">Precio</div>
    <input type="number" id="precio"><br>

    <div class="add-ingredient-title">Icono</div>
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

    <div class="add-button" onclick="update()">Editar</div>
    <div style="width:100%;height:15px"></div>
    <div class="add-button" style="background-color:red" onclick="del()">Eliminar</div>
    <div style="width:100%;height:75px"></div>

</div>
    
    </body>
    <script>

        var id = {{ $id }}

        function createIngredientDetails(ingredient){

        console.log(ingredient);
       
        $("#ingredienteid").val(ingredient.ingredienteID);
        $("#nombre").val(ingredient.nombre);
        $("#precio").val(ingredient.precio/100);
        $("#iconourl").val(ingredient.icono);
        $("#disponible").val(ingredient.disponible);
        $("#tipo").val(ingredient.tipo);
        $("#producto").val(ingredient.producto);
        $("#porcion").val(ingredient.porcion);
        $("#cal").val(ingredient.calorias);

        }
        


        $.ajax({
                 dataType: 'json',
                 url:'https://jugotk3.000webhostapp.com/admin-get-single-ingredient.blade.php',
                 type:'post',
                data:{id:id},
                success:function(response){ 
                    if(response["status"] == 1){ 
                    
                    createIngredientDetails(response.ingredient[0]);

                    }else{
                    console.log(response["message"]);
                    
                    }
                },
                error:function(response){
                  console.log(response);
                }
        });

    function update(){
    
    var v_id = $("#ingredienteid").val();
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
                 url:'https://jugotk3.000webhostapp.com/admin-edit-ingredient.blade.php',
                 type:'post',
                data:{id:v_id,nombre:v_nombre,precio:v_precio,icono:v_icono,disponible:v_disponible,tipo:v_tipo,producto:v_producto,porcion:v_porcion,cal:v_cal},
                success:function(response){ 
                    if(response["status"] == 1){ 
                    alert("Ingrediente editado!");

                    }else{
                    console.log(response["message"]);
                    
                    }
                },
                error:function(response){
                  console.log(response);
                }
        });

    }    

    function del(){
    
    var v_id = $("#ingredienteid").val();

     $.ajax({
                 dataType: 'json',
                 url:'https://jugotk3.000webhostapp.com/admin-delete-ingredient.blade.php',
                 type:'post',
                data:{id:v_id},
                success:function(response){ 
                    if(response["status"] == 1){ 
                    alert("Ingrediente Eliminado!");

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