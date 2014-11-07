<?php

$this->load->view("includes/header.php");

if (isset($menu)) {
    $this->load->view($menu[0]);
}

if (isset($vista)) {
    
    $this->load->view($vista[0]);        
}

$this->load->view("includes/footer.php");

?>