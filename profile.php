<?php session_start(); 
if (!$_SESSION['user']) {
  header("Location: ../index.php");
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Личный кабинет пользователя</title>
  </head>
  <body style="background-color: #eee;">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <a class="navbar-brand" href="#">Блог програмистов</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">О блоге</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#"></a>
        </li>
      </ul>
    </div>
      <a href="./vendor/logout.php" class="btn btn-danger mx-4"><i class="fas fa-sign-out-alt"></i>Выйти</a>
  </div>
</nav>
    <section class="mt-lg-5">
      <div class="container d-flex">
      <div class="card" style="width: 21rem;">
          <img src="<?= $_SESSION["user"]['avatar'] ?>" class="card-img-top" alt="...">
        <div class="card-body">
          <a href="settings.php" class="w-100 btn btn-primary">Редактировать данные</a>
          <a href="settings.php" class="w-100 btn btn-primary mt-1">Обновить аватар</a>
        </div>
      </div>

      <div class="card placeholder-glow  h-100 mx-3" style="width: 20rem;">
        <div class="card-body">
        <h5 class="card-title"><?= $_SESSION["user"]['fullname'] ?></h5>
        <p class="card-text"><?= $_SESSION["user"]['phone'] ?></p>
          <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
      </div>
      <form action="./vendor/postAdd.php" method="post" class="p-2 bg-light col-md-5">
            <h4 class="rounded-3">Форма добавления статьи</h4>
            <div class="mb-3">
              <label for="exampleInputTitle" class="form-label">Введите заголовок статьи</label>
              <input type="text" class="form-control" name="title" id="exampleInputTitle">
            </div>

            <div class="mb-3">
              <label for="exampleInputDescription" class="form-label">Введите описание статьи</label>
              <textarea type="text" class="form-control" name="description" id="exampleInputDescription"></textarea>
            </div>

            <div class="mb-3">
              <label for="exampleInputAuthor" class="form-label">Введите автора статьи</label>
              <input type="text" class="form-control" name="author" id="exampleInputAuthor">
            </div>
    
            <button type="submit" class="btn btn-primary"><i class="fab fa-plus"></i>Добавить статью</button>
            <?php 
          
          if ($_SESSION['error_post'] === true){
            ?>
            
            <div class="alert alert-danger mt-3" role="alert"><?= $_SESSION['error_post_msg'] ?></div>

            <?php
          }
            unset($_SESSION['error_post']);
            unset($_SESSION['error_post_msg']);
        ?>
                  <?php 
          
          if ($_SESSION['success_post'] === true){
            ?>
            
            <div class="alert alert-success  mt-3" role="alert"><?= $_SESSION['success_post_msg'] ?></div>

            <?php
          }
            unset($_SESSION['success_post']);
            unset($_SESSION['success_post_msg']);
        ?>
        </form>
      </div>
    </section>
<section>
  <div class="container">
    <h2 class="mt-5 mb-4">Все статьи блога</h2>
      <div class="d-flex flex-wrap">
      <?php 

$db = mysqli_connect('localhost','root','root','blog');
$posts = mysqli_query($db, "SELECT * FROM `posts`");
$posts = mysqli_fetch_all($posts);

foreach ($posts as $post){
  ?>
        <div class="card mb-4 me-4" style="width: 35rem;">
          <div class="card-body mb-2">
              <h5 class="card-title"><?= $post[1] ?></h5>
              <p class="card-text"><?= $post[2] ?></p>
              <p class="card-text"><?= $post[3] ?></p>
              <a href="view.php?id=<?= $post[0] ?>" class="btn btn-primary">Открыть статью</a>
              <a href="postUpdate.php?id=<?= $post[0] ?>" class="btn btn-success">Редактировать статью</a>
              <a href="./vendor/delete.php?id=<?= $post[0] ?>" class="btn btn-danger">Удалить статью</a>
        </div>
      </div>
      <?php
             }
            ?>
    </div>
  </div>
</section>
      <div class="container">
        <footer class="mt-lg-5 d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
          <p class="col-md-4 mb-0 text-muted">© 2021 Company, Inc</p>
          <a href="/" class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
            <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
          </a>

          <ul class="nav col-md-4 justify-content-end">
            <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Home</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Features</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">About</a></li>
          </ul>
       </footer>
    </div>
  </div>
    <!-- /.row -->
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
    -->
  </body>
</html>