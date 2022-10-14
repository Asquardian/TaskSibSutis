<?php

function connectToDataBase()
{
    $link = mysqli_connect("localhost", "root", "");
    if ($link == false) {
        print("Ошибка: Невозможно подключиться к MySQL " . mysqli_connect_error());
        return $link;
    }
    try {
        $db_selected = mysqli_select_db($link, 'studentsRequests');
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

        $sql = "CREATE TABLE requests  (
                    `id` BINARY(16) PRIMARY KEY,
                    `fullName` TEXT CHARACTER SET utf8 COLLATE utf8_bin NOT NULL ,
                    `groupName` TEXT CHARACTER SET utf8 COLLATE utf8_bin NOT NULL ,
                    `amount` INT NOT NULL , `kindOf` TEXT CHARACTER SET utf8 COLLATE utf8_bin NOT NULL, `status`  BIT NOT NULL) 
                    ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_bin;";
        mysqli_query($link, $sql);
        return $link;
    }
    return $link;
}

function requestToDataBase($fullName, $group, $amount, $kindOf)
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

function getFromDataBase($link, $sortBy, $sort="DESC"){
    $order = "";
    if($sortBy != ""){
        $order = " ORDER BY ".$sortBy. " ".$sort;
    }
    $query = 'SELECT * FROM requests'. $order;
    try{
        $result = mysqli_query($link, $query);
        if(!$result){
            echo 'Неверный запрос: ' . mysql_error();
            throw new Exception("\nВойдите позже");
        }
        return $result;
    }
    catch(Exception $e){
        echo $e->getMessage();
    }
}

function changeStatus($link, $id, $status){
    $change = "UPDATE requests SET status = $status WHERE id = '$id'";
    if ($link->query($change) === TRUE) {
        
      } else {
        echo "Произошла ошибка: " . $conn->error;
      }
}

function deleteSQL($link, $id){
    $change = "DELETE FROM requests WHERE id = '$id'";
    if ($link->query($change) === TRUE) {
        
    } else {
      echo "Произошла ошибка: " . $conn->error;
    }
}