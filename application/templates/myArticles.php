<div class="panel myArticles">
    <h2>You have <?= $TEMPLATE_VARS['totalArticles'] ?> articles</h2>
    <ul>
<?php foreach ($TEMPLATE_VARS['articles'] as $article) { ?>
    <?php
        if ($article['status'] === 'published'){
            $status = '<span style="color:green"> [published]</span>';
        } else {
            $status = '<span style="color:red"> [draft]</span>';
        }
    ?>

                        <li>
                            <a href="/?page=article&id=<?= $article['id']; ?>"><?= '<b>' . htmlspecialchars($article['title']) . '</b>' ?></a>

                            <div>
                                <a href="/?page=article&action=edit&id=<?= $article['id']; ?>">Edit</a>|
                                <a href="/?page=article&action=remove&id=<?= $article['id']; ?>">Remove</a>
                            </div>
                            <p>Created @ <?= htmlspecialchars($article['date_created']) ?></p>
                            <p><?= $status ?></p>
                        </li>

<?php } ?>
    </ul>
</div>

<!--PAGINATION AREA -->
<div class="panel pagination">
    <?php
        // !!!! SECTIA ASTA SE POATE MUTA INTR-O FUNCTIE !!!!
        // verificam daca avem setat p, daca nu o setam ca fiind pagina 1
        $p = isset($_GET['p']) ? $_GET['p'] : 1;

        // printam toate paginile, si verificam care este pagina selectata, pentru a-i da clasa de selected
        for ($i = 1; $i <= $TEMPLATE_VARS['totalPages']; $i++) {
            if ($p == $i){
                echo '<a class="selected" href="/?page=article&action=myArticles&p='.$i.'">'.$i.'</a>';
            } else {
                echo '<a href="/?page=article&action=myArticles&p='.$i.'">'.$i.'</a>';
            }
        }
    ?>
</div>
<!--END OF PAGINATION AREA-->