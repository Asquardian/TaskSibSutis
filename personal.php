<?php
    function personalCab(){
         printf ("<form action='login.php' class='btnAuth'>%s %s %s <button type='sumbit' class='btn btn-primary'>Выйти</button></form>
            <form action='userRoom.php' class='btnAuth'><button type='sumbit' class='btn btn-primary'>Посмотреть заявки</button></form>", $_SESSION["group"], $_SESSION["nameOfStudent"], $_SESSION["id"]);
    }
   ?>