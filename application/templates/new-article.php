<form action="" class="panel" method="post" enctype="multipart/form-data">
    <h1>New article</h1>

    <?php if($TEMPLATE_VARS['newArticleError']) { ?>

    <div style="color:red">
        <?php echo $TEMPLATE_VARS['newArticleError']; ?>
    </div>

    <?php } ?>

    <label for="title" class="title">Title</label>
    <input value=""
        type="title" name="title" id="title" placeholder="Article title here..." />

    <label for="tags" class="tags">Tags</label>
    <input value=""
        type="tags" name="tags" id="tags" placeholder="Some relevant tags..." />

    <label for="image-upload" class="image-upload">Image</label>
    <input type="file" name="image-upload" id="image-upload" value="Browse..." />

    <label for="article-content" class="article-content">Content</label>
    <textarea value=""
        class="new-article" name="article-content" id="article-content" placeholder="Your article content here..."></textarea>
    <label for="status">Status</label>
    <select name="status" class="status">
        <option value="published">Published</option>
        <option value="draft">Draft</option>
    </select>
<input type="submit" value="Add article" />
</form>