<?php
    if ($this->session->userdata('username')!=null && $_GET["complete"] == null && $_GET["change"] == null && $this->session->userdata('state') != "CHANGE") {
        //echo '<div class="fixed-top">';
        $navi->printNav();
        //echo "</div>";
    }
    