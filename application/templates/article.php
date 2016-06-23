<!--ARTICLE 1 WITH COMMENTS-->
<article class="panel">
    <h1>
        <?php echo htmlspecialchars($TEMPLATE_VARS['article']->title); ?>
    </h1>

    <div class="description">
        <div class="share-buttons">
            <p class="author">by </p><a class="author" href="#" target="_blank"><?= $TEMPLATE_VARS['user']->name ?></a>
            <a class="date" href="#" target="_blank"><time><?= $TEMPLATE_VARS['article']->date_published ?></time></a>
            <a class="comments" href="#comments" target="_self"><?= $TEMPLATE_VARS['nrOfComments'] ?> comments</a>
         <a class="tag" href="#" target="_blank">blog category</a>
        </div>
    </div>

    <img src="public/uploads/<?= $TEMPLATE_VARS['article']->id ?>" />
    <!--<div class="img" style="background-image:url('public/img/grace.jpg')">-->
    <p class="article-content"><?php echo htmlspecialchars($TEMPLATE_VARS['article']->content); ?></p>

   <div class="social">
       <?php
            if ($TEMPLATE_VARS['userIsLogged']) {
        ?>
        <a class="read-more" href="/?page=article&action=edit&id=<?= $TEMPLATE_VARS['article']->id ?>" alt="Edit the Article">Edit Article</a>
        <?php } else { ?>
        <a class="read-more" href="/?page=auth&action=login&aid=<?= $TEMPLATE_VARS['article']->id ?>" alt="Login to edit the article">Login to edit the article</a>
        <?php } ?>
        <div class="share">
            <span class="share-button"></span>

            <span class="sharingiscaring">
                <p>Share :</p>
                <div class="share-buttons">
                    <a class="facebook" href="#" target="_blank"></a>
                    <a class="twitter" href="#" target="_blank"></a>
                    <a class="pinterest" href="#" target="_blank"></a>
                    <a class="googleplus" href="#" target="_blank"></a>
                </div>
            </span>
        </div>
    </div>
</article>
<!--COMMENTS SECTION OF ARTICLE-->
<h3 id="comments">Comments</h3>

<div class="panel sp">
    <h4><?= $TEMPLATE_VARS['nrOfComments'] ?> Comments</h4>

    <!--COMMENT CONTAINER-->
    <?php foreach($TEMPLATE_VARS['comments'] as $comment){ ?>
    <div class="comment-container">
        <img src="./public/img/thumb.png" alt="Profile iamge">
        <div class="comment-right">
            <div class="top">
                <a href="/profile/user_1"><?= $comment['username']; ?></a>
                <div class="comment-date"><?= $comment['date_published']; ?></div>
                <span class="clear"></span>
            </div>
            <div class="comment">
               <?= $comment['comment_content']; ?>
            </div>
        </div>
        <span class="clear"></span>
    </div>
    <?php } ?>
    <!--END COMMENT CONTAINER-->

<!--ADD NEW COMMENT FORM-->
<?php
    if ($TEMPLATE_VARS['userIsLogged']) {
?>
    <form action="" class="new-comment" method="post">
        <textarea value=""
            class="add-comment" name="add-comment" id="add-comment" placeholder="Enter your comment..."></textarea>
    <input type="submit" value="Submit" />
    </form>
<?php
   } else {
        echo '<br><br><p>You have to be <a href="/index.php?page=auth&action=login&aid='.$TEMPLATE_VARS['article']->id.'"><b>logged in</b></a> to place a comment.</p>';
    }
?>
<!--ADD NEW COMMENT END OF FORM-->
</div>
<!--END OF COMMENTS SECTION-->
<!--END OF ARTICLE 1 WITH COMMENTS-->