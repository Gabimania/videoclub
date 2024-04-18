<?php
    session_start();
    if (isset($_SESSION["user"])) {
        header("Location: user.php");
        exit();
    }
    if (isset($_SESSION["employee"])) {
        header("Location: employee.php");
        exit();
    }
    if (isset($_POST["email"])) {
    
        include("conection.php");
        $email = $_POST["email"];
        $password = $_POST["password"];
        $sql = "select * from user where email=? and password=?";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1,$email);
        $stmt->bindParam(2,$password);
        $stmt->execute();
        if ($stmt->rowCount()>0) {
            $_SESSION["user"] = $email;
            $_SESSION["datos"] = "otros datos";
            header("Location: user.php");
            exit();
        } else {
            $error = "Email or password incorrect";
        }
    }
    ?>



<?php
include("./templates/header.php")
?>

<section class="h-100 gradient-form" style="background-color: #eee;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-xl-10">
                <div class="card rounded-3 text-black">
                    <div class="row g-0">
                        <div class="col-lg-6">
                            <div class="card-body p-md-5 mx-md-4">

                                <div class="text-center">
                                    <img src="assets/img/peliculas.webp" style="width: 185px;" alt="logo">
                                    <h4 class="mt-1 mb-5 pb-1">Welcome to Gabimania Videoclub</h4>
                                </div>

                                <form action="" method= "post">
                                    <p>Please , login to your account</p>

                                    <div data-mdb-input-init class="form-outline mb-4">
                                        <input type="email" name= "email" id="form2Example11" class="form-control" placeholder="Phone number or email address" />
                                        <label class="form-label" for="form2Example11">Username</label>
                                    </div>

                                    <div data-mdb-input-init class="form-outline mb-4">
                                        <input type="password" name="password" id="form2Example22" class="form-control" />
                                        <label class="form-label" for="form2Example22">Password</label>
                                    </div>

                                    <div class="text-center pt-1 mb-5 pb-1">
                                        <button data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="submit">Log
                                            in</button>
                                            <?php
                                            if (isset($error)) {
                                                echo "<p>" . $error . "</p>";
                                            }
                                            ?>
                                        <a class="text-muted" href="#!">Forgot password?</a>
                                    </div>

                                    <div class="d-flex align-items-center justify-content-center pb-4">
                                        <p class="mb-0 me-2">Don't have an account?</p>
                                       <a href="register.php"> <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-danger">Create new</button></a>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center pb-4">
                                        <p class="mb-0 me-2">Just for employees</p>
                                       <a href="loginemployee.php"> <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-danger" >Identification</button></a>
                                    </div>

                                </form>

                            </div>
                        </div>
                        <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                            <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                                <h4 class="mb-4">We are more than just a videoclub</h4>
                                <p class="small mb-0">At Gabimania, we transcend the conventional notion of a mere videoclub. We are a haven where cherished moments are crafted, memories are made, and bonds are strengthened.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
include("./templates/footer.php")
?>