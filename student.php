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
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    $servername = "localhost";
    $username = "root";
    $password = "310844K_k";
    $dbname = "students";
    // create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
        die("Connection failed " . mysqli_connect_error());
    }
    ?>
    <div class="message">
        <?php
        echo "Connected successfully</br>";
        ?>
    </div>
    <div class="container">
        <?php
        $sql = "SELECT * FROM std_info";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                echo "<table border='1'>";
                echo "<tr><th>id</th><th>name</th><th>surname</th>";
                echo "<th>ชื่อ</th><th>นามสกุล</th>";
                echo "<th>Major</th><th>email</th></tr>";
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr><td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["en_name"] . "</td>";
                    echo "<td>" . $row["en_surname"] . "</td>";
                    echo "<td>" . $row["th_name"] . "</td>";
                    echo "<td>" . $row["th_surname"] . "</td>";
                    echo "<td>" . $row["major_code"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>" . "<a href='update_std.php?id=" . $row['id'] . "'>update</a>" . "</td>";
                    echo "<td>" . "<a href='delete_std.php?id=" . $row['id'] . "'>delete</a>" . "</td></tr>";
                }
                echo "</table>";
            }
        }
        ?>
    </div>
    <div class="button">
        <?php
        echo "<a href='insert_std_form.php'>Insert new record</a>";
        mysqli_close($conn);
        ?>
    </div>


</body>

</html>