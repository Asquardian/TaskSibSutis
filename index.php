<html>

<head>
    <link href="/TaskSibSutis/css/style.css" rel="stylesheet" type="text/css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
</head>

<body>
    <?php 
    $temp = false;
    if(isset($_GET['Error'])){
        $temp = $_GET['Error'];
    }
    if($temp == true){
        echo '<p class="Error">Ошибка!</p>';
    }?>
    <form class="FormStyle" action="sending.php" method="POST">
        <div class="InputField">
            <label>ФИО:</label><input name="nameOfStudent" type="text"></input>
        </div>
        <div class="InputField">
            <label>Группа::</label><input name="group" type="text"></input>
        </div>
        <div class="InputField">
            <label>Количество:</label><input name="amount" type="number"></input>
        </div>
        <button>Отправить заявку</button>
    </form>
</body>

</html>