<form action="" class="panel" method="post" enctype="multipart/form-data">
    <h1>Edit the article</h1>

    <?php if($TEMPLATE_VARS['message-succes']) { ?>

    <div style="color:green">
        <?php echo $TEMPLATE_VARS['message-succes']; ?>
    </div>

    <?php } ?>

</form>