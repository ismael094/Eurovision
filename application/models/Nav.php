<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Nav
 *
 * @author alumno
 */
class Nav extends CI_Model{
    private $date;
    private $loged;
    
    public function Nav() {
        $this->date = date('Y-m-d h:i:s');
        $this->loged = $this->session->userdata('username');
    }
    
    public function printNav() {
        ?>
            <nav class="navbar navbar-default navbar">
                <div class="container-fluid">
                    <?php $this->navImage();?>
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <?php
                            $this->navBar();
                            if ($this->loged != null) {
                                $this->navFormLoged();
                            } else {
                                $this->navForm();
                            }
                        ?>
                    </div>
                </div>
            </nav>
        <?php
    }
    
    public function printNavPunt() {
        ?>
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="collapse navbar-collapse  center-block" id="bs-example-navbar-collapse-1">
                        <ul class="nav nav-tabs  nav-justified" style="margin-left: auto; margin-right: auto">
                            <li class="modes" data-mode="ind"><a>Mis puntuaciones</a></li>
                                <?php
                                if ($this->isJadais()) {
                                    ?>
                                        <li class="modes" data-mode="JDI"><a>JaDaIs</a></li> 
                                    <?php
                                }
                                ?>
                            <li class="modes" data-mode="glo"><a href="#">Globales</a></li>
                            <li class="modes" data-mode="top"><a href="#">Top</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        <?php
    }
    
    private function isJadais() {
        if ($this->loged == 'ismael' or $this->loged == 'jaime' or $this->loged == 'dailos') {
            return true;
        } else {
            return false;
        }
    }
    
    private function navImage() {
        ?>
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#"><img alt="Brand" src="<?php echo config_item('navImage');?>" height="50px" style="margin-left: 10px;"></a>
            </div>
        <?php
    }
    
    private function navForm() {
        ?>
            <form class="navbar-form navbar-right" role="search" method="POST" action="index.php">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Nombre de usuario" name="usuario">
                    <input type="password" class="form-control" placeholder="Contraseña" name="pass">
                </div>
                <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-log-in"></span>  Login</button>
            </form>
        <?php
    }
    
    private function navFormLoged() {
        ?>
            <form class="navbar-form navbar-right" role="search" method="POST" action="index.php">
                <div class="dropdown btn ">
                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                      <span class="glyphicon glyphicon-user"></span><?php echo $this->loged;?>
                      <span class="caret"></span>
                    </button>
                    <?php 
                        if ($this->session->userdata('level') == "Administrador") {
                            ?>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                    <li><a href="?add=true&u=true">Añadir canciones</a></li>
                                    <li><a href="#">Añadir resultado</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="#">Separated link</a></li>
                                </ul>
                            <?php
                        }
                    ?>
                  </div>
                <button type="submit" name="salir" class="btn btn-default"><span class="glyphicon glyphicon-log-out"></span>  Salir</button>
                <input type="hidden" name="out" value="true"/>
            </form>
        <?php
    }
    
    private function navBar() {
        ?>
            <ul class="nav navbar-nav">
                <li class="active"><a href="index.php">Inicio<span class="sr-only">(current)</span></a></li>
                <?php
                    if($this->loged != null) {
                        if ($this->date < '2017-05-14 08:30:00') { 
                            ?>
                                <li role="presentation" class="dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                        Ediciones<span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <?php 
                                            $this->printYearsList();
                                        ?>
                                    </ul>
                                </li>
                            <?php
                        }
                        ?>
                            <li><a href="?y=2017">Puntuaciones</a></li>
                            <li><a href="?top=true&year=2017">Top10</a></li>
                        <?php
                    }
                
                /*<li role="presentation" class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                      2016 <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="?c=2016">Candidatos</a></li>
                    </ul>
                </li>*/?>
            </ul>
        <?php
    }
    
    private function printYearsList() {
        
            ?>
                <li><a href="?y=2017&puntuar=true">2017</a></li>
            <?php

        
    }
}
