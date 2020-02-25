<?php session_start();
if ($_SESSION['role']!="1"){
    header("Location: ../html/login.html");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cafeteria</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='../assets/bootstrap/bootstrap.min.css' >
    <link rel="stylesheet" href="../assets/css/orders.css">
   </head>

<body>
    <h1>Current Orders</h1>
    <br>
    <?php
        require_once('databaseHandler.php');
        $db = new databaseHandler();
        $result = $db->getCurrentOrders();
        $orderDetails=array();
        foreach ($result as $order) {
            array_push($orderDetails,$db->getMyOrderDetails($order['id']));
        } 
    ?>
    
    <table class="table table-bordered justify-content-center text-center " id="orders_table">
        <tr class="thead-dark">
            <th>Order Date</th>
            <th>View</th>
            <th>Username</th>
            <th>Room</th>
            <th>Ext.</th>
            <th>Action</th>
        </tr>
        <script>
            let table = document.getElementById("orders_table");
            let total_amount=[];
            <?= json_encode($result) ?>.forEach(myFun);
            function myFun(item,index){
                tr = document.createElement("tr");
                tr.setAttribute("row_id",item["id"]);
                tr.innerHTML= "<td>" + item["date"] + "</td>"
                + "<td>" +  "<button class='not_viewd btn btn-info' onclick=" + "collapse(this); return false;' id=" + item["id"] + ">+</button>" + "</td>"
                + "<td>" + item["username"] + "</td>"
                + "<td>" + item["room"] + "</td>"
                + "<td>" + item["ext"] + "</td>"
                + "<td>" + "<button class='deliver btn btn-info' id=" + item["id"] + ">Deliver</button></td>";
                table.append(tr);
                total_amount[item["id"]]=item["total_price"];
            }
        </script>
        <script src='http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js'></script>
        <script>
            $('.deliver').click(function () {
            var deliver_id = $(this).attr('id');
            var info = 'oId=' + deliver_id;
            $.ajax({
                type: 'POST',
                url: 'deliverOrder.php',
                data: info,
                success: function () {
                    // alert('Order Cancelled Successfully!');
                }
            });
            $('tr[row_id='+deliver_id+']').remove();
            return false;
          });

         
            

            order=document.querySelectorAll('[row_id]');
            let orderDetails=<?= json_encode($orderDetails) ?>;
            for (let i = 0; i < order.length; i++) {
                    for (let index = 0; index <  orderDetails.length; index++) {
                        for (let index2 = 0; index2 < orderDetails[index].length; index2++) {
                            if(orderDetails[index][index2][0]['order_id']== order[i].getAttribute("row_id")){
                            tr_order_detail = document.createElement("tr");
                            tr_order_detail.setAttribute("class","hidden order");
                            tr_order_detail.setAttribute("name",orderDetails[index][index2][0]['order_id']);
                            tr_order_detail.innerHTML="<td colspan='3'><table><tr>"
                            +"<th>Product Name</th>"
                            +"<th>Product Price</th>"
                            +"<th>Product Image</th>"+"</tr>"

                            +"<tr>"
                            +"<td>"+orderDetails[index][index2][0]['name']+"</td>"
                            +"<td>"+orderDetails[index][index2][0]["price"]+"</td>"
                            +"<td>" + "<img width='70' height='70' src='../assets/images/products/" + orderDetails[index][index2][0]['image'] + "'></td>"

                            +"</tr></table></td>";

                            order[i].parentNode.insertBefore(tr_order_detail,order[i].nextSibling);
                        }             
                    }
                           
                }
                    
            }
            function collapse(cell){
            target = document.getElementsByName(cell.getAttribute('id'));

            for (let index = 0; index < target.length; index++) {
                if (target[index].style.display == 'table-row') {
                    cell.innerHTML = '+';
                    target[index].style.display = 'none';
                } else {
                    cell.innerHTML = '-';
                    target[index].style.display = 'table-row';
                }
            }    
            
            }
        </script>
    </table>
</body>
</html>