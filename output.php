<?php
    session_start();
    $username = $_SESSION['username'];

    if( !isset($_SESSION['login']) ) {
        header("Location: index.php?pesan=belum_login");
        exit;
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

        <!-- Title -->
        <title>Dwelling Palate | Daftar Resep</title>

        <!-- Favicon -->
        <link rel="shortcut icon" type="image/png" href="img/png/apron.png"/>

        <!-- Core Stylesheet -->
        <link rel="stylesheet" href="style.css">
    </head>

    <body>
        <!-- Preloader -->
        <div id="preloader">
            <i class="circle-preloader"></i>
            <img src="img/png/apron.png" alt="">
        </div>

        <!-- ##### Header Area Start ##### -->
        <header class="header-area">

            <!-- Navbar Area -->
            <div class="main-menu">
                <div class="classy-nav-container breakpoint-off">
                    <div class="container">
                        <!-- Menu -->
                        <nav class="classy-navbar justify-content-between" id="deliciousNav">

                            <!-- Logo -->
                            <a class="nav-brand" href="home.php"><img src="img/png/logo.png" alt=""></a>

                            <!-- Navbar Toggler -->
                            <div class="classy-navbar-toggler">
                                <span class="navbarToggler"><span></span><span></span><span></span></span>
                            </div>

                            <!-- Menu -->
                            <div class="classy-menu">

                                <!-- close btn -->
                                <div class="classycloseIcon">
                                    <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                                </div>

                                <!-- Nav Start -->
                                <div class="classynav">
                                    <ul>
                                        <li><a href="home.php">Home</a></li>
                                        <li><a href="home.php#about">Tentang Kami</a></li>
                                        <li class="active"><a href="#">Resep</a>
                                            <ul class="dropdown">
                                                <li><a href="output.php">Daftar Resep</a></li>
                                                <li><a href="form.php">Bagikan Resep</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="home.php#contact">Kontak</a></li>
                                        <li><?php echo "<h6>Hai, ".$username."!</h6>"?>
                                        <a style="background-color: black; color: white;" href=logout.php><i>LOG OUT</i></a></li>
                                    </ul>
                                </div>
                                <!-- Nav End -->
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </header>
        <!-- ##### Header Area End ##### -->

        <center>
            <hr width="90%">
            <!-- ##### Breadcumb Area Start ##### -->
            <a href="output.php">
                <div class="breadcumb-area bg-img bg-overlay" style="background-image: url(img/background/breadcumb.jpg);">
                    <div class="container h-100">
                        <div class="row h-100 align-items-center">
                            <div class="col-12">
                                <div class="breadcumb-text text-center">
                                    <h2>Mau Masak Apa Hari Ini?</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            <!-- ##### Breadcumb Area End ##### -->

            <?php
                include 'koneksi.php';
                $totalapp = 0;
                $app = mysqli_query($konek, 'SELECT * FROM dataresep WHERE kategori = "Appetizer"');
                while($countapp=mysqli_fetch_array($app))
                {
                    $totalapp ++;
                }

                $totalmc = 0;
                $mc = mysqli_query($konek, 'SELECT * FROM dataresep WHERE kategori = "Main Course"');
                while($countmc=mysqli_fetch_array($mc))
                {
                    $totalmc ++;
                }

                $totaldes = 0;
                $des = mysqli_query($konek, 'SELECT * FROM dataresep WHERE kategori = "Dessert"');
                while($countdes=mysqli_fetch_array($des))
                {
                    $totaldes ++;
                }
                ?>

            <div class="row align-items-center mt-30">
                <!-- Single Cool Fact -->
                <div class="col-12 col-sm-8 col-lg-4">
                    <a href='output.php?kategori="Appetizer"'>    
                        <div class="single-cool-fact">
                            <img src="img/png/appetizer.png" alt="">
                            <h3><span class="counter"><?php echo $totalapp;?></span></h3> <!--menampilkan jumlah resep dengan kategori tersebut -->
                            <h6>Appetizer</h6>
                        </div>    
                    </a>
                </div>

                <!-- Single Cool Fact -->
                <div class="col-12 col-sm-8 col-lg-4">
                    <a href='output.php?kategori="Main Course"'>    
                        <div class="single-cool-fact">
                            <img src="img/png/maincourse.png" alt="">
                            <h3><span class="counter"><?php echo $totalmc;?></span></h3>
                            <h6>Main Course</h6>
                        </div>
                    </a>
                </div>

                <!-- Single Cool Fact -->
                <div class="col-12 col-sm-8 col-lg-4">
                    <a href='output.php?kategori="Dessert"'>    
                        <div class="single-cool-fact">
                            <img src="img/png/dessert.png" alt="">
                            <h3><span class="counter"><?php echo $totaldes;?></span></h3>
                            <h6>Dessert</h6>
                        </div>
                    </a>
                </div>
            </div>

        <table border="1">
            <tr>
                <td> <b>Preview</b> </td>
                <td> <b>Judul</b> </td>
                <td> <b>Kategori</b> </td>
                <td> <b>Opsi</b> </td>
            </tr>

            <?php
                // Turn off all error reporting 
                error_reporting(0); 
                if($kategori = $_GET['kategori']){
                    $query = mysqli_query($konek, "SELECT * from dataresep WHERE kategori = $kategori");
                }
                else{
                    $query = mysqli_query($konek, "SELECT * from dataresep");
                }
                while($data=mysqli_fetch_array($query))
                {?>
                    <tr>                            
                        <td><?php echo '<img src="img/preview/preview('.$data['id_resep'].').jpg" width=100px>'; ?>
                        <td><?php echo $data['judul'];?></td>
                        <td><?php echo $data['kategori'];?></td>
                        <td>
                            <a href=recipe_detail.php?id_resep=<?php echo $data['id_resep'];?>><button class="btn dwelling-btn" type="button">Lihat Detail</button></a>
                        </td>
                    <?php }
                    ?>
                    </tr>
        </table>
        <br>
        <h6 class="mt-50"><i> Ingin mengenalkan resep milikmu ke dunia? </i></h6>
        <a href=form.php><button class="btn dwelling-btn" type="button">BAGIKAN RESEP</button></a>
        </center>

        <!-- ##### Footer Area Start ##### -->
        <footer class="footer-area mt-50">
            <div class="container h-100">
                <div class="row h-100">
                    <div class="col-12 h-100 d-flex flex-wrap align-items-center justify-content-between">
                        <!-- Footer Social Info -->
                    <div class="footer-social-info text-right">
                        <a href="https://www.youtube.com/channel/UCZS7zcQi_KROpJM5_PTLsCA/featured" target="_blank"><i class="fa fa-youtube" aria-hidden="true"></i></a>
                        <a href="https://web.facebook.com/rivano.atk"  target="_blank"><i class="fa fa-facebook" aria-hidden="true""></i></a>
                        <a href="https://twitter.com/qifnav"  target="_blank"><i class="fa fa-twitter" aria-hidden="true""></i></a>
                        <a href="https://www.instagram.com/qifnav"  target="_blank"><i class="fa fa-instagram" aria-hidden="true""></i></a>
                        <a href="https://www.linkedin.com/in/rivano-kurniawan-2a40b91a6"  target="_blank"><i class="fa fa-linkedin" aria-hidden="true""></i></a>
                    </div>
                        <!-- Copyright -->
                        <p>Copyright &copy;<script>document.write(new Date().getFullYear());</script> Dwelling Palate Company All rights reserved</p>
                    </div>
                </div>
            </div>
        </footer>
        <!-- ##### Footer Area End ##### -->

        <!-- ##### All Javascript Files ##### -->
        <!-- jQuery-2.2.4 js -->
        <script src="js/jquery/jquery-2.2.4.min.js"></script>
        <!-- Popper js -->
        <script src="js/bootstrap/popper.min.js"></script>
        <!-- Bootstrap js -->
        <script src="js/bootstrap/bootstrap.min.js"></script>
        <!-- All Plugins js -->
        <script src="js/plugins/plugins.js"></script>
        <!-- Active js -->
        <script src="js/active.js"></script>

    </body>
</html>