<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cafeteria</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='../assets/bootstrap/bootstrap.min.css' >
    <link rel="stylesheet" href="../assets/css/orders.css">
    <script src='http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js'></script>

</head>

<body>
    <h1>Checks</h1>
    <br>
    <form method="POST" action="">
        <label for="from_date">From:</label>
        <input type="date" name="from_date">
        <label for="to_date">To:</label>
        <input type="date" name="to_date">
        <select name="user" id="user">
                    <option value="all">All Users</option>
        </select>
    <?php
        require_once('databaseHandler.php');
        $db = new databaseHandler();
        $result = $db->getUserNames();
    ?>
        <script>
                var userSelect = document.getElementById('user');
                <?= json_encode($result) ?>.forEach(viewUsers);
                function viewUsers(item,index){
                    user_option = document.createElement("option");
                    user_option.innerHTML=item["username"];
                    userSelect.appendChild(user_option);
                }
        </script>
        <input type="submit" value="submit">
    </form>

    <?php
    if (isset($_POST["from_date"]) && isset($_POST["to_date"]) && isset($_POST["user"])){
        if($_POST["user"] == "all"){
        $allOrders = $db->getChecks($_POST["from_date"],$_POST["to_date"]);
        $ordersIds = $db->getOrderId($_POST["from_date"],$_POST["to_date"]);
        }else{
            $allOrders = $db->getChecks1($_POST["user"],$_POST["from_date"],$_POST["to_date"]);
            $ordersIds = $db->getOrderId1($_POST["user"],$_POST["from_date"],$_POST["to_date"]);
        }
    }else{
        $allOrders = $db->getChecks2();
        $ordersIds = $db->getAllOrderId();
    }

    $order=array();
    $orderDetails=array();

    foreach ($ordersIds as $row) {
        array_push($order,$db->getCheckOrder($row['id']));
        array_push($orderDetails,$db->getMyOrderDetails($row['id']));
    }
    


    ?>
    
    <table class="table table-bordered justify-content-center text-center " id="checks_table" style="border-collapse:collapse;">
        <thead class="thead-dark">
            <th>Username</th>
            <th>View</th>
            <th>Total Amount</th>
        </thead>
        <script>
            let x=0;
            let table = document.getElementById("checks_table");
            <?= json_encode($allOrders) ?>.forEach(displayChecks);
            check=document.getElementsByClassName('check');

            <?= json_encode($order) ?>.forEach(displayOrders);
            order=document.querySelectorAll('[order_id]');
            let orderDetails=<?= json_encode($orderDetails) ?>;
    
                

            function displayChecks(item,index){
                tr = document.createElement("tr");
                tr.setAttribute("row_id",item["username"]);
                tr.setAttribute("row_from_date","<?= $_POST["from_date"] ?>");
                tr.setAttribute("row_to_date","<?= $_POST["to_date"] ?>");
                tr.setAttribute("class","check");

                tr.innerHTML= "<td>" + item["username"] + "</td>"
                + "<td><button id=" + item["username"] + " class='btn btn-info' onclick='collapse(this)'" + "</button>+</td>"
                + "<td>" + item["total_price"] + "</td>";

                table.appendChild(tr);
            }
            function displayOrders(item,index){
                for (let index = 0; index < check.length; index++) {
                    if(item[0]['username']==check[index].getAttribute("row_id")){
                        tr_order = document.createElement("tr");
                        tr_order.setAttribute("class","hidden order");
                        tr_order.setAttribute("order_id",item[0]['id']);
                        tr_order.setAttribute("name",item[0]['username']);
                        tr_order.innerHTML="<td colspan='3'><table><tr>"
                        +"<th>Date</th>"
                        +"<th>View</th>"
                        +"<th>Total Amount</th>"+"</tr>"

                        +"<tr>"
                        +"<td>"+item[0]['date']+"</td>"
                        +"<td><button id=" + item[0]['id'] + " class='btn btn-info' onclick='collapse(this)'" + "</button>+</td>"
                        +"<td>"+item[0]['total_price']+"</td>"

                        +"</tr></table></td>";

                        check[index].parentNode.insertBefore(tr_order,check[index].nextSibling);
                    }                    
                }                
                };


                for (let i = 0; i < order.length; i++) {
                    for (let index = 0; index <  orderDetails.length; index++) {
                    
                    for (let index2 = 0; index2 < orderDetails[index].length; index2++) {
                        if(orderDetails[index][index2][0]['order_id']== order[i].getAttribute("order_id")){
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