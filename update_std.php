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
    $select_data = "SELECT * FROM std_info WHERE id=$id";
    $result_data = mysqli_query($conn, $select_data);

    if (mysqli_num_rows($result_data) > 0) {
        $row = mysqli_fetch_assoc($result_data);
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = (int)$_POST['id'];
        $en_name = (string)$_POST['en_name'];
        $en_surname = (string)$_POST['en_surname'];
        $th_name = (string)$_POST['th_name'];
        $th_surname = (string)$_POST['th_surname'];
        $major_code = (string)$_POST['major_code'];
        $email = (string)$_POST['email'];
        $validate = true;
        if (empty($id) || empty($en_name) || empty($en_surname) || empty($th_name) || empty($th_surname)) {
            echo 'ข้อมูลบางฟิลด์ไม่ควรเป็นค่าว่าง โปรดกรอกข้อมูลให้ครบถ้วนแล้วลองอีกครั้ง';
            $validate = false;
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "รูปแบบอีเมลไม่ถูกต้อง โปรดกรอกอีเมลให้ถูกต้องตามรูปแบบ";
            $validate = false;
        } else if (strlen($major_code) > 3) {
            echo "รหัสสาขาควรมีแค่ 3 อักขระเท่านั้น โปรดกรอกรหัสสาขาที่ถูกต้องตามรูปแบบ";
            $validate = false;
        }
        if (!$validate) {
            echo "<a href='insert_std_form.php'>ทำรายการใหม่</a>";
        } else {
            $sql = "UPDATE std_info SET en_name = '$en_name', en_surname = '$en_surname', th_name = '$th_name', th_surname = '$th_surname', major_code = '$major_code', email = '$email' WHERE id = $id";

            $result = mysqli_query($conn, $sql);

            if ($result) {
                echo "เเก้ไขข้อมูลเรียบร้อย";
            } else {
                echo "เกิดข้อผิดพลาบางอย่าง ข้อความการผิดพลาด: " . mysqli_error($conn);
                echo "<a href='insert_std_form.php'>กลับไปที่หน้าเพจ</a>";
                die();
            }
        }
    }
    ?>
    <form class="container" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method='POST'>
        <label for="">id</label>
        <input type="text" name="id" value="<?php echo $row['id']; ?>">
        <label for="">en_name</label>
        <input type="text" name="en_name" value="<?php echo $row['en_name']; ?>">
        <label for="">en_surname</label>
        <input type="text" name="en_surname" value="<?php echo $row['en_surname']; ?>">
        <label for="">th_name</label>
        <input type="text" name="th_name" value="<?php echo $row['th_name']; ?>">
        <label for="">th_surname</label>
        <input type="text" name="th_surname" value="<?php echo $row['th_surname']; ?>">
        <label for="">majorcode</label>
        <input type="text" name="major_code" value="<?php echo $row['major_code']; ?>">
        <label for="">email</label>
        <input type="text" name="email" value="<?php echo $row['email']; ?>">
        <button type="submit">Submit</button>
    </form>
    <?php echo "<a href='student.php'>back to main page</a>"; ?>
</body>

</html>