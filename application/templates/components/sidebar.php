<aside>
    <?php
        if ($TEMPLATE_VARS['userIsLogged']) {
    ?>
    <div class="panel profile">
        <div style="background-image:url('<?php
                                        if (file_exists('public/uploads/cover/' . $TEMPLATE_VARS['loggedUser']->id)) {
                                            echo 'public/uploads/cover/' . $TEMPLATE_VARS['loggedUser']->id;
                                        } else {
                                            echo 'public/uploads/cover/default';
                                        }
                                    ?>')">
            <a href="/?page=myAccount" style="background-image:url('<?php
                                        if (file_exists('public/uploads/profile/' . $TEMPLATE_VARS['loggedUser']->id)) {
                                            echo 'public/uploads/profile/' . $TEMPLATE_VARS['loggedUser']->id;
                                        } else {
                                            echo 'public/uploads/profile/default';
                                        }
                                    ?>')"></a>
        </div>
        <h4><?= htmlspecialchars($TEMPLATE_VARS['loggedUser']->name) ?></h4>
        <p><?= htmlspecialchars($TEMPLATE_VARS['loggedUser']->motto) ?></p>
    </div>
    <?php
        }
    ?>
    <div class="panel labels">
        <h5 id="labels">Labels</h5>
        <ul>
            <li><a href="#">business</a></li>
            <li><a href="#">galerry</a></li>
            <li><a href="#">stuff</a></li>
            <li><a href="#">things</a></li>
            <li><a href="#">design</a></li>
        </ul>
    </div>

    <!--ENTER TABS HERE-->
    <div class="panel tabs">
        <div class="tab-border">
            <ul class="tab">
                <li class="selected">Popular</li>
                <li>Recent</li>
                <li>Comments</li>
            </ul>
            <div class="clear"></div>
            <!--THE TAB POST CONTENT-->
                <div class="tab-content">
                    <div class="tab-post">
                        <div class="tab-post-img" style="background-image:url('public/img/profile.jpg')"></div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                    </div>
                    <div class="tab-post">
                        <div class="tab-post-img" style="background-image:url('public/img/profile.jpg')"></div>
                        <p>Lorem ipsum dolor sit amet, adipisicing elit.</p>
                    </div>
                    <div class="tab-post">
                        <div class="tab-post-img" style="background-image:url('public/img/profile.jpg')"></div>
                        <p>Lorem ipsum dolor sit amet, </p>
                    </div>
                    <div class="tab-post">
                        <div class="tab-post-img" style="background-image:url('public/img/profile.jpg')"></div>
                        <p>Lorem ipsum dolor sit amet, elit.</p>
                    </div>
                </div>
        </div>
    </div>
    <!--END TABS AREA-->
</aside>
