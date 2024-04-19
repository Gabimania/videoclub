<?php

    function getCategoryById($idcategory){
        include("conection.php");
        $sql = "select name from category where idcategory = :idcategory";
        $stmt = $conn->prepare($sql);
        $stmt -> bindParam(":idcategory", $idcategory);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result[0];
    
    }

    function getFilmById($idfilm){
        include("conection.php");
        $sql = "select * from film where idfilm = :idfilm";
        $stmt = $conn->prepare($sql);
        $stmt -> bindParam(":idfilm", $idfilm);
        $stmt->execute();
        return $stmt->fetchAll()[0];
    }

    function getIdUserByUsername($name){
        include("conection.php");
        $sql = "select iduser from user where name = :name";
        $stmt = $conn->prepare($sql);
        $stmt -> bindParam(":name", $name);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result[0];
    
    }
?>


