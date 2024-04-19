<?php
session_start();
if(isset($_SESSION["user"])){
    $name = $_SESSION["user"];
    $datos = $_SESSION["datos"];
    $idfilm;

   

}else{
    header("Location: ./");
}

include("conection.php");

?>

<?php
include("./templates/header.php");
?>

<h1>Welcome <?php echo $name; ?></h1>
<div>
    <hr>
    <h2>What film would you like to rent?</h2>
</div>

    
   
    <div id="films-container">
        <?php
        include("data.php");
            $sql = "select * from film";
            $stmt = $conn->prepare($sql);
            $stmt-> execute();
            $filmList = $stmt->fetchAll();
            foreach ($filmList as $film) {
                ?>
                <div>
                    
                    <h3><?php echo $film['name']; ?></h3>
                    
                    <img src="assets/img/<?php echo $film['img']; ?>"/>
                    
                    <p>Available: <?php echo $film['available'] ? 'Yes' : 'No'; ?></p>
                    
                    <p>Category: <?php echo getCategoryById($film['idcategory']) ; ?></p>
                    <div id="ShowCorrectBtn">
                    <?php

                        if($film['available']==true){
                            echo "<a href='rent.php?idfilm=" . $film["idfilm"] . "'><button>Rent this film</button></a>";
                        }else{
                            echo "<a href='devolution.php?idfilm=" . $film["idfilm"] . "'><button onclick=\"returnFilm(" . $film['idfilm'] . ")\">Return this film</button></a>";
                        }


                        
                    ?>
                    </div>

                    
                </div>
                <?php
            }


        ?>
    </div>

    <?php
include("./templates/footer.php");
?>