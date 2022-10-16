<html>
<?php
    function Error($error){
        header("Location: http://localhost/TaskSibSutis/auth.php?Error=" . $error);
        exit();
    }

    
    session_start();
    if(!isset($_SESSION["nameOfStudent"])){
        header("Location: http://localhost/TaskSibSutis/login.php");
    }
    if (isset($_SESSION["admin"])){
        if ($_SESSION["admin"] == 1){
            header('Location: admin.php');
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
    <div><?php 
                require('personal.php');
                personalCab();
                ?></div>
    <div class="border border-info container divBorder"
        style="width: 50%;margin-top:2%; padding-left: 10%; padding-right: 10%;">
        <div class="error center">
            <img src="/TaskSibSutis/img/sibs.jpg" class="sibsutisLogo">
            <?php 
            if(isset($_GET['Error'])){
                $temp = $_GET['Error'];
                switch($temp){
                    case 0:
                        echo '<p class="Error">Ошибка! Введите все данные!</p>';
                        break;
                    case 1:
                        echo '<p class="Error">Ошибка! Неверные данные о количестве!</p>';
                        break;
                }
            }
            ?>
        </div>
        <form action="sending.php" method="POST">
            <div class="row mb-5">
                <div class="row mb-5">
                    <label class="col-lg-3 ">Количество:</label>
                    <div class="col-lg-9"><input class="form-control" name="amount" type="number"></input></div>
                </div>
                <div class="row mb-5">
                    <label class="col-lg-3  ">Вид справки:</label>
                    <div class="col-lg-9"><select class="form-control" name="kindOf">
                            <option>об успеваемости</option>
                            <option>по месту требования</option>
                            <option>о пенсионном фонде</option>
                            <option>о движениях студента</option>
                            <option>о приглашении иностранному студенту</option>
                        </select></div>
                </div>
            </div>
    </div>
    <div class="center">
        <button class="btn btn-primary btnMargin">Зарегистрироваться</button>
    </div>
    </form>

    </div>
</body>

</html>