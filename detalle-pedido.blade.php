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
     <div class="upper-bar-title">DETALLE PEDIDO</div> 
     <div class="upper-bar-confirm" onclick="changeStatus()">CONFIRMAR</div>
     <select id="status" name="status" class="upper-bar-status">
         <option value="Pendiente">Pendiente</option>
         <option value="Preparacion">En preparación</option>
         <option value="Transito">En tránsito</option>
         <option value="Entregado">Entregado</option>
     </select>
          
     </div>

     <div class="body">

     <div class="order-details-container">  
       <div class="order-details-left">
           <div class="order-details-title">ID de pedido</div>
           <div class="order-details-data" id="order-id"></div>
           
           <div class="order-details-title">Usuario</div>
           <div class="order-details-data" id="user"></div>

           <input id="user-id" type="hidden">
           
           <div class="order-details-title">Fecha</div>
           <div class="order-details-data" id="date"></div>

           <div class="order-details-title">Edificio/Oficina</div>
           <div class="order-details-data" id="office"></div>

           <div class="order-details-title">Horario</div>
           <div class="order-details-data" id="schedule"></div>

       </div>
       <div class="order-details-right">
           <div class="order-details-cart" id="cart">

           </div>
       </div>
     </div>
     
     </div>
    
    </body>
    <script>
        var id = <?php echo $id ?>

        function createOrderDetails(order){

        $("#order-id").text(order.pedidoID);   
        $("#user").text(order.user_name);  
        $("#user-id").val(order.user_id);  
        $("#date").text(order.fecha);    
        $("#office").text(order.oficina);
        $("#schedule").text(order.horario);

        $("#status").val(order.status); 

        var carrito = JSON.parse(order.carrito);

        var cart = $("#cart");

        for(var i = 0; i < carrito.length ; i++){

            //producto ingredientes tamaño calorias total costo

            var product = $("<div class='cart-product'></div>");
            var left = $("<div class='left'></div>");
                
                var title = $("<div class='cart-title'>"+carrito[i].name+"</div>");
                var ingredients = $("<div class='cart-ingredients'>"+carrito[i].ingredientes+"</div>");
                var size = $("<div class='cart-size'>"+carrito[i].tamaño+"</div>");
                var cal = $("<div class='cart-cal'>"+carrito[i].cal+"</div>");
                var price_title = $("<div class='cart-price-title'>Total</div>");
                var price = $("<div class='cart-price'>"+((parseInt(carrito[i].unit_price)/100)*parseInt(carrito[i].quantity))+"</div>");
                var unit_price = $("<div class='unit-price' style='display:none;'>"+carrito[i].unit_price+"</div>");
             
             left.append(title);
             left.append(ingredients);
             left.append(size);
             left.append(cal);
             left.append(price_title);
             left.append(price);
             left.append(unit_price);

            product.append(left);

            var right = $("<div class='cart-quantity-container'><div class='cart-quantity-box'>"+carrito[i].quantity+"</div></div>");

            product.append(right);
            
            cart.append(product);

        }
        
        var cont = $("<div class='total-amount-container'></div>");

        cont.append("<div class='total-amount-title'>Total</div>");
        cont.append("<div class='total-amount'>"+(parseInt(order.total)/100)+"</div>");
         
        cart.append(cont); 

        }

        $.ajax({
                 dataType: 'json',
                 url:'https://jugotk3.000webhostapp.com/admin-get-single-order.blade.php',
                 type:'post',
                data:{id:id},
                success:function(response){ 
                    if(response["status"] == 1){ 
                    
                    createOrderDetails(response.order[0]);

                    }else{
                    console.log(response["message"]);
                    
                    }
                },
                error:function(response){
                  console.log(response);
                }
        });

        function changeStatus(){
        
        var v_status = $("#status").val(); 
        var v_id = {{$id}}
                 
        $.ajax({
                 dataType: 'json',
                 url:'https://jugotk3.000webhostapp.com/admin-change-order-status.blade.php',
                 type:'post',
                data:{id:v_id,status:v_status},
                success:function(response){ 
                    if(response["status"] == 1){ 
                    console.log(response["message"]);

                    }else{
                    console.log(response["message"]);
                    
                    }
                },
                error:function(response){
                  console.log(response);
                }
        });


        if(v_status == "Entregado"){

        
         var user_id = $("#user-id").val();
        
         console.log("Mandaremos un push a el usuario:" + user_id);

         $.ajax({
                 dataType: 'json',
                 url:'https://jugotk3.000webhostapp.com/push.blade.php',
                 type:'post',
                data:{id:user_id},
                success:function(response){ 
                    if(response["status"] == 1){ 
                    console.log(response["message"]);

                    }else{
                    console.log(response["message"]);
                    
                    }
                },
                error:function(response){
                  console.log(response);
                }
        });


        }else{

        }

        }

    </script>
</html>
