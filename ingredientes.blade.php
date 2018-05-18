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
        <div class="upper-bar-title" style="width:21%">Editar Ingredientes</div>
        <a class="upper-bar-link" href="/agregar-ingrediente">Agregar Nuevo</a>
        </div>
        <div class="container">
        <table class="tabla-ingredientes">
            <thead>
                <th></th>
                <th>Nombre</th>
                <th>Porcion</th>
                <th>Tipo</th>
                <th>Status</th>
                <th>Editar</th>
            </thead>
            <tbody id="ingredientes"></tbody>
        </table>
    </div>
    </body>
    <script>

    function selectOffice(a){
    $("#selected").val(a.id);
    }

    function createTable(ingredients){
        
        var container = $("#ingredientes");

        console.log(ingredients);

        for(var i=0;i<ingredients.length;i++){

        var ingredient = $("<tr></tr>");

        ingredient.append($("<td><input type='checkbox'></td>"));

        ingredient.append($("<td>"+ingredients[i].nombre+"</td>"));

        ingredient.append($("<td>"+ingredients[i].porcion+"</td>"));

        ingredient.append($("<td>"+ingredients[i].tipo+"</td>"));

        ingredient.append($("<td>"+ingredients[i].disponible+"</td>"));

             // ingredient.append($("<td>"+ingredients[i].calorias+"</td>"));
             // ingredient.append($("<td>"+ingredients[i].icono+"</td>"));
             // ingredient.append($("<td>"+ingredients[i].id+"</td>"));
             // ingredient.append($("<td>"+ingredients[i].orden+"</td>"));
             // ingredient.append($("<td>"+ingredients[i].precio+"</td>"));
             // ingredient.append($("<td>"+ingredients[i].producto+"</td>"));
        
        ingredient.append($("<td><i id='"+ingredients[i].id+"' onclick='editar(this)' class='fa fa-pencil' aria-hidden='true'></i></td>"));

        container.append(ingredient);

        }

    }

     //Get All Ingredients
     $.ajax({
                 dataType: 'json',
                 url:'https://jugotk3.000webhostapp.com/admin-get-ingredients.blade.php',
                 type:'post',
                data:{},
                success:function(response){ 
                    if(response["status"] == 1){ 
                    
                    createTable(response["ingredients"]);

                    }else{
                    console.log(response["message"]);
                    
                    }
                },
                error:function(response){
                  console.log(response);
                }
        });

    function editar(a){
    window.location = "/detalle-ingrediente/" + a.id;
    }

    </script>
  
</html>