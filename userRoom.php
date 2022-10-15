<?php
require('DBconnection/connect.php');
$sortGroup = "DESC";
try{
    $link = connectToDataBase();
    if($link == false){
        throw new Exception("Error to connect");
    }
    if(isset($_POST['accept'])) {
        changeStatus($link, $_POST['accept'], 1);
    }
    if(isset($_POST['decline'])) {
        changeStatus($link, $_POST['decline'], 0);
    }
    if(isset($_POST['delete'])) {
        deleteSQLByUser($link, $_POST['delete']);
    }
    if(isset($_GET['like'])){
        $sortGroup = $_GET['like'];
    }
    if(isset($_GET['sort'])){
        $db = getFromDataBase($link, $_GET['sort'], $sortGroup);
    }
    else
        $db = getFromDataBase($link, "");

}
catch(Exception $e){
    echo $e->getMessage();
}

function sorted($name){
    if(isset($_GET['sort']) && isset($_GET['like'])) {
        if($_GET['sort'] == $name && $_GET['like'] == "DESC")
            return "ASC";
    }
    return "DESC";
}

function printRecords($db){
    while ($row = $db->fetch_array(MYSQLI_ASSOC)) {
        echo "<tr>";
        printf ("<td scope='row'>%s</td>", $row["amount"]);
        printf ("<td scope='row'>%s</td>", $row["kindOf"]);
        if($row["status"] == 0)
            printf ("<td scope='row'>Принято</td>");
        else
            printf ("<td scope='row'>Выполнено</td>");
        printf ("<td scope='row'><button name='delete' type='sumbit' value='%s' class='btn btn-danger'>Удалить</button></td>", $row["id"]);
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
<div class="border border-info container divBorder">
    <form action="" method="POST">
        <table class="table">
            <thead>
            <tr>
                <th scope="col"><a href="userRoom.php?sort=amount&like=<?php echo sorted("amount")?>">Количество</a></th>
                <th scope="col"><a href="userRoom.php?sort=kindOf&like=<?php echo sorted("kindOf")?>">Справка</a></th>
                <th scope="col"><a href="userRoom.php?sort=status&like=<?php echo sorted("status")?>">Статус</a></th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            <?php printRecords($db);?>
            </tbody>
        </table>
    </form>

</div>

</body>

</html>