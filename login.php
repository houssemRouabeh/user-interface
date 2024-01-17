<!DOCTYPE html>
<html lang="en">

<head>
  <title>Login</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900&display=swap" rel="stylesheet" />

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
  <link rel="stylesheet" href="css/style.css" />
</head>

<body>
  <section class="ftco-section">
    <div class="container-lg">
      <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
          <div class="wrap d-md-flex">
            <div class="text-wrap p-4 p-lg-5 text-center d-flex align-items-center order-md-last">
              <div class="text w-100">
                <h2>Welcome to login</h2>
                <p>Don't have an account?</p>
                <a href="register.php" class="btn btn-white btn-outline-white">Sign Up</a>
              </div>
            </div>
            <div class="login-wrap p-4 p-lg-5">
              <div class="d-flex">
                <div class="w-100">
                  <h2 class="mb-4">Sign In</h2>
                </div>
              </div>
              <form method="POST" action="" class="signin-form">
                <div class="form-group mb-3">
                  <label class="label" for="userName">Username</label>
                  <input id="userName" type="text" class="form-control" placeholder="Username" name="userName" />
                </div>
                <div class="form-group mb-3">
                  <label class="label" for="password">Password</label>
                  <input id="password" type="password" class="form-control" placeholder="Password" name="password" />
                </div>
                <div class="form-group">
                  <button type="submit" name="submitBtn" class="form-control btn btn-primary submit px-3">
                    Sign In
                  </button>
                </div>
            </div>
            </form>
            <?php
            session_start();
            include('./config/cnxDb.php');

            if (isset($_POST['submitBtn'])) {
              $userName =  $_POST['userName'];
              $password = $_POST['password'];

              if (!$userName || !$password) {
                // Verification que les champs obligatoires sont remplis
                $_SESSION['toastMessage'] = "Please fill all fields.";
              } else {
                // Verification que le username saisie existe dans la abase de donnee
                $checkUserQuery = "SELECT * FROM users WHERE user_name = '$userName'";
                $result = mysqli_query($connection, $checkUserQuery);

                if ($result) {

                  $userData = mysqli_fetch_assoc($result);
                  if ($userData) {
                    // Username already exists
                    if (password_verify($password, $userData['password'])) {
                      $_SESSION['id'] = $userData['id_user'];
                      $_SESSION['toastMessage'] = "Connected  success.";
                      header("Location: private.php");
                    } else {
                      $_SESSION['toastMessage'] = "Incorrect password.";
                    }
                  } else {
                    // Username not exists
                    $_SESSION['toastMessage'] = "The username does not exists!";
                  }
                }
              }
            }
            // Afficher le toast si présent dans la session

            $toastMessage = isset($_SESSION['toastMessage']) ? $_SESSION['toastMessage'] : "";
            unset($_SESSION['toastMessage']); // Supprimer le message de la session après utilisation
            ?>
          </div>
        </div>
      </div>
    </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-6 mx-auto mt-5">
          <?php
          // Afficher le toast uniquement si le message n'est pas vide
          if (!empty($toastMessage)) {
            echo '<div class="toast-container position-static">
      <div class="toast" role="alert" aria-live="assertive" aria-atomic="true"  data-delay="3000">
        <div class="toast-header">
          <strong class="me-auto">Notification</strong>
          <small class="text-body-secondary">just now</small>
          <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
        ' . $toastMessage . '
        </div>
      </div>';
          }
          ?>
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