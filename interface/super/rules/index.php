<?php
require_once("include/header.php");


if(empty($_SERVER['HTTP_X_REQUESTED_WITH']) || (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') ) {
    /* if not ajax */
?>
    <script language='JavaScript'>
        <?php require($GLOBALS['srcdir'] . "/restoreSession.php"); ?>
    </script>
<?php
}
$controllerRouter = new ControllerRouter();
$controllerRouter->route();
