<?php
    if(isset($_POST["date"])){
        session_start();
        include("conection.php");
        include("data.php");
        $sql = "insert into rent (idfilm, iduser, devolution) values(?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt -> bindParam(1, $_GET["idfilm"]);
        $stmt-> bindParam(2, getIdUserByUsername($_SESSION["user"]));
        $stmt->bindParam(3, $_POST["date"]);
        $stmt->execute();
        $sql = "update film set available = ? where idfilm = ?";
        $stm = $conn->prepare($sql);
        $value = 0;
        $stm -> bindParam(1, $value);
        $stm -> bindParam(2, $_GET["idfilm"]);
        $stm->execute();


        header("Location: user.php");
    }
?>

<?php
    include("./templates/header.php");
    include("data.php");
    $film = getFilmById($_GET["idfilm"]);
    
?>



<h3>Film name: <?php  echo $film["name"] ?> </h3>;
<img src="assets/img/<?php echo $film['img']; ?>"/>
<p>Category: <?php echo getCategoryById($film['idcategory']) ; ?></p>
<form action="" method="post">
<label>Selec Return Date</label>
<input type="datetime-local" name="date">
<input type="submit" value="Rent this film">

</form>




<?php
    include("./templates/footer.php");
?>