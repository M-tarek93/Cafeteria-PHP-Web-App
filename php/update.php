<><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
        require_once('databaseHandler.php');
        $db = new databaseHandler();
        $db->updateUser($_POST['username'], $_POST['email'], $_POST['room'], $_POST['ext'], $_FILES['image']['name'], $_POST['role']);
        var_dump($_POST);
        $db->disconnectDB();
        $path = "../images/" . $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], $path);
        header("Location: allUsers.php");
?>

</body>
</html>