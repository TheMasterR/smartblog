<!--REGISTER FORM-->
<form action="/?page=auth&action=register" method="post" class="panel sp">
    <h4>Register an account</h4>

    <?php if($TEMPLATE_VARS['registerError']) { ?>

    <div style="color:red">
        <?php echo $TEMPLATE_VARS['registerError']; ?>
    </div>

    <?php } ?>

    <label for="name" class="name">Name</label>
    <input value="<?php if(isset($TEMPLATE_VARS['post'])) echo htmlspecialchars($TEMPLATE_VARS['post']['name']); ?>"
        type="name" name="name" id="name" class="name" placeholder="Enter your name"/>

    <label for="email" class="email">Email</label>
    <input value="<?php if(isset($TEMPLATE_VARS['post'])) echo htmlspecialchars($TEMPLATE_VARS['post']['email']); ?>"
        type="email" name="email" id="email" placeholder="Your email address..."/>

    <label for="password" class="password">Password</label>
    <input type="password" name="password" id="password" placeholder="password"/>

    <label for="password2" class="password">Confirm Password</label>
    <input type="password" name="password2" id="password2" placeholder="password"/>

    <input type="submit" value="Register"/>
</form>
<!--END REGISTER FORM-->