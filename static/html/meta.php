<?php
#error_reporting(false);
$include_others = true;
if(!class_exists("Configurations")) {
    require_once("../security/config.php");
}

?>
<meta charset="utf-8" />
<meta name='copyright' content='Gidimi Inc.' />
<meta name='language' content='EN' />
<meta name='robots' content='index,follow' />
<meta name='owner' content='' />
<meta name='url' content="<?php echo $home_page_site_url; ?>" />
<meta name='identifier-URL' content='<?php  echo $home_page_site_url;?>' />
<meta name='directory' content='submission' />
<meta name='category' content='Classified Ads' />
<meta name='coverage' content='<?php echo $selected_country; ?>' />
<meta name='distribution' content='<?php echo $selected_country; ?> '/>
<meta name='rating' content='General'/>
<meta name='target' content='all' />
<meta name='HandheldFriendly' content='True' />
<meta name='MobileOptimized' content='320' />
<meta http-equiv='Expires' content='0' />
<meta http-equiv='Pragma' content='no-cache' />
<meta http-equiv='Cache-Control' content='no-cache' />
<meta http-equiv='imagetoolbar' content='no' />
<meta http-equiv='x-dns-prefetch-control' content='off' />
<meta name='Classification' content='Classified Ads' />
<meta name='subject' content='Classified Ads for Students for <?php echo $selected_country; ?> Students'/>
<meta name="author" content = "<?php echo  $site_author; ?>" />
<meta name="description" content="<?php echo $page_description; ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>
    <?php echo $page_title;  ?>
</title>




<meta name="keywords" content="<?php echo $page_keywords; ?>" />
<script type="text/javascript" src = "<?php  echo SITE_CONFIGURATIONS['JS_FOLDER'].'jquery-min.js'; ?>" language = "JavaScript"></script>
<script type="text/javascript" src = "<?php  echo SITE_CONFIGURATIONS['JS_FOLDER'].'functions.js'; ?>" language = "JavaScript"></script>

<?php
if (!isset($include_bootstrap_js)){ ?>
    <script type="text/javascript" src = "<?php  echo SITE_CONFIGURATIONS['JS_FOLDER'].'bootstrap.min.js'; ?>" language = "JavaScript"></script>
<?php } ?>



<script type="text/javascript" src = "<?php   echo SITE_CONFIGURATIONS['JS_FOLDER'].'popper.min.js'; ?>" language = "JavaScript"></script>
<?php /*<script type="text/javascript" src = "<?php  echo $functions->encrypt_js_file("functions.js"); ?>" language = "JavaScript"></script> */ ?>
<link rel="icon" type="image/png" href="<?php echo SITE_CONFIGURATIONS['SITE_LOGO'];?>" />
<?php
if (isset($include_bootstrap) and $include_bootstrap){ ?>
    <link rel = "stylesheet" type = "text/css" href = "<?php  echo SITE_CONFIGURATIONS["CSS_FOLDER"].'bootstrap.min.css'?>" />
<?php } ?>

<?php
if (isset($include_custom_check_box) and $include_custom_check_box){ ?>
    <link rel = "stylesheet" type = "text/css" href = "<?php  echo SITE_CONFIGURATIONS["CSS_FOLDER"].'custom-checkboxes.css'?>" />
<?php } ?>

<link rel = "stylesheet" type = "text/css" href = "<?php  echo SITE_CONFIGURATIONS["CSS_FOLDER"].'font-awesome.css'?>" />
<link rel = "stylesheet" type = "text/css" href = "<?php  echo SITE_CONFIGURATIONS["CSS_FOLDER"].'defaults.css'?>" />
<link rel = "stylesheet" type = "text/css" href = "<?php  echo SITE_CONFIGURATIONS["CSS_FOLDER"].'search.css'?>" />

