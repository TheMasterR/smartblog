var comments = {
    // DOM CACHE
    $container : $('#comments-container'),
    $deleteComment : $('.delete-comment'),
    $addComment : $('#add-comment'),
    loggedUserId : null

};

comments.init = function (){
    // init
    comments.loggedUser();
    comments.getComments();
};
comments.extractArticleIdFromSearch = function(){
    if (!location.search) {
        return 0;
    }

    var search = location.search.substr(1);
    var params = search.split('&');
    for (var i = 0, param; param = params[i++];) {
        var paramSplit = param.split('=');
            //console.log(paramSplit);
        if (paramSplit[0] === 'id') {
            return paramSplit[1];
        }
    }

    return 0;
};
comments.loggedUser = function() {
    $.ajax({
        dataType: 'json',
        url: 'index.php',
        method: 'GET',
        data: 'page=ajax&action=isLogged',
    })
    .done(function(data){
        comments.loggedUserId = $.parseJSON(data);
    });
};
comments.getComments = function(){
    $.ajax({
            dataType: 'json',
            url: 'index.php',
            method: 'GET',
            data: 'page=ajax&action=getComments&id=' + comments.extractArticleIdFromSearch(),

        })
        .done(function(date) {
            // pass the comments to the output function
            comments.outputComments(date);
        })
        .fail(function(err){
            console.log('ERROR: ', err);
            comments.$container.html('<h4>Were sorry, but we can\'t retrive any comments!</h4>');
        });
};
comments.outputComments = function(obj){
        for (var i = 0; i < obj.length; i++) {
                comments.createComment(obj[i]);
            }
};
comments.createComment = function(obj) {
    function isUserLogged() {
        if(obj.userId == comments.loggedUserId) {
            return '<span class="delete-comment" id="del_'+obj.id+'">Delete</span><span class="edit-comment" id="edit_'+obj.id+'">Edit</span>';
        }
        return '';
    }
    comments.$container.append('<div class="comment-container" id="comment_id_'+obj.id+'"><img src="'+obj.userImage+'" alt="Profile iamge"><div class="comment-right"><div class="top"><a href="/profile/user_1">'+obj.userName+'</a><div class="comment-date">'+obj.date_published+'</div>'+isUserLogged()+'<span class="clear"></span></div><div class="comment">'+obj.comment_content+'</div></div><span class="clear"></span></div>');

    $('.delete-comment').bind('click', function(e) {
        var commentId = e.currentTarget.id.substr(4, e.currentTarget.id.length);
        var selector = '#comment_id_' + commentId;

        comments.deleteComment(commentId);
        $(selector).remove();
    });

    $('.edit-comment').bind('click', function(e) {
        e.stopImmediatePropagation(); // stop event from bleeding

        var response = prompt('Edit your comment!',obj.comment_content);

        if(response != obj.comment_content && response.length > 1){
            obj.comment_content = response;
            $('#comment_id_'+obj.id).find('.comment').html(response);

             $.ajax({
                url: 'index.php?page=ajax&action=updateComment',
                method: 'POST',
                data: obj
            })
            .done(function(date) {
                // pass the comments to the output function
                console.dir(date);

            })
            .fail(function(err){
                console.log('ERROR: ', err);
            });
        }


    });
}
comments.deleteComment = function(id){
    $.ajax({
        url: 'index.php',
        method: 'GET',
        data: 'page=ajax&action=deleteComment&id='+id,
    })
    .done(function(date) {

    });
};

// click events
comments.$addComment.submit(function(e) {
     $.ajax({
            url: 'index.php?page=ajax&action=saveComment',
            method: 'POST',
            data: comments.$addComment.serialize(),
        })
        .done(function(date) {
            // pass the comments to the output function
            console.dir(date);
            comments.createComment($.parseJSON(date));
        })
        .fail(function(err){
            console.log('ERROR: ', err);
        });

    e.preventDefault(); // avoid to execute the actual submit of the form.
});

// START POINT
$(document).ready(comments.init());
//comments.init();