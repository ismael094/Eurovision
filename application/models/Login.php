<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Login
 *
 * @author alumno
 */
class Login extends CI_Model{
    private $isOk;
    private $message;
    
    public function ok($isOk) {
        $this->isOk = $isOk;
    }
    
    public function setMessage($message) {
        $this->message = $message;
    } 
    
    public function getMessage() {
        return $this->message;
    }
    
    public function p() {
        ?>
            <link rel="stylesheet" type="text/css" href="resources/themes/default/css/main.css">
            <div class="limiter">
                <div class="container-login100">

                    <div class="wrap-login100">
                        <span class="login100-form-title" style="margin-top:-100px;font-size: 40px">
                            Eurovision Song Contest 2018
                        </span>
                        <div class="login100-pic js-tilt" data-tilt>
                                <img style="margin-top: 50px" src="resources/themes/default/img/EUROVISION1.png" alt="IMG">
                        </div>

                        <form class="login100-form validate-form" method="POST" action="index.php">
                            <span class="login100-form-title">
                                    Iniciar sesi&oacute;n
                            </span>

                            <div class="wrap-input100 validate-input" data-validate = "Ejemplo: josefa">
                                <input class="input100" type="text" name="usuario" placeholder="Nombre Usuario">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="fa fa-envelope" aria-hidden="true"></i>
                                </span>
                            </div>

                            <div class="wrap-input100 validate-input" data-validate = "Se requiere una contraseña">
                                <input class="input100" type="password" name="pass" placeholder="Contraseña">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="fa fa-lock" aria-hidden="true"></i>
                                </span>
                            </div>

                            <div class="container-login100-form-btn">
                                <button class="login100-form-btn">
                                    Login
                                </button>
                            </div>

                            <?php
                                if (!$this->isOk) {
                                    $this->isOk = true;
                                    ?>
                                        <div class="text-center" style="margin-top:30px">
                                            <div class="alert alert-danger" role="alert">
                                                <strong>Ups!</strong> Nombre de usuario o contraseña erróneas.
                                            </div>
                                        </div>
                                        <div class="text-center">
                                    <?php
                                } else if ($this->message == "REGCOM") {
                                    $this->message = "";
                                    ?>
                                        <div class="text-center" style="margin-top:30px">
                                            <div class="alert alert-success" role="alert">
                                                <strong>¡Bien!</strong> Te has registrado satisfactoriamente.
                                            </div>
                                        </div>
                                        <div class="text-center">
                                    <?php
                                } else if ($this->message == "USUREP") {
                                    $this->message = "";
                                    ?>
                                        <div class="text-center" style="margin-top:30px">
                                            <div class="alert alert-warning" role="alert">
                                                <strong>Ups!</strong> Ya existe alguien con ese nombre de usuario...
                                            </div>
                                        </div>
                                        <div class="text-center">
                                    <?php
                                }
                                else {
                                    ?>
                                        <div class="text-center p-t-136">
                                    <?php
                                }
                                ?>
                                <a class="txt2" href="?reg=true">
                                    Registrarse
                                    <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php  
        
    }
    
    public function reg() {
        ?>
            <link rel="stylesheet" type="text/css" href="resources/themes/default/css/main.css">
            <div class="limiter">
                <div class="container-login100">

                    <div class="wrap-login100">
                        <span class="login100-form-title" style="margin-top:-100px;font-size: 40px">
                            Eurovision Song Contest 2018
                        </span>
                        
                        <div class="needed">  
                        <form class="login100-form validate-form" style="margin: 0 auto; " method="POST" action="index.php" enctype="multipart/form-data">
                            <span class="login100-form-title">
                                    Registro
                            </span>

                            <div class="wrap-input100 validate-input" data-validate = "Ejemplo: José Pérez Rufián">
                                <input class="input100" type="text" name="nombre" placeholder="Nombre y apellidos">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="fa fa-envelope" aria-hidden="true"></i>
                                </span>
                            </div>
                            
                            <div class="wrap-input100 validate-input" data-validate = "Ejemplo: josefa98">
                                <input class="input100" type="text" name="usuario" placeholder="Nombre de Usuario">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="fa fa-envelope" aria-hidden="true"></i>
                                </span>
                            </div>

                            <div class="wrap-input100 validate-input" data-validate = "Contraseña">
                                <input class="input100" type="password" name="pass" placeholder="Contraseña">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="fa fa-lock" aria-hidden="true"></i>
                                </span>
                            </div>
                            
                            <div class="wrap-input100 validate-input" data-validate = "Ambas contraseñas deben coincidir">
                                <input class="input100" type="password" name="pass1" placeholder="Confirmar contraseña">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="fa fa-lock" aria-hidden="true"></i>
                                </span>
                            </div>
                            
                            <div class="wrap-input100 validate-input" data-validate = "Imagen de perfil">
                                <input class="input100" type="file" name="imgPer" placeholder="Añadir una imagen de perfil">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="fa fa-file-image-o" aria-hidden="true"></i>
                                </span>
                            </div>

                            <div class="container-login100-form-btn">
                                <button class="login100-form-btn">
                                    Registrarse
                                </button>
                            </div>
                            <div class="text-center p-t-136">
                                <a class="txt2" href="index.php">
                                    <i class="fa fa-long-arrow-left m-l-5" aria-hidden="true"></i>
                                    Volver
                                </a>
                            </div>
                            <input type="hidden" value="registro" name="loginOperation"/>
                        </form></div>
                    </div>
                </div>
            </div>
        <?php 
        
    }
    
