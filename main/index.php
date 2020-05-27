<?php 
    session_start();
    if(isset($_SESSION['username'])){ 
        $username = $_SESSION['username'];
        $name = $_SESSION['name'];
        $area = $_SESSION['area'];
        $fiscalia = $_SESSION['fiscalia'];

        include("../env/env.php");
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Forense</title>
        
        <link rel="shortcut icon" href="../assets/img/fge.png" />

        <!--
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        -->

        <!--
        <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
        -->
        <!--<script src="../libs/bootstrap-4.0.0/js/dist/popover.js" ></script>-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

        <link href="../libs/bootstrap-4.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="../libs/blurt-1.0.2/dist/css/blurt.min.css" rel="stylesheet">
        <link href="styles/<?php echo $main_css; ?>" rel="stylesheet">  
        
        <script src="../libs/jquery/jquery-3.2.0.min.js" ></script>
        <script src="../libs/bootstrap-4.0.0/dist/js/bootstrap.min.js" ></script>
        <script src="../libs/plotly/plotly-latest.min.js"></script>
        <script src="../libs/blurt-1.0.2/dist/js/blurt.min.js" ></script>
        <script src="../libs/notify/notify.min.js"></script>
        <script src="js/<?php echo $main_navigation; ?>"></script>
        
    </head>

    <body>

        <nav class="navbar">

            <a class="navbar-brand" href="#">

                <img src="../assets/img/fge_nav.png" alt="" width="50" height="45">

                <?php

                    switch($area){
                        case 0:
                            ?>
                                QUÍMICA Y GENÉTICA FORENSE
                            <?php
                        break;
                        case 1:
                            ?>
                                QUÍMICA FORENSE
                            <?php
                        break;

                        case 2:
                            ?>
                                GENÉTICA FORENSE
                            <?php
                        break;
                    }
                ?>
            </a>


            <form class="form-inline my-2 my-lg-0">
                <div class="btn-group">
                    <button class="btn btn-sm dropdown-toggle" id="user_btn" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span data-feather="user"></span><?php echo ' '.$name ?>
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg-right">
                        <a class="dropdown-item" href="../service/close_session.php">Cerrar sesión</a>
                    </div>
                </div>
            </form>

        </nav>

        <div class="container-fluid">
            
            <div class="row">
            
                <nav class="sidebar" id="sidebar">

                    <div class="sidebar-sticky">

                        <ul class="nav flex-column">

                            <hr/>

                            <a class="nav-title">Bienvenido</a>
                            <a class="nav-username"><?php echo $name ?></a>
                            <a class="nav-username">
                                <?php 
                                    if($area == 0 && $fiscalia == 0){
                                        echo "(Administrador)";
                                    }
                                    if($area == 0 && $fiscalia != 0){
                                        echo "(Coordinador)";
                                    }
                                ?>
                            </a>
                            

                            <hr/>

<?php
                                if($area != 2){
?>

                                    <a class="nav-section">Química Forense</a>

                                    <li class="nav-item">
                                        <a class="nav-link" id="new_chemistry_record" href="">
                                            <span data-feather="file"></span>
                                            Nuevo expediente
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" id="update_chemistry_record" href="">
                                            <span data-feather="folder"></span>
                                            Modificar expediente
                                        </a>
                                    </li>

<?php
                                    if($area == 0 && $fiscalia == 0){
?>   

                                        <li class="nav-item">
                                            <a class="nav-link" id="chemistry_record" href="">
                                                <span data-feather="folder"></span>
                                                Consultas
                                            </a>
                                        </li>

                                        

                                        <li class="nav-item">
                                            <a class="nav-link" id="chart_chemistry_record" href="">
                                                <span data-feather="bar-chart-2"></span>
                                                Gráficas
                                            </a>
                                        </li>

<?php
                                    }
                                }

                                if($area != 1 && ($fiscalia == 4 || $fiscalia == 0)){
?>

                                    <a class="nav-section">Genética Forense</a>

                                    <li class="nav-item">
                                        <a class="nav-link" id="new_genetic_record" href="">
                                            <span data-feather="file"></span>
                                            Nuevo expediente
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" id="update_genetic_record" href="">
                                            <span data-feather="folder"></span>
                                            Modificar expediente
                                        </a>
                                    </li>

                                    <?php

                                    if($area == 0 && $fiscalia == 0){

                                    ?>
                                    
                                    <li class="nav-item">
                                        <a class="nav-link" id="genetic_record" href="">
                                            <span data-feather="folder"></span>
                                            Consultas
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" id="chart_genetic_record" href="">
                                            <span data-feather="bar-chart-2"></span>
                                            Gráficas
                                        </a>
                                    </li>                         

<?php
                                    }
                                }
                                
                                if($area == 0){
?>

                                    <a class="nav-section">Catálogos</a>

                                    <li class="nav-item">
                                        <a class="nav-link" id="authority_crud" href="">
                                            <span data-feather="file"></span>
                                            Autoridad solicitante
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" id="object_crud" href="">
                                            <span data-feather="file"></span>
                                            Objeto de tipo de muestra
                                        </a>
                                    </li>

<?php         
                                }
?>

                        </ul>
                        
                    </div>

                </nav>
            

                <div class="content">

                    <div id="container">

                        <div class="page-header" style="height: 800px;">
                            <h1 class="title" id="titulo" >Bienvenido</h1>
                            <br>
                            <br>
                            <br>
                            <br>
                            <img src="../assets/img/fge_nav.png" alt="" width="500" height="500" style="opacity: 0.5;">
                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="loader-div"></div>

        <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
        <script>
            feather.replace()
        </script>
	
    </body>

</html>

<?php
    }else{
        echo "<script>window.location.href='../index.php';</script>";
    }
?>