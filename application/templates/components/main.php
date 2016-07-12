<!DOCTYPE html>
<html>
    <head>
        <title>Smart Blog</title>
        <meta name="description" content="This is my smart blog!">
        <!--disable zoom for mobile phones-->
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link type="image/ico" rel="icon" href="public/img/favicon.ico">
        <link type="text/css" rel="stylesheet" href="public/css/style.css">
        <script type="text/javascript" src="public/js/script.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
    </head>
    <body>
        <?php require_once 'header.php'; ?>
        <div class="content">
        <main>
            <!--MAIN AREA-->
            <?php
                if (isset($TEMPLATE_VARS['templatePath'])){
                    require_once $TEMPLATE_VARS['templatePath'];
                }
            ?>
        </main>
        <!--SIDE AREA-->
            <?php //conditionals for loading the side bar
                if ( (!$TEMPLATE_VARS['pageNotFound']) and
                     (!$TEMPLATE_VARS['login']) and
                     (!$TEMPLATE_VARS['register'])
                     ){
                        require_once 'sidebar.php';
                }
            ?>
        </div>

        <div class="clear"></div>
            <!--FOOTER AREA-->
            <?php require_once 'footer.php'; ?>

    </body>
</html>
