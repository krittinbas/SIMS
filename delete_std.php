<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "310844K_k";
    $dbname = "students";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        echo "เชื่อมต่อฐานข้อมูลไม่สำเร็จ โปรดลองเชื่อมต่อใหม่อีกครั้ง";
        die();
    }

    $id = (int)$_GET['id'];
    $sql = "DELETE FROM std_info WHERE id = $id";

    $result = $conn->query($sql);

    if ($result) {
        header('Location:student.php');
    } else {
        header('Location:student.php');
    }

    ?>
</body>

</html>