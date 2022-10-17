<?php
session_start();
if (isset($_SESSION["admin"])) {
    if ($_SESSION["admin"] == 1) {
        header('Location: admin.php');
    }
}
if (!isset($_SESSION["nameOfStudent"])) {
    header("Location: http://localhost/TaskSibSutis/login.php");
}
require('DBconnection/connect.php');
$sortGroup = "DESC";
try {
    $link = connectToDataBase();
    if ($link == false) {
        throw new Exception("Error to connect");
    }
    if (isset($_POST['delete'])) {
        deleteSQLByUser($link, $_POST['delete']);
    }
    $whereOption = "fullName = " . '"' . $_SESSION["nameOfStudent"] . '"' . "AND groupName = " . '"' . $_SESSION["group"] . '"';
    
    $db = getFromDataBase($link, $whereOption, "");

} catch (Exception $e) {
    echo $e->getMessage();
}

function printRecords($db)
{
    while ($row = $db->fetch_array(MYSQLI_ASSOC)) {
        echo "<tr>";
        printf("<td scope='row'>%s</td>", $row["amount"]);
        printf("<td scope='row'>%s</td>", $row["kindOf"]);
        if ($row["status"] == 0)
            printf("<td scope='row'>Принято</td>");
        else
            printf("<td scope='row'>Выполнено</td>");
        printf("<td scope='row'><button name='delete' type='sumbit' value='%s' class='btn btn-danger'>Удалить</button></td>", $row["id"]);
        echo "</tr>";
    }
}


?>

<html>

<head>
    <link href="/TaskSibSutis/css/style.css" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.6.0.js">
    </script>
</head>

<body>
    <div><?php
    require('personal.php');
    personalOut();
    ?></div>
    <div class="border border-info container divBorder">
        <form action="" method="POST">
            <table class="table" id="userRequestsTable">
                <thead>
                    <tr>
                        <th scope="col" onclick="sortTable(0)">Количество</th>
                        <th scope="col" onclick="sortTable(1)">Справка</th>
                        <th scope="col">Статус</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php printRecords($db); ?>
                </tbody>
            </table>
        </form>

    </div>
    <script type="text/javascript" src="js/js.js"></script>

</body>

</html>