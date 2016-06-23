<?php foreach ($TEMPLATE_VARS['articles'] as $article) { ?>
<article class="panel">

    <h1>
        <a href="/?page=article&id=<?= $article['id']; ?>">
            <?= htmlspecialchars($article['title']); ?>
        </a>
    </h1>

    <div class="description">
        <div class="share-buttons">
            <p class="author">by </p><a class="author" href="#" target="_blank"><?= htmlspecialchars($article['username']); ?></a>
            <a class="date" href="#" target="_blank"><time><?= $article['date_published'] ?></time></a>
            <a class="comments" href="/?page=article&id=<?= $article['id'] ?>#comments" target="_blank"><?= $article['numberOfComments'] ?> comments</a>
         <a class="tag" href="#" target="_blank">blog category</a>
        </div>
    </div>

    <a href="/?page=article&id=<?= $article['id']; ?>"><img src="public/uploads/<?= $article['id'] ?>" /></a>
    <!--<div class="img" style="background-image:url('public/img/grace.jpg')">-->
    <p>
        <?php
            if(strlen($article['content']) > 200) {
                // limit the article content to 200 characters and apend the ...
                echo substr(htmlspecialchars($article['content']), 0, 200) . '...';
            } else {
                // if we have less than 200 we don't need to append the ...
                echo htmlspecialchars($article['content']);
            }
        ?>
    </p>
    <!--SOCIAL BUTTONS-->
   <div class="social">
        <a class="read-more" href="/?page=article&id=<?= $article['id']; ?>" alt="Read More">Read more</a>
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
<?php }?>
<!--END OF ARTICLE-->
<!--PAGINATION AREA -->
<div class="panel pagination">
    <?php
        // !!!! SECTIA ASTA SE POATE MUTA INTR-O FUNCTIE !!!!
        // verificam daca avem setat p, daca nu o setam ca fiind pagina 1
        $p = isset($_GET['p']) ? $_GET['p'] : 1;

        // printam toate paginile, si verificam care este pagina selectata, pentru a-i da clasa de selected
        for ($i = 1; $i <= $TEMPLATE_VARS['totalPages']; $i++) {
            if ($p == $i){
                echo '<a class="selected" href="/?p='.$i.'">'.$i.'</a>';
            } else {
                echo '<a href="/?p='.$i.'">'.$i.'</a>';
            }
        }
    ?>
</div>
<!--END OF PAGINATION AREA-->