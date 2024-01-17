<!DOCTYPE html>
<html lang="en">

<head>
    <title>Private Home</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="css/style.css" />
</head>

<body>
    <?php
    session_start();
    include('./config/cnxDb.php');
    $userId = $_SESSION['id'];
    $importUser = "SELECT * FROM users WHERE id_user = '$userId'";
    $result = mysqli_query($connection, $importUser);

    if ($result) {

        $userData = mysqli_fetch_assoc($result);
        if ($userData) {
            $userName = $userData['user_name'];
        }
    }
    ?>
    <section class="ftco-section">
        <div class="container-lg">
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-10">

                    <div class="text-wrap p-4 p-lg-5 text-center w-100">
                        <div class="text w-100">
                            <h2>Welcome to Home</h2>
                            <h3><?php echo $userName ?></h3>

                        </div>
                    </div>

                </div>
            </div>
        </div>
        </div>

    </section>
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script>
        // Afficher le toast après le chargement de la page
        $(document).ready(function() {
            $('.toast').toast('show');
        });
    </script>
</body>

</html>