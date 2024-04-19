<?php
session_start();
if(isset($_SESSION["user"])){
    $name = $_SESSION["user"];
    $datos = $_SESSION["datos"];

   

}else{
    header("Location: ./");
}

include("conection.php");

if(isset($_GET["category"])){
    $category = $_GET["category"];

    $sql = "SELECT f.name, f.available, f.img, c.name AS category_name 
            FROM film AS f
            INNER JOIN category AS c ON f.category_id = c.idcategory 
            WHERE c.idcategory = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute([$category]);
    $movies = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($movies);
    exit();
}
?>

<?php
include("./templates/header.php");
?>

<h1>Welcome <?php echo $name; ?></h1>
<div>
    <hr>
    <h2>What film would you like to rent?</h2>
</div>
<button class="category-button" data-category-idcategory="1">Action</button>
    <button class="category-button" data-category-idcategory="2">Drama</button>
    <button class="category-button" data-category-idcategory="3">Horror</button>
    
   
    <div id="films-container"></div>

    <?php
include("./templates/footer.php");
?>