<html>
<?php function Error(){
            header("Location: http://localhost/TaskSibSutis/index.php?Error=1");
            exit();
} ?>
<body>
    <p>
        <?php 
 
        if(isset($_POST["nameOfStudent"]) && isset($_POST["group"]) && isset($_POST["amount"]) && isset($_POST["kindOf"])){
            $arrayState[0] = $_POST["nameOfStudent"];
            $arrayState[1] = $_POST["group"];
            $arrayState[2] = $_POST["amount"];
            $arrayState[3] = $_POST["kindOf"];
            foreach($arrayState as $elem){
                if ($elem == ""){
                    Error();
                }
            }
            echo "Ваше Имя $arrayState[0], группа $arrayState[1], количество $arrayState[2] с $arrayState[3]";
        }
        else {
            Error();
        }
 
 ?>
    </p>
</body>

</html>