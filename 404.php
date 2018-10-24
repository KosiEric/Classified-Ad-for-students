<?php

if(!class_exists("Configurations")){

    $document_root = $_SERVER['DOCUMENT_ROOT'];
    require_once ($document_root.'/security/config.php');




}
$page_action = "";
if(isset($_GET['action'])) {
    $page_action = (strtolower($_GET['action'])) ?? "nothing";
    $page_actions = Array("login", "signup");

    if (!in_array($page_action, $page_actions)) {
        $page_action = null;
    }

}


require_once ('req/other.php');
$home_page_site_name = ucfirst($home_page_site_name);
$site_features = "Electronics , Phones , Tablets , Home , Furniture and More";
$page_title = "Sorry, Page Not Found";
$page_description = "Welcome to {$home_page_site_name}.com ";
$page_keywords = "E-commerce,Phones,Tablets,Fashion,Clothes,Laptops,Computers,Beauty,Care,";
$selected_state = "Rivers";
$include_bootstrap = true;

?>

<!DOCTYPE html>
<html>
<head>
    <?php require_once SITE_CONFIGURATIONS['HTML_FOLDER'].'meta.php'; ?>
    <link rel = "stylesheet" type = "text/css" href = "<?php  echo SITE_CONFIGURATIONS["CSS_FOLDER"].'404.css'?>" />
</head>
<body>
<section id="not-found">
    <div id="title">Sorry , 404 Error Page</div>
    <div class="circles">
        <p>404<br>
            <small>PAGE NOT FOUND</small>
        </p>
        <span class="circle big"></span>
        <span class="circle med"></span>
        <span class="circle small"></span>
    </div>
</section>
</body>
</html>