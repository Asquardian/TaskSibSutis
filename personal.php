<?php
function personalCab()
{
    if ($_SESSION["admin"] == 0) {
        printf("<form action='logout.php' class='btnAuth'>%s %s %s <button type='sumbit' class='btn btn-primary'>Выйти</button></form>
            <form action='userRoom.php' class='btnAuth'><button type='sumbit' class='btn btn-primary'>Посмотреть заявки</button></form>", $_SESSION["group"], $_SESSION["nameOfStudent"], $_SESSION["id"]);
    } else {
        printf("<form action='login.php' class='btnAuth'> <button type='sumbit' class='btn btn-primary'>Выйти</button></form>");
    }
}

function personalOut()
{
    printf("<form action='logout.php' class='btnAuth'>%s %s %s <button type='sumbit' class='btn btn-primary'>Выйти</button></form>
                <form action='index.php' class='btnAuth'><button type='sumbit' class='btn btn-primary'>Вернуться к созданию заявок</button></form>", $_SESSION["group"], $_SESSION["nameOfStudent"], $_SESSION["id"]);
}

?>