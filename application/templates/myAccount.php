<div class="panel myAccount">
    <h3>Hi, <a href="/?page=myAccount&id=<?= $TEMPLATE_VARS['loggedUser']->id ?>"><?= $TEMPLATE_VARS['loggedUser']->name ?></a>. What would you like to do?</h3>
    <ul>
        <li><a href="/?page=myAccount&p=edit">Change your profile picture</a></li>
        <li><a href="/?page=myAccount&p=edit">Edit your motto</a></li>
        <li><a href="/?page=myAccount&p=chpwd">Change your password</a></li>
        <li><a href="/?page=article&action=myArticles">See your articles</a></li>
    </ul>
</div>

<?php
    if (isset($_GET['p']) && $_GET['p'] === 'edit') {
?>
<div class="panel myAccount">
<form action="/?page=myAccount&action=edit" method="post" enctype="multipart/form-data">
    <h4>Edit your details</h4>

    <label for="name" class="name">Name</label>
    <input value="<?= htmlspecialchars($TEMPLATE_VARS['loggedUser']->name) ?>"
        type="name" name="name" id="name" class="name" placeholder="Enter your name" maxlength="30"/>

    <label for="motto" class="motto">Motto</label>
    <input value="<?= htmlspecialchars($TEMPLATE_VARS['loggedUser']->motto) ?>" type="motto" name="motto" id="motto" placeholder="Enter your moto here..." maxlength="255"/>

    <label for="profilePicture" class="image-upload">Profile Picture</label>
    <input type="file" name="profilePicture" id="profilePicture" value="Browse..." />

    <label for="coverPicture" class="image-upload">Cover Picture</label>
    <input type="file" name="coverPicture" id="coverPicture" value="Browse..." />

<input type="submit" value="Save" />
</form>
</div>
<?php } ?>

<?php
    if (isset($_GET['p']) && $_GET['p'] === 'chpwd') {
?>
<div class="panel myAccount">
<form action="/index.php?page=myAccount&p=chpwd&action=chpwd" method="post" enctype="multipart/form-data">
    <h4>Change your password</h4>

        <?php
            if (isset($TEMPLATE_VARS['error']) && $TEMPLATE_VARS['error'] != null)
            {
                echo $TEMPLATE_VARS['error'];
            }
        ?>

    <label for="password" class="password">Password</label>
    <input value=""
        type="password" name="password" id="password" class="password" placeholder="Enter your current password" maxlength="256"/>

    <label for="newPassword" class="password">New password</label>
    <input value="" type="password" name="newPassword" id="newPassword" placeholder="Enter your new password" maxlength="256"/>

    <label for="newPassword2" class="password">Verify new password</label>
    <input value="" type="password" name="newPassword2" id="newPassword2" placeholder="Confirm your new password" maxlength="256"/>

<input type="submit" value="Change password" />
</form>
</div>
<?php } ?>