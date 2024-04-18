<?php
include("./templates/header.php");
?>

<?php
session_start();
if (isset($_SESSION["employee"])) {
    $name = $_SESSION["employee"];
   
} else {
    header("Location: ./");
}

?>

<h1>Welcome <?php echo $name; ?></h1>
<!-- Formulario para subir películas -->
<form action="" method="post" enctype="multipart/form-data">
    <label for="movie_name">Movie Name:</label><br>
    <input type="text" id="movie_name" name="movie_name"><br>
    <label for="category">Category:</label><br>
    <select id="category" name="category">
        <?php
        include("conection.php");
        $sql = "Select name from category";
        $result = $conn->prepare($sql);
        $result->execute();

        // Check if there are categories available
        if ($result->rowCount() > 0) {
            $categorias = $result->fetchAll();
            // Iterar sobre las categorías y generar las opciones del select
            foreach ($categorias as $categoria) {
                echo "<option value='" . $categoria['name'] . "'>" . $categoria['name'] . "</option>";
            }
        } else {
            echo "No categories available";
        }
        ?>
    </select><br><br>
    <label for="movie_image">Movie Image:</label><br>
    <input type="file" id="movie_image" name="movie_image"><br><br>
    <input type="submit" value="Upload Movie">
</form>

<?php
include("./templates/footer.php");
?>