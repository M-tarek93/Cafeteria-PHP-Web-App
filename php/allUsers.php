<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cafeteria</title>
    <link rel="shortcut icon" type="image/x-icon" href="../assets/images/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1 class="col-5">All Users</h1>
    <?php
    require_once('databaseHandler.php');
    $db = new databaseHandler();
    $result = $db->getUsers();
    echo '<table class="table table-bordered justify-content-center text-center "><tr class="thead-dark"><th>Username</th><th>Email</th><th>Room</th>
    <th>Ext</th><th>Profile Picture</th><th>Role</th><th colspan=2>Action</th></tr>';
    foreach ($result as $user) {
        echo "<tr><td class='align-middle'>" . 
        $user['username'].
         "</td><td class='align-middle'>" .
          $user['email']. 
          "</td><td class='align-middle'>" .
           $user['room'].
            "</td>
        <td class='align-middle'>" . $user['ext']. "</td><td class='align-middle'><img class='img-thumbnail rounded' width=200px height=200px src=../assets/images/avatars/" . $user['profile_pic'] . ">
        </td><td class='align-middle'>". $user['role']."</td><td class='align-middle'>
        <a href=editUser.php/?username=".$user['username']."&email=".$user['email']."&room=".$user['room']."&ext=".$user['ext']."&role=".$user['role'].">
        <button class='btn btn-primary'>update</button></a></td><td class='align-middle'><a href=deleteUser.php/?username=".$user['username'].">
        <button class='btn btn-danger'>delete</button></a></td></tr>" ;
    }
    echo '</table>';
?>
<script async id="slcLiveChat" src="https://widget.sonetel.com/SonetelWidget.min.js" data-account-id="206903051"></script>
</body>
</html>