<link rel = "stylesheet" type = "text/css" href = "<?php  echo SITE_CONFIGURATIONS["CSS_FOLDER"].'cairo.css'?>" />
<script type="text/javascript" src = "<?php  echo SITE_CONFIGURATIONS['JS_FOLDER'].'defaults.js'; ?>" language = "JavaScript"></script>
<script type="text/javascript" src = "<?php  echo SITE_CONFIGURATIONS['JS_FOLDER'].'search.js'; ?>" language = "JavaScript"></script>

<?php /*
<link rel = "stylesheet" type = "text/css" href = "<?php  echo SITE_CONFIGURATIONS["CSS_FOLDER"].'defaults.css'?>" /> */ ?>

<style type="text/css">
    body , html{

        padding:  0px;
        margin : 0px;
        position: relative;
        font-family: Cairo;
    }

    * {

        outline: none;
    }



</style>
<script type="text/javascript" language="JavaScript">
    function  preventClickEvent (e) {
        e.preventDefult();
    }
</script>
<?php function getCurrentPHPFileName() {

    //return $_SERVER["PHP_SELF"];
    //return basename(__FILE__ , '.php');

    $current_file_name =  $_SERVER["PHP_SELF"];

    $current_file_name = substr($current_file_name , 1 , strpos($current_file_name , ".") - 1  );

    return  $current_file_name;
}

?>
<script type = "text/javascript" language = "javascript" src = "<?php  echo SITE_CONFIGURATIONS["JS_FOLDER"].getCurrentPHPFileName().'.js'?>"></script>
<link rel = "stylesheet" type = "text/css" href = "<?php  echo SITE_CONFIGURATIONS["CSS_FOLDER"].getCurrentPHPFileName().'.css'?>" />



<?php // Check if the page is login or reset password page
if  (getCurrentPHPFileName() == 'account' or getCurrentPHPFileName() == 'resetPassword'){
?>
<style type = "text/css">
    body{
        background-color : #fff;

        background-image: url("<?php echo SITE_CONFIGURATIONS["IMG_FOLDER"]."quora-bg.png" ?>");
        background-repeat: no-repeat;

        background-size: cover;

    }
</style>
   <link rel="stylesheet" href="<?php echo SITE_CONFIGURATIONS['CSS_FOLDER']?>bootstrap4.min.css" />
  

<?php } ?>



<!--
****************                 *******************
********* *******              *********   *********
*********  *********         *********     *********
*********    *********     *********       *********
*********      ********* *********         *********
*********                                  *********



                    **************
                 ********************
                ******          ******
               ******            ******
              ******              ******
             ******                ******
             ******                ******
             ******                ******
             ******                ******
               ******            ******
                ******         ******
                   *****************
                     ************



    ******                              ******
      ******                          ******
        ******                      ******
          ******                  ******
            ******              ******
             ******           ******
               ******       ******
                  ******  ******
                      ******




    ******                              ******
      ******                          ******
        ******                      ******
          ******                  ******
            ******              ******
             ******           ******
               ******       ******
                  ******  ******
                        ******
                      ******
                    ******
                  ******
                ******
              ******
             
              *************
              ******    ******
              ******       ******
              ******         ******
              ******           ******
              ******            ******
              ******             ******
              ******              ******
              ******               ******
              ******               ******
              *******              ******
              ******               ******
              ******              ******
              ******             ******
              ******            ******
              ******           ******
              ******          ******
              ******         ******
              ******       ******
              *****************
              ****************
              ******    ******
              ******       ******
              ******         ******
              ******           ******
              ******            ******
              ******             ******
              ******              ******
              ******               ******
              ******               ******
              *******              ******
              ******               ******
              ******              ******
              ******             ******
              ******            ******
              ******           ******
              ******          ******
              ******         ******
              ******       ******
              ******************                     
              


             ************************************************
             ************************************************
             ************************************************
             ******
             ******
             ******
             ******
             ******
             ******
             ************************************************
             ************************************************
             ************************************************
             ******
             ******
             ******
             ******
             ******
             ************************************************
             ************************************************
             ************************************************










-->

