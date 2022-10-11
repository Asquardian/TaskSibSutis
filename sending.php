<html>
<?php function Error($error){
            header("Location: http://localhost/TaskSibSutis/index.php?Error=" . $error);
            exit();
} ?>

<body>
    <p>
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
    </p>
</body>

</html>