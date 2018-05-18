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
        <div class="upper-bar-title">AGREGAR EDIFICIO</div>
        </div>
        <div class="container">
        <div style="width:100%;height:50px"></div>
        <input class="new-building-name" id="name" type="text" name="name" placeholder="Nombre Edificio">
        <div class="add-button" onclick="agregar()">Agregar</div>
        </div>
    </body>
    <script>
    function agregar(){
    var building = $("#name").val();
     $.ajax({
                 dataType: 'json',
                 url:'https://jugotk3.000webhostapp.com/admin-add-building.blade.php',
                 type:'post',
                data:{name:building},
                success:function(response){ 
                    if(response["status"] == 1){ 
                    alert("Edificio creado!");

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