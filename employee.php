<?php
session_start();
if (isset($_SESSION["employee"])) {
    $name = $_SESSION["employee"];
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include("conection.php");

        $idemployee = $_SESSION["idemployee"];
        $available = true;
       
        $category = $_POST["category"];
        $image = $_FILES["image"]["name"];
        $target_dir = "assets/img/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);

        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Verificar si la imagen es real o falsa
        if (isset($_POST["submit"])) {
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if ($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }

        // Verificar si el archivo ya existe
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        // Verificar el tamaño de la imagen
        if ($_FILES["image"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Permitir ciertos formatos de archivo
       
        //Guardas imagen y actualizas bbddd
        if ($uploadOk == 0) {
            
            // Si todo está bien, intenta subir el archivo
        } else {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                //echo "The file ". htmlspecialchars( basename( $_FILES["image"]["name"])). " has been uploaded.";
                // Preparar la consulta SQL para insertar los datos en la tabla de películas
                $sql = "INSERT INTO film (name, img, idcategory, idemployee, available) VALUES (?, ?, ?, ?,?)";
                $stmt = $conn->prepare($sql);
    
                // Vincular los parámetros

                $stmt->bindParam(1, $name);
                $stmt->bindParam(2, $image);
                $stmt->bindParam(3, $category);
                $stmt->bindParam(4, $idemployee);
                $stmt->bindParam(5,$available);
               
    
                // Ejecutar la consulta
                try {
                    $stmt->execute();
                   
                } catch (PDOException $e) {
                    echo "Error: " . $e->getMessage();
                }
    
                // Cerrar la conexión
                $conn = null;
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }

    }
 else {
    header("Location: ./");
}

?>
<?php
include("./templates/header.php");
?>
<h1>Welcome <?php echo $name; ?></h1>
<!-- Formulario para subir películas -->
<form action="" method="post" enctype="multipart/form-data">
    <label for="movie_name">Movie Name:</label><br>
    <input type="text" id="movie_name" name="name"><br>
    <label for="category">Category:</label><br>
    <select id="category" name="category">
        <?php
        include("conection.php");
        $sql = "Select idcategory,name from category";
        $result = $conn->prepare($sql);
        $result->execute();

        // Check if there are categories available
        if ($result->rowCount() > 0) {
            $categorias = $result->fetchAll();
            // Iterar sobre las categorías y generar las opciones del select
            foreach ($categorias as $categoria) {
                echo "<option value='" . $categoria['idcategory'] . "'>" . $categoria['name'] . "</option>";
            }
        } else {
            echo "No categories available";
        }
        ?>
    </select><br><br>
    <label for="movie_image">Movie Image:</label><br>
    <input type="file" id="movie_image" name="image" accept="image/*" required><br><br>
    <input type="submit" value="Upload Movie">
</form>

<?php
include("./templates/footer.php");
?>