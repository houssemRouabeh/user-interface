<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="./css/style.css">
    <title>Blogs</title>
</head>
<style>
    .card {
        width: 20vw;
        font-size: 1.2rem;
        background-color: whitesmoke;

    }
</style>

<body>
    <div class="container p-3 w-50">
        <h1 class="text-center">Blogs List</h1>
        <form action="" method="POST">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label ps-5">Blog Title</label>
                <input type="text" name="blog_title" class="form-control" id="exampleFormControlInput1" placeholder="type the blog title here">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label ps-5">Blog Content</label>
                <textarea class="form-control p-4" name="blog_content" id="exampleFormControlTextarea1" rows="3" placeholder="type blog description"></textarea>
            </div>
            <div class="mb-3 text-center">
                <button type="submit" name="save_blog" class="btn btn-primary mb-3">Add New Blog</button>
            </div>
        </form>
    </div>
    <?php
    session_start();
    include('./config/cnxDb.php');
    include 'Blog.php';

    if (isset($_POST['save_blog'])) {

        $blog = new Blog($_POST['blog_title'], $_POST['blog_content'], date('Y-m-d H:i:s'));

        $blog_title = $blog->getTitre();
        $blog_content = $blog->getContenue();
        $created_at = $blog->getDatePublication();

        if (empty($blog_title) || empty($blog_content)) {
            // Verification que les champs obligatoires sont remplis
            $_SESSION['toastMessage'] = "Veuillez remplir tous les champs.";
        } else {
            // Save new blog into the database
            $user_id = $_SESSION['id'];
            $saveBlog_query = "INSERT INTO blogs VALUES ('', '$blog_title', '$blog_content', '$created_at', '$user_id')";
            $insertResult = mysqli_query($connection, $saveBlog_query);

            if ($insertResult) {
                $_SESSION['toastMessage'] = "New Blog saved successfully!";

                // Affichage des blogs enregistrés
                $getBlogs_query = "SELECT * FROM blogs";
                $selectResult = mysqli_query($connection, $getBlogs_query);
                if ($selectResult) {
                    echo '<div class="cards-container p-5 row row-cols row-cols-md-4 g-5">';
                    while ($row = mysqli_fetch_assoc($selectResult)) {
                        echo '<div class="col">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h5 class="card-title">' . $row['blog_title'] . '</h5>
                                        <p class="card-text">' . $row['blog_content'] . '</p>
                                        <p class="card-text"><small class="text-body-secondary">Created ' . $row['blog_date'] . '</small></p>
                                    </div>
                                </div>
                            </div>';
                    }
                    echo '</div><!-- end of row -->';
                } else {
                    echo "Error checking blogs: " . mysqli_error($connection);
                }
            } else {
                $_SESSION['toastMessage'] = "Error adding blog: " . mysqli_error($connection);
            }
        }
        // Afficher le toast si présent dans la session

        $toastMessage = isset($_SESSION['toastMessage']) ? $_SESSION['toastMessage'] : "";
        unset($_SESSION['toastMessage']); // Supprimer le message de la session après utilisation
    }

    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto mt-5">
                <?php
                // Afficher le toast uniquement si le message n'est pas vide
                if (!empty($toastMessage)) {
                    echo '<div class="toast-container">
                                <div class="toast" role="alert" aria-live="assertive" aria-atomic="true"  data-delay="3000">
                                    <div class="toast-header">
                                        <strong class="me-auto">Notification</strong>
                                        <small class="text-body-secondary">just now</small>
                                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                                    </div>
                                    <div class="toast-body">
                                        ' . $toastMessage . '
                                    </div>
                                </div>
                            </div>';
                }
                ?>
            </div>
        </div>
    </div>
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

</html>