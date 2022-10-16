<html>


    
<head>
    <link href="/TaskSibSutis/css/style.css" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
<?php
require('DBconnection/connect.php');
    if(session_status() == 2){
        unset($_SESSION["nameOfStudent"]);
        session_destroy();
    }
    function Error($error){
        header("Location: http://localhost/TaskSibSutis/login.php?Error=" . $error);
        exit();
    }?>

    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
</head>

<body>
    <div><?php ?></div> <form action="auth.php"><button action="auth.php" type='sumbit' class='btn btn-primary btnAuth'>Регистрация</button></form>
    <div class="border border-info container divBorder"
        style="width: 50%;margin-top:2%; padding-left: 10%; padding-right: 10%;">
        <div class="error center">
            <img src="/TaskSibSutis/img/sibs.jpg" class="sibsutisLogo"><p class="Error">
            <?php 
            
            if(isset($_POST["login"]) && isset($_POST["password"])){
                try{
                    $isLogined = loginSQL($_POST["login"], md5($_POST["password"]));
                    $row = $isLogined->fetch_array(MYSQLI_ASSOC);
                    if(empty($row)){
                        throw new Exception("Ошибка 1");
                    }
                    session_start();
                    $_SESSION["nameOfStudent"] = $row["fullName"];
                    $_SESSION["group"] = $row["groupName"];
                    $_SESSION["id"] = $row["id"];
                    $_SESSION["admin"] = $row['admin'];
                    header("Location: http://localhost/TaskSibSutis/index.php");
                }
                catch(Exception $e){
                    echo $e->getMessage();
                }
            }

            if(isset($_GET['Error'])){
                $temp = $_GET['Error'];
                switch($temp){
                    case 0:
                        echo 'Ошибка! Введите все данные!</p>';
                        break;
                }
            }
            ?></p>
        </div>
        <form action="login.php" method="POST">
            <div class="row mb-5">
                <div class="row mb-5">
                    <label class="col-lg-3 ">Логин:</label>
                    <div class="col-lg-9"><input class="form-control" name="login" type="text"></input></div>
                </div>
                <div class="row mb-5">
                    <label class="col-lg-3  ">Пароль:</label>
                    <div class="col-lg-9"><input class="form-control" type="password" name="password"></div>
                </div>
            </div>
    </div>
    <div class="center">
        <button class="btn btn-primary btnMargin">Войти</button>
    </div>
    </form>

    </div>
</body>

</html>