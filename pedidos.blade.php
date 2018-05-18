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
    <body>
    	@include('partials/header')
     <div class="upper-bar">
     <div class="upper-bar-title">PEDIDOS</div> 
     <form class="upper-bar-search-bar"><input class="search" type="text" placeholder="Search..." name="search"></form>
     <div class="upper-bar-download-button-container"><div class="upper-bar-download-button">DESCARGAR</div></div>         
     </div>

     <div class="body">

     <div class="container">       
        <div class="filters-container">
            <div class="filters"></div>
        </div>
       
        <table class="tabla-pedidos">
            <thead>
                <th></th>
                <th>ID</th>
                <th>Usuario</th>
                <th>Oficina</th>
                <th>Horario</th>
                <th>Productos</th>
                <th>Total</th>
                <th>Status</th>
                <th>Editar</th>
            </thead>
            <tbody id="orders">
                
            </tbody>
        </table>    
            
        </div>
     </div>
     
     </div>
    
    </body>
    <script>
        var carrito;

        function toOrderDetails(a){
        window.location = "/detalle-pedido/" + a.id;
        }
        
        function createOrdersTable(orders){
       
        console.log(orders);

        for (var i = 0; i < orders.length; i++){

        var body = $("#orders");
        
        //Esto es un pedido.
        var order = $("<tr></tr>");

        //Obtener el numero de productos sumando las quantitys de los productos del carrito.
        var carrito = JSON.parse(orders[i].carrito);
        var cont = 0;
        for(var j=0;j < carrito.length;j++){
        cont = cont + parseInt(carrito[j].quantity);
        }

        order.append("<td class='pedido-checkbox'><input type='checkbox' name='select' value='n'></td>");
        order.append("<td class='pedido-id'>"+orders[i].pedidoID+"</td>");
        order.append("<td class='pedido-username'>"+orders[i].user_name+"</td>");
        order.append("<td class='pedido-oficina'>"+orders[i].oficina+"</td>");
        order.append("<td class='pedido-horario'>"+orders[i].horario+"</td>");
        order.append("<td class='pedido-num-productos'>"+cont+"</td>");
        order.append("<td class='pedido-total'>"+(orders[i].total/100)+"</td>");
        order.append("<td class='pedido-status'>"+orders[i].status+"</td>");
        order.append("<td class='pedido-edit'><i id='"+orders[i].pedidoID+"' onclick='toOrderDetails(this)' class='fa fa-pencil' aria-hidden='true'></i></td>");


        //aun tenemod orders[i].fecha

        body.append(order);
          
        }
             
        
        }

        $.ajax({
                 dataType: 'json',
                 url:'https://jugotk3.000webhostapp.com/admin-get-orders.blade.php',
                 type:'post',
                data:{},
                success:function(response){ 
                    if(response["status"] == 1){ 
                    
                    createOrdersTable(response["orders"]);
                    
                    }else{
                    console.log(response["message"]);
                    
                    }
                },
                error:function(response){
                  console.log(response);
                }
        });

    </script>
</html>
