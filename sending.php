<html>
<link href="/TaskSibSutis/css/style.css" rel="stylesheet" type="text/css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

<script src="https://code.jquery.com/jquery-3.6.0.js"></script>

<?php function Error($error){
            header("Location: http://localhost/TaskSibSutis/index.php?Error=" . $error);
            exit();
        } 
        require 'vendor/autoload.php';
        ?>
<style>
p,
h1 {
    font-family: "Times New Roman", Times, serif;
}
</style>

<body>
    <?php 
        try {
            if(isset($_POST["nameOfStudent"]) && isset($_POST["group"]) &&
             isset($_POST["amount"])){
                $arrayState[0] = $_POST["nameOfStudent"];
                $arrayState[1] = $_POST["group"];
                $arrayState[2] = $_POST["amount"];
                $arrayState[3] = $_POST["kindOf"];
                foreach($arrayState as $elem){
                    if ($elem == ""){
                        throw new Exception("0");
                    }
                }
                if($arrayState[2] > 5 || $arrayState[2] < 1){
                    throw new Exception("1");
                }
            }
        }
        catch(Exception $e){
            $stringError = $e->getMessage();
            Error($stringError);
        }

    ?>
    <div class="border border-info container divBorder">
        <div>
            <img src="/TaskSibSutis/img/sibs.jpg" class="sibsutisLogo">
        </div>
        <h1 class="center">Заявление</h1><br></br>
        <p class="center">Я, студент группы <?php echo "$arrayState[1] $arrayState[0]";?>, подал завяление на получение
            справки
            <?php echo "$arrayState[3]";?> в количестве <?php echo "$arrayState[2]";?>.<br></br><br></br></p>
        <p class="signature">Подпись студента ________________<br><br>Печать ________________</p><br></br>
    </div>
    <div class="center btnMargin">
        <button class="btn btn-primary">Скачать и записаться</button>
    </div>
</body>

</html>