    public function complete() {
        ?>
            <link rel="stylesheet" type="text/css" href="resources/themes/default/css/main.css">
            <div class="limiter">
                <div class="container-login100">

                    <div class="wrap-login100">
                        <span class="login100-form-title" style="margin-top:-100px;font-size: 30px">
                            
                            Debido a la actualizacion de la página, debes completar tus datos
                        </span>
                        
                        <div class="needed" style="margin: 0 auto; ">    
                        <form class="login100-form validate-form"  method="POST" action="index.php" enctype="multipart/form-data">
                            <span class="login100-form-title">
                                Disculpe las molestias <br>
                                <i class="fa fa-frown-o fa-5" aria-hidden="true"></i>
                            </span>

                            <div class="wrap-input100 validate-input" data-validate = "Ejemplo: José Pérez Rufián">
                                <input class="input100" type="text" name="nombre" placeholder="Nombre y apellidos">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="fa fa-envelope" aria-hidden="true"></i>
                                </span>
                            </div>

                            <div class="wrap-input100 validate-input" data-validate = "Nueva Contraseña">
                                <input class="input100" type="password" name="pass" placeholder="Contraseña">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="fa fa-lock" aria-hidden="true"></i>
                                </span>
                            </div>
                            
                            <div class="wrap-input100 validate-input" data-validate = "Ambas contraseñas deben coincidir">
                                <input class="input100" type="password" name="pass1" placeholder="Confirmar contraseña">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="fa fa-lock" aria-hidden="true"></i>
                                </span>
                            </div>
                            
                            <div class="wrap-input100 validate-input" data-validate = "Imagen de perfil">
                                <input class="input100" type="file" name="imgPer" placeholder="Añadir una imagen de perfil">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="fa fa-file-image-o" aria-hidden="true"></i>
                                </span>
                            </div>

                            <div class="container-login100-form-btn">
                                <button class="login100-form-btn">
                                    Completar
                                </button>
                            </div>
                            <input type="hidden" value="complete" name="loginOperation"/>
                        </form></div>
                    </div>
                </div>
            </div>
        <?php 
        
    }
    
    public function change() {
        ?>
            <link rel="stylesheet" type="text/css" href="resources/themes/default/css/main.css">
            <div class="limiter">
                <div class="container-login100">

                    <div class="wrap-login100">
                        <span class="login100-form-title" style="margin-top:-100px;font-size: 30px">
                            
                            Rellena aquellos campos que se corresponden a los datos que quieres cambiar
                        </span>
                        
                        <div class="notNeeded" style="margin: 0 auto; ">
                        <form class="login100-form validate-form" style="margin: 0 auto; " method="POST" action="index.php" enctype="multipart/form-data">
                            <span class="login100-form-title">
                            </span>

                            <div class="wrap-input100 validate-input" data-validate = "Ejemplo: José Pérez Rufián">
                                <input class="input100" type="text" name="nombre" placeholder="Nombre y apellidos">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="fa fa-envelope" aria-hidden="true"></i>
                                </span>
                            </div>

                            <div class="wrap-input100 validate-input" data-validate = "Nueva Contraseña">
                                <input class="input100" type="password" name="pass" placeholder="Contraseña">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="fa fa-lock" aria-hidden="true"></i>
                                </span>
                            </div>
                            
                            <div class="wrap-input100 validate-input" data-validate = "Ambas contraseñas deben coincidir">
                                <input class="input100" type="password" name="pass1" placeholder="Confirmar contraseña">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="fa fa-lock" aria-hidden="true"></i>
                                </span>
                            </div>
                            
                            <div class="wrap-input100 validate-input" data-validate = "Imagen de perfil">
                                <input class="input100" type="file" name="imgPer" placeholder="Añadir una imagen de perfil">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="fa fa-file-image-o" aria-hidden="true"></i>
                                </span>
                            </div>

                            <div class="container-login100-form-btn">
                                <button class="login100-form-btn">
                                    Completar
                                </button>
                                <div class="login100-form-btn">
                                    <a href="index.php" style="text-decoration: none;font-family: Montserrat-Bold;font-size: 15px;color:white">
                                        Volver
                                    </a>
                                </div>
                            </div>
                            <input type="hidden" value="change" name="loginOperation"/>
                        </form>
                            </div>
                    </div>
                </div>
            </div>
        <?php 
        
    }
}