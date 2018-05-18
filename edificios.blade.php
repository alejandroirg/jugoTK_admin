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
        <div class="upper-bar-title">EDITAR EDIFICIOS</div>
        <a class="upper-bar-link" href="/agregar-edificio">Agregar Nuevo</a>
        </div>
    <div class="container">
        <div style="width:100%;height:50px"></div>
        <div id="edificios" class="edificios-container"></div>
        <br><br>
        <input style="display:none" id="selected" class="edificio-seleccionado" type="number">
        <input class="new-building-name" id="name" type="text" name="name" placeholder="Nuevo Nombre Edificio">
        <div class="add-button" onclick="editar()">Cambiar</div>
        <div class="add-button" style="background-color:red" onclick="borrar()">Borrar</div>
    </div>
    </body>
    <script>

    function selectBuilding(a){
    $(".edificio").removeClass("selected-edificio");
    $("#" + a.id).addClass("selected-edificio");
    $("#selected").val(a.id);
    }

    function createButtons(buildings){
        console.log(buildings);
        
        var container = $("#edificios");

        for(var i=0;i<buildings.length;i++){
            
       var building = $("<div class='edificio' id='"+buildings[i].id+"' onclick='selectBuilding(this)'>"+buildings[i].nombre+"</div>");
       container.append(building);
        }

    }

     //Get All Edificios

     $.ajax({
                 dataType: 'json',
                 url:'https://jugotk3.000webhostapp.com/admin-get-buildings.blade.php',
                 type:'post',
                data:{},
                success:function(response){ 
                    if(response["status"] == 1){ 
                    
                    createButtons(response["buildings"]);

                    }else{
                    console.log(response["message"]);
                    
                    }
                },
                error:function(response){
                  console.log(response);
                }
        });


    function editar(){
    var selected = $("#selected").val();
    var newname = $("#name").val();
     $.ajax({
                 dataType: 'json',
                 url:'https://jugotk3.000webhostapp.com/admin-edit-buildings.blade.php',
                 type:'post',
                data:{name:newname,id:selected},
                success:function(response){ 
                    if(response["status"] == 1){ 
                    alert("Edificio Editado!");
                    location.reload();
                    }else{
                    console.log(response["message"]);
                    }
                },
                error:function(response){
                  console.log(response);
                }
        });
    }    

    function borrar(){
     
    var selected = $("#selected").val();
   
     $.ajax({
                 dataType: 'json',
                 url:'https://jugotk3.000webhostapp.com/admin-delete-building.blade.php',
                 type:'post',
                data:{id:selected},
                success:function(response){ 
                    if(response["status"] == 1){ 
                    location.reload();
                    alert("Edificio Eliminado!");
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