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
        $this->date = date('Y-m-d H:i:s');
        $this->loged = $this->session->userdata('username');
        $this->level = $this->session->userdata('level');
    }
    
    public function printNav() {
        ?>
            <nav class="navbar navbar-toggleable-md navbar-light bg-faded navG">
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <?php $this->navImage();?>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <?php
                            $this->navBar();
                            if ($this->loged != null) {
                                $this->navFormLoged();
                            }
                        ?>
                    
                </div>
            </nav>
        <?php
    }
    
    
    
    public function printNavPunt() {
        ?>
            <div class="row" style="margin-top:20px">
                <div class="col">
                    <ul class="nav justify-content-center" >
                        <li class="nav-item modes" data-mode="ind" style="margin:15px;">
                            <button class="nav-item btn buttonStyle">Mis puntuaciones</button>
                        </li>
                        <?php
                            if ($this->isJadais()) {
                                ?>
                                    <li class="nav-item modes" data-mode="JDI" style="margin:15px;">
                                        <button class="nav-item btn buttonStyle">JaDaIs</button>
                                    </li> 
                                <?php
                            }
                        ?>
                        <li class="nav-item modes" data-mode="glo" style="margin:15px;">
                            <button class="nav-item btn buttonStyle">Globales</button>
                        </li>
                        <?php
                            if (($this->date > config_item("topRes"))) { 
                                ?>
                                    <li class="nav-item modes" data-mode="top" style="margin:15px;"><button class="nav-item btn buttonStyle" href="#">Top</button></li>
                                <?php
                            }
                        ?>  
                    </ul>
                </div>
            </div>
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
                <div class='circleP d-inline-block align-top js'>
                    <img src="<?php echo config_item('imgPer').$this->session->userdata('username')."/"
                        . "".$this->session->userdata('picture');?>" alt="fff" data-toggle="modal" data-target="#perModal">
                </div>
            </form>
            <div class="modal" id="perModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container">
                                <div class="row">
                                    <div class='circleP circlePer d-inline-block align-top'>
                                        <img src="<?php echo config_item('imgPer').$this->session->userdata('username')."/"
                                            . "".$this->session->userdata('picture');?>" alt="fff">
                                    </div>
                                </div>
                                <div class="row" style="text-align: center">
                                    <h4 class="col"><?php echo $this->session->userdata('name');?></h4>
                                </div>
                                <div class="row" style="text-align: center">
                                    <h5 class="col">@<?php echo $this->session->userdata('username');?></h5>
                                </div>
                                <div class="row" style="text-align: center;margin-top:15px">
                                    <h5 class="col">Opciones</h5>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="list-group" style="font-size: 18px;font-family: Poppins-Regular">
                                            <a href="?change=true" class="list-group-item list-group-item-action">Modificar datos</a>
                                            <?php 
                                                if ($this->level == "Administrador" || $this->level == "REDACTOR") {
                                            ?>
                                            <a href="?add=true&u=true" class="list-group-item list-group-item-action">Añadir canciones</a>
                                            <?php
                                                }
                                                if ($this->level == "Administrador") {
                                            ?>
                                            
                                            <a href="#" class="list-group-item list-group-item-action">Añadir resultados</a>
                                            <a href="#" class="list-group-item list-group-item-action">Control de usuarios</a>
                                            <a href="#" class="list-group-item list-group-item-action openMess">Ver comentarios</a>
                                            <?php 
                                                } else {
                                                    ?>
                                                    <a href="#" class="list-group-item list-group-item-action openMess">
                                                        ¿Algún error?.¿Alguna mejora para la página? ¡Hacérnoslo saber!
                                                    </a>
                                                    <?php
                                                }
                                            ?>
                                            
                                        </div>
                                    </div>
                                    
                                    <?php 
                                        if ($this->level == "Administrador") {
                                            $this->seeMessages();
                                        } else {
                                            $this->message();
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="container">
                                <div class="row">
                                    <form class="navbar-form navbar-right col" role="search" method="POST" action="index.php">
                                        <button type="submit" name="salir" class="btn btn-primary buttonStyle"><span class="glyphicon glyphicon-log-out"></span>Cerrar sesion</button>
                                        <input type="hidden" name="out" value="true"/>
                                    </form>
                                    <button type="button" class="btn btn-primary buttonStyle col" data-dismiss="modal" style="width:100px">Volver</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script type="text/javascript" data-o="fdsf">
                var $img = $(".circleP img"),
                    width = $img.width(),
                    height = $img.height(),
                    tallAndNarrow = width / height < 1;
                if ($img != null) {
                    if (tallAndNarrow) {
                        $img.addClass('tallAndNarrow');
                    }
                    $img.addClass('loaded');
                } 
            </script>
        <?php
    }
    
    private function navBar() {
        ?>
            <ul class="navbar-nav mr-auto" style="margin-top:10px;font-size: 21px;">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">
                        Inicio<span class="sr-only">(current)</span>
                    </a>
                </li>
                <?php
                    if($this->loged != null) {
                        if ($this->date > config_item("closeDate")) { 
                            ?>  
                                <li class="nav-item"><a class="nav-link" href="?y=2017&puntuar=true">Puntuar</a></li>    
                                
                            <?php
                        }
                        ?>  
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                        Puntuaciones<span class="caret"></span>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                        <a class="dropdown-item" href="?y=2017">2017</a>
                                        <a class="dropdown-item" href="?y=2016">2016</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="?top=true&year=2017">Top10</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="?mySongs=true">Mis canciones</a>
                                </li>
                        <?php
                    }
                ?>
                <?php
                /*
                <li role="presentation" class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                      2016 <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="?c=2016">Candidatos</a></li>
                    </ul>
                </li>*/
                ?>
            </ul><?php
        
    }
    
    private function printYearsList() {
        
            ?>
                <li><a href="?y=2017&puntuar=true">2017</a></li>
            <?php

        
    }
    
    public function message() {
        ?>
            <div class="modal" id="messBett" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content modal-lg">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">¡Gracias por ayudarnos!</h5>
                      <button type="button" class="close closeMess" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form>
                        <div class="form-group">
                          <label for="message-text" class="form-control-label">Mensaje:</label>
                          <textarea class="form-control" id="message-text"></textarea>
                        </div>
                      </form>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-primary buttonStyle closeMess">Volver</button>
                      <button type="button" class="btn btn-primary buttonStyle send">Enviar</button>
                    </div>
                  </div>
                </div>
              </div>
        <?php
    }
    
    public function seeMessages() {
        ?>
            <div class="modal" id="messBett" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content modal-lg">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Comentarios</h5>
                      <button type="button" class="close closeMess" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <?php
                                $a = new Comentarios();
                                $b = $a->getComentarios();
                                if ($b != null) {
                                    foreach ($b as $rows) {
                                        ?>
                                            <div class="row justify-content-md-center card bg-faded" style="margin:2px;">
                                                <span class="border border-dark">
                                                    <div class="col">
                                                        <?php echo $rows->comentario;?>
                                                    </div>
                                                </span>
                                                
                                            </div>
                                        <?php
                                    }
                                }
                            ?>
                        </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-primary buttonStyle closeMess">Volver</button>
                    </div>
                  </div>
                </div>
              </div>
        <?php
    }
}
