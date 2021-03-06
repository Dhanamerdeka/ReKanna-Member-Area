<?php
  include('../koneksi.php'); //agar index terhubung dengan database, maka koneksi sebagai penghubung harus di include
?>
<?php
session_start();

if (!isset($_SESSION["username"])) {
	echo "Anda harus login dulu <br><a href='/index.php'>Klik disini</a>";
	exit;
}

$level=$_SESSION["level"];

if ($level!=3) {
    echo "Anda tidak punya akses pada halaman ini";
    exit;
}

$id_user=$_SESSION["id_user"];
$nama=$_SESSION["nama"];
$email=$_SESSION["email"];

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../style/favicon.ico">

    <title>Re:Kanna - Dashboard</title>

    <!-- Bootstrap core CSS -->
    <link href="../style/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../style/custom/offcanvas.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
  </head>

  <body class="bg-light">

    <nav class="navbar navbar-expand-md fixed-top navbar-dark bg-dark">
      <a class="navbar-brand" href="/member/index.php"><i class="far fa-grin-squint-tears"></i> Re:Kanna</a>
      <button class="navbar-toggler p-0 border-0" type="button" data-toggle="offcanvas">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="#"><i class="fas fa-cat"></i> MyAnimeList <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#"><i class="fas fa-book-open"></i> Manga Reader</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#"><i class="fas fa-th-large"></i> Streaming Tabs</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-terminal"></i> Bypass</a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item" href="#"><i class="fas fa-angle-right"></i> Oploverz</a>
              <a class="dropdown-item" href="#"><i class="fas fa-angle-right"></i> Kusonime</a>
              <a class="dropdown-item" href="#"><i class="fas fa-angle-right"></i> Samehadaku</a>
            </div>
          </li>
        </ul>
          <a href="/logout.php"><button class="btn btn-outline-primary my-2 my-sm-0"><i class="fas fa-sign-out-alt"></i> Logout</button></a>
      </div>
    </nav>

    <main role="main" class="container">
      <div class="d-flex align-items-center p-3 my-3 text-white-50 bg-purple rounded box-shadow">
        <img class="mr-3" src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-outline.svg" alt="" width="48" height="48">
        <div class="lh-100">
          <h6 class="mb-0 text-white lh-100"><? echo $nama ?></h6>
          <small><? echo $email ?></small>
        </div>
      </div>

      <div class="my-3 p-3 bg-white rounded box-shadow">
        <h6 class="border-bottom border-gray pb-2 mb-0">Theme updates</h6>
        <?php
      // jalankan query untuk menampilkan semua data diurutkan berdasarkan nim
      $query = "SELECT * FROM rekanna ORDER BY id ASC";
      $result = mysqli_query($kon, $query);
      //mengecek apakah ada error ketika menjalankan query
      if(!$result){
        die ("Query Error: ".mysqli_errno($kon).
           " - ".mysqli_error($kon));
      }

      // hasil query akan disimpan dalam variabel $data dalam bentuk array
      // kemudian dicetak dengan perulangan while
      while($row = mysqli_fetch_assoc($result))
      {
      ?>
        <div class="media text-muted pt-3">
          <img data-src="holder.js/32x32?theme=thumb&bg=e83e8c&fg=e83e8c&size=1" alt="" class="mr-2 rounded">
          <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
            <div class="d-flex justify-content-between align-items-center w-100">
              <strong class="text-gray-dark"><?php echo $row['versi']; ?></strong>
              <a href="<?php echo $row['link']; ?>">Download</a>
            </div>
            <span class="d-block"><?php echo $row['keterangan']; ?></span>
          </div>
        </div>
        <?php
        //end of theme cuy
      }
      ?>
        <small class="d-block text-right mt-3">
          <a href=mailto:admin@kanna.my.id>Hubungi Admin</a>
        </small>
      </div>
    </main>
<?php include('../footer.php') ?>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../style/assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="../style/assets/js/vendor/popper.min.js"></script>
    <script src="../style/js/bootstrap.min.js"></script>
    <script src="../style/assets/js/vendor/holder.min.js"></script>
    <script src="../style/custom/offcanvas.js"></script>
  </body>
</html>