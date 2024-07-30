<?php
session_start(); // Asegúrate de iniciar la sesión al comienzo de cada script que necesite acceder a las variables de sesión.

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
  // El usuario está autenticado
  $userId = $_SESSION['user_id'];
  $roleId = $_SESSION['role_id'];
  $nombre = $_SESSION['nombre'];
  $email = $_SESSION['email'];


} else {
  // El usuario no está autenticado, puedes redirigirlo a una página de inicio de sesión.
  header("Location: ../index.html");
  exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.1/css/all.css" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/styleHome.css">

</head>

<body>

    <div class="sidebar">
        <div class="logo-details">
            <i class="fas fa-stream"></i>
            <div class="logo_name">IA</div>
            <i class="fas fa-stream" id="btn"></i>

        </div>
        <ul class="nav-list">

            <li>
                <a href="#">
                    <i class="fas fa-search"></i>


                    <span class="links_name">Search</span>
                </a>
                <span class="tooltip">Search</span>
            </li>
            <li>
                <a href="#">
                    <i class="fas fa-th-large"></i>

                    <span class="links_name">Dashboard</span>
                </a>
                <span class="tooltip">Dashboard</span>
            </li>
            <li>
                <a href="#">
                    <i class="far fa-user"></i>
                    <span class="links_name">User</span>
                </a>
                <span class="tooltip">User</span>
            </li>
            <li>
                <a href="#">
                    <i class="far fa-comments"></i>
                    <span class="links_name">Messages</span>
                </a>
                <span class="tooltip">Messages</span>
            </li>
            <li>
                <a href="#">
                    <i class="fas fa-chart-pie"></i>
                    <span class="links_name">Analytics</span>
                </a>
                <span class="tooltip">Analytics</span>
            </li>
            <li>
                <a href="#">
                    <i class="far fa-folder"></i>
                    <span class="links_name">File Manager</span>
                </a>
                <span class="tooltip">Files</span>
            </li>
            <li>
                <a href="#">
                    <i class="fas fa-file-alt"></i>
                    <span class="links_name">Order</span>
                </a>
                <span class="tooltip">Order</span>
            </li>
            <li>
                <a href="#">
                    <i class="far fa-hdd"></i>
                    <span class="links_name">Saved</span>
                </a>
                <span class="tooltip">Saved</span>
            </li>
            <li>
                <a href="#">
                    <i class="fas fa-cogs"></i>
                    <span class="links_name">Setting</span>
                </a>
                <span class="tooltip">Setting</span>
            </li>
            <li class="profile">
                <div class="profile-details">
                    <!--<img src="profile.jpg" alt="profileImg">-->
                    <i class="far fa-user"></i>
                    <div class="name_job">
                        <div class="name"><?php  echo $nombre ?> </div>
                        <div class="job"><?php  echo $email ?></div>
                    </div>
                </div>
                <i class='bx bx-log-out' id="log_out"></i>
            </li>
        </ul>
    </div>
    <section class="home-section">
        <div class="text">Dashboard</div>

         
    </section>
    <script>
        let sidebar = document.querySelector(".sidebar");
        let closeBtn = document.querySelector("#btn");
        let searchBtn = document.querySelector(".bx-search");
        let navList = document.querySelector(".nav-list");

        closeBtn.addEventListener("click", () => {
            sidebar.classList.toggle("open");
            navList.classList.toggle("scroll");
            menuBtnChange();//calling the function(optional)
        });

        searchBtn.addEventListener("click", () => { // Sidebar open when you click on the search icon
            sidebar.classList.toggle("open");
            menuBtnChange(); //calling the function(optional)
        });

        // following are the code to change sidebar button(optional)
        function menuBtnChange() {
            if (sidebar.classList.contains("open")) {
                closeBtn.classList.replace("bx-menu", "bx-menu-alt-right");//replacing the icons class
            } else {
                closeBtn.classList.replace("bx-menu-alt-right", "bx-menu");//replacing the icons class
            }
        }

    </script>
</body>

</html>