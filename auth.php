<html>
<?php
    if(session_status() == 2){
        unset($_SESSION["nameOfStudent"]);
        session_destroy();
    }
    function auth(){
    try{
        $arrayState["nameOfStudent"] = $_POST["nameOfStudent"];
        $arrayState["group"] = $_POST["group"];
        $arrayState["UID"] = $_POST["UID"];
        $arrayState["UIDPhis"] = $_POST["UIDPhis"];
        $arrayState["login"] = $_POST["login"];
        $arrayState["password"] = md5($_POST["password"]);
        if (substr_count($arrayState["nameOfStudent"], " ") < 2){ 
            throw new Exception("Введите имя и фамилию"); 
            } 
        if(strpos($arrayState["group"], "-" ) && strlen($arrayState["group"]) < 6){ 
            throw new Exception("Неверное имя группы"); 
            }
            require_once('DBconnection/connect.php');
            newUserToDataBase($arrayState);
            session_start();
            $_SESSION["nameOfStudent"] =  $arrayState["nameOfStudent"];
            $_SESSION["group"] =  $arrayState["group"];
            header("Location: http://localhost/TaskSibSutis/index.php");
                 
        } catch(Exception $e){ 
            echo $error = $e->getMessage();
        } 
    }

?>   
<head>
    <link href="/TaskSibSutis/css/style.css" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
</head>

<body>
    <form action="login.php"><button action="login.php" type='sumbit' class='btn btn-primary btnAuth'>Войти</button></form>
    
    <div class="border border-info container divBorder"
        style="width: 50%;margin-top:2%; padding-left: 10%; padding-right: 10%;">
        <div class="error center">
            <img src="/TaskSibSutis/img/sibs.jpg" class="sibsutisLogo"><p class="Error"><?php 
            if($_POST){
                auth();
            }
            ?></p>
        </div>
        <form action="auth.php" method="POST">
            <div class="row mb-5">
                <label class="col-lg-3 ">ФИО</label>
                <div class="col-lg-9"><input class="form-control" name="nameOfStudent" type="text"></input></div>
            </div>
            <div class="row mb-5">
                <label class="col-lg-3 ">Логин</label>
                <div class="col-lg-9"><input class="form-control" name="login" type="text"></input></div>
            </div>
            <div class="row mb-5">
                <label class="col-lg-3 ">Пароль</label>
                <div class="col-lg-9"><input class="form-control" name="password" type="password"></input></div>
            </div>
            <div class="row mb-5">
                <label class="col-lg-3 ">Группа:</label>
                <div class="col-lg-9"><input class="form-control" name="group" type="text"></input></div>
            </div>
            <div class="row mb-5">
                <label class="col-lg-3  ">UID зачетки</label>
                <div class="col-lg-9"><input class="form-control" name="UID" type="text"></input></div>
            </div>
            <div class="row mb-5">
                <label class="col-lg-3  ">UID Физ. лица</label>
                <div class="col-lg-9"><input class="form-control" name="UIDPhis" type="text"></input></div>
            </div>
    </div>
    </div>
    </div>
    <div class="center">
        <button class="btn btn-primary btnMargin">Регистрация</button>
    </div>
    </form>

    </div>
</body>

</html>