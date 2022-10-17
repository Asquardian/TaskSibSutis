<?php

function connectToDataBase() //Попытка присоединения к базе данных 
{
    $link = mysqli_connect("localhost", "root", "");
    if (!$link) { //Не удалось подключиться
        print("Ошибка: Невозможно подключиться к MySQL " . mysqli_connect_error());
        return $link;
    }
    try {
        $db_selected = mysqli_select_db($link, 'studentsRequests'); //SELECT FROM
    } catch (Exception $e) {
        $sql = 'CREATE DATABASE studentsRequests';

        if (mysqli_query($link, $sql)) {
            echo "Database my_db created successfully\n";
        } else {
            echo 'Error creating database: ' . mysqli_error($link) . "\n";
        }
    }
    $sql = "SELECT fullName FROM requests";
    try {
        $result = mysqli_query($link, $sql);
    } catch (Exception $e) {
        //Если нет таблицы
        $sql = "CREATE TABLE requests  ( 
                    `id` BINARY(16) PRIMARY KEY,
                    `fullName` TEXT CHARACTER SET utf8 COLLATE utf8_bin NOT NULL ,
                    `groupName` TEXT CHARACTER SET utf8 COLLATE utf8_bin NOT NULL ,
                    `amount` INT NOT NULL , `kindOf` TEXT CHARACTER SET utf8 COLLATE utf8_bin NOT NULL, `status`  BIT NOT NULL) 
                    ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_bin;";


        mysqli_query($link, $sql);
    }


    //UserAuth
    $sql = "SELECT fullName FROM users";
    try {
        $result = mysqli_query($link, $sql);
    } catch (Exception $e) {
        $sql = "CREATE TABLE users  (
                                `id` BINARY(16) PRIMARY KEY,
                                `fullName` TEXT CHARACTER SET utf8 COLLATE utf8_bin NOT NULL ,
                                `groupName` TEXT CHARACTER SET utf8 COLLATE utf8_bin NOT NULL ,
                                `UID` TEXT CHARACTER SET utf8 COLLATE utf8_bin NOT NULL ,
                                `UIDPhis` TEXT CHARACTER SET utf8 COLLATE utf8_bin NOT NULL ,
                                `login` TEXT CHARACTER SET utf8 COLLATE utf8_bin NOT NULL ,
                                `password` TEXT CHARACTER SET utf8 COLLATE utf8_bin NOT NULL, UNIQUE(`login`),
                                `admin` BIT NOT NULL DEFAULT 0 ) 
                                ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_bin;";
        mysqli_query($link, $sql);

    }
    return $link;
}

function requestToDataBase($fullName, $group, $amount, $kindOf) //Записываем заявку пользователя
{
    $link = connectToDataBase();
    if (!$link) {
        return 1;
    }
    $fullName = filter_var($fullName, FILTER_SANITIZE_STRING);
    $group = filter_var($group, FILTER_SANITIZE_STRING);
    $amount = filter_var($amount, FILTER_SANITIZE_STRING);
    $kindOf = filter_var($kindOf, FILTER_SANITIZE_STRING);
    $sql = "INSERT INTO requests (id, fullName, groupName, amount, kindOf, status)"
        . "VALUES (UUID(), '$fullName', '$group', '$amount', '$kindOf', 0)";

    mysqli_set_charset($link, 'utf8');
    mysqli_query($link, $sql);
    mysqli_close($link);
}


function getFromDataBase($link, $where, $sortBy, $sort = "DESC"){ //Получаем из базы данных пользователей
    $order = "";
    if($sortBy != ""){//Если есть запрос
        $order = " ORDER BY ".$sortBy. " ".$sort;
    }
    $whereOption = "";
    if ($where != "") {
        $whereOption = "WHERE " . $where;
    }
    $query = 'SELECT * FROM requests ' . $whereOption . ' ' . $order;
    try {
        $result = mysqli_query($link, $query);
        if (!$result) {
            echo 'Неверный запрос: ' . mysql_error();
            throw new Exception("\nВойдите позже");
        }
        return $result;
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

function changeStatus($link, $id, $status)
{
    $change = "UPDATE requests SET status = $status WHERE id = '$id'";
    if ($link->query($change) === TRUE) {

    } else {
        echo "Произошла ошибка: " . $conn->error;
    }
}

function deleteSQL($link, $id)
{
    $change = "DELETE FROM requests WHERE id = '$id'";
    if ($link->query($change) == TRUE) {

    } else {
        echo "Произошла ошибка: " . $conn->error;
    }
}

function deleteSQLByUser($link, $id)
{
    $change = "DELETE FROM requests WHERE id = '$id' AND status = '0'";
    if ($link->query($change) == TRUE) {

    } else {
        echo "Произошла ошибка: " . $conn->error;
    }
}

function newUserToDataBase($arrayState)
{ //Новый пользователь
    $link = connectToDataBase();
    if (!$link) {
        return 1;
    }
    $nameOfStudent = filter_var($arrayState["nameOfStudent"], FILTER_SANITIZE_STRING);
    $group = filter_var($arrayState["group"], FILTER_SANITIZE_STRING);
    $UID = filter_var($arrayState["UID"], FILTER_SANITIZE_STRING);
    $UIDPhis = filter_var($arrayState["UIDPhis"], FILTER_SANITIZE_STRING);
    $login = filter_var($arrayState["login"], FILTER_SANITIZE_STRING);
    $password = filter_var($arrayState["password"], FILTER_SANITIZE_STRING);
    $sql = "INSERT INTO users (id, fullName, groupName, `UID`, `UIDPhis`, `login`, `password`)"
        . "VALUES (UUID(), '$nameOfStudent', '$group', '$UID', '$UIDPhis', '$login', '$password')";
    
    mysqli_set_charset($link, 'utf8');
    mysqli_query($link, $sql);
    $sql = "SELECT id FROM users WHERE `login` = '$login'";
    $result = mysqli_query($link, $sql);
    $row = $result->fetch_array(MYSQLI_ASSOC);
    mysqli_close($link);
    return $row["id"]; //возвращаем id пользователя для сессии
}

function loginSQL($login, $password)
{
    $link = connectToDataBase();
    try{
        $result = $link->query("SELECT * FROM users WHERE login = '$login'"); //получаем пароль
        if(!$result){

            echo 'Неверный запрос: ' . mysqli_error($link);
            throw new Exception("\nНеверный логин или пароль");
        }
        $row = $result->fetch_array(MYSQLI_ASSOC);
        if (!password_verify($password, $row['password'])) {
            echo 'Неверный запрос: ' . mysqli_error($link);
            throw new Exception("\nНеверный логин или пароль");
        }
        mysqli_close($link);
        return $row;
    } catch (Exception $e) {

    }
}