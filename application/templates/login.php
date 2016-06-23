<!--LOGIN FORM-->
<form action="/index.php?page=auth&action=doLogin<?php  if (isset($_GET['aid'])) { echo '&aid='.$_GET['aid']; } ?>" method="post" class="panel sp">
    <h4>Log into your account</h4>

    <?php if(isset($TEMPLATE_VARS['register']) && $TEMPLATE_VARS['register']) { ?>

    <div style="color:green">
        <?php echo 'Account created with succes!'; ?>
    </div>

    <?php } ?>

    <?php if(isset($TEMPLATE_VARS['error']) && $TEMPLATE_VARS['error']) { ?>

    <div style="color:red">
        <?php echo 'Invalid user or password!'; ?>
    </div>

    <?php } ?>


    <label for="email" class="email">Email</label>
    <input type="email" name="email" id="email" placeholder="Your email address..."/>

    <label for="password" class="password">Password</label>
    <input type="password" name="password" id="password" placeholder="password"/>

    <input type="submit" value="Login"/>
</form>
<!--END LOGIN FORM-->