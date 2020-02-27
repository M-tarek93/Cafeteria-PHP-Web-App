<?php
session_start();
if(empty($_SESSION["username"])){
    header("Location: ../html/login.html");
}else
$user=$_SESSION["username"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cafeteria</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='../assets/bootstrap/bootstrap.min.css' >
    <link rel="stylesheet" href="../assets/css/orders.css">
    <link rel="stylesheet" href="../assets/css/home.css">
   </head>


<body>
    <header>
    <ul class="navLinks">
                <li><a href="homeuser.php">Home</a></li>
                <li><a href="myOrders.php">MY Orders</a></li>
                <div class="logandreg">
                <li><a   href="../php/logout.php">Log Out</a></li>
                </div>
    </ul>
    </header>
    <h1>My Orders</h1>
    <br>
    <form method="POST" action="">
        <label for="from_date">From:</label>
        <input type="date" name="from_date">
        <label for="to_date">To:</label>
        <input type="date" name="to_date">
        <input type="submit" value="submit">
    </form>
    <?php
        require_once('databaseHandler.php');
        $db = new databaseHandler();

    if  (isset($_POST["from_date"]) && isset($_POST["to_date"])) {
        $result = $db->getMyOrders($user,$_POST["from_date"],$_POST["to_date"]);
        $ordersIds = $db->getOrderId1($user,$_POST["from_date"],$_POST["to_date"]);
    }else{
        $result = $db->getAllOrdersWithUsername($user);
        $ordersIds = $db->getAllOrderIdByUsername($user);
    }
     $orderDetails=array();
        foreach ($ordersIds as $order) {
            array_push($orderDetails,$db->getMyOrderDetails($order['id']));
        } 
    ?>
    
    <table class="table table-bordered justify-content-center text-center " id="orders_table">
        <tr class="thead-dark">
            <th>Order Date</th>
            <th>View</th>
            <th>Status</th>
            <th>Amount</th>
            <th>Action</th>
        </tr>
        <script>
            let table = document.getElementById("orders_table");
            let total_amount=0;
            let item_status=["Processing","Out for Delivery","Done"];
            <?= json_encode($result) ?>.forEach(myFun);
            function myFun(item,index){
                tr = document.createElement("tr");
                tr.setAttribute("row_id",item["id"]);
                tr.innerHTML= "<td>" + item["date"] + "</td>"
                + "<td><button class='not_viewd btn btn-info' onclick=" + "collapse(this); return false;' id=" + item["id"] + ">+</button></td>"
                + "<td>" + item_status[item["status"]-1] + "</td>"
                + "<td>" + item["total_price"] + "</td>";
                if(item["status"] == "1"){
                    tr.innerHTML += "<td>" + "<button class='cancel btn btn-danger' id=" + item["id"] + ">Cancel</button></td>";
                }
                table.append(tr);
                total_amount+=item["total_price"];
            }
        </script>
        <script src='http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js'></script>
        <script>
            $('.cancel').click(function () {
            var cancel_id = $(this).attr('id');
            var info = 'oId=' + cancel_id;
            $.ajax({
                type: 'POST',
                url: 'cancelOrder.php',
                data: info,
                success: function () {
                    // alert('Order Cancelled Successfully!');
                }
            });
            $('tr[row_id='+cancel_id+']').remove();
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
    <div class="col-9 text-right ">
    <h2>Total Amount</h2>
    <h3 id="total"></h3>
    <script>document.getElementById("total").innerHTML = total_amount;</script>
    </div>
</body>
</html>