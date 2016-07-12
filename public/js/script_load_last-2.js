// get the comments



// COMMENT FUNCTION
var Comment = function(obj) {
    // constructor
    this.id = obj.id;
    this.articleId = obj.articleId;
    this.userId = obj.userId;
    this.userName = obj.userName;
    this.userImage = obj.userImage;
    this.commentContent = obj.commentContent;
    this.datePosted = obj.datePosted;
}

var commentsContainerDiv = document.querySelector('#comments-container');
Comment.prototype.getAllComments = function (){
    ajax('GET', '/?page=ajax&action=getComments', function(data){
        for (var i = 0; i < data.length; i++) {
            var myComment = new Comment(data[i]);
            myComment.displayComment();
            myComment.deleteComment();

        }
    });
};
Comment.prototype.displayComment = function(){
    var html = '<div id="'+ this.id +'" class="comment-container"><img src="./public/img/thumb.png" alt="Profile iamge"><div class="comment-right"><div class="top"><a href="/profile/user_1">'+ this.userName +'</a><div class="comment-date">' + this.datePosted + '</div><span class="clear"></span></div><div class="comment">'+ this.commentContent +'</div></div><span class="clear"></span></div>';
            var child = document.createElement('div');
            child.innerHTML = html;
            commentsContainerDiv.appendChild(child);
};
Comment.prototype.deleteComment = function(){
    this.remove();
}


var init = new Comment({});
init.getAllComments();





var commentInsertForm = document.getElementById('add-comment');
commentInsertForm.onsubmit = function(e) {
    e.preventDefault();

    var commentInputObject = {};

    // referinta la formular, extragem parametrii despre autor
    var hiddenInps = e.currentTarget.querySelectorAll('input[type="hidden"]');
    for (var i = 0, inp; inp = hiddenInps[i++];) {
        commentInputObject[inp.name] = inp.value;
    }

    // comment body
    commentInputObject.text = e.currentTarget.querySelector('textarea').value;

    // commment posted date
    var d = new Date();
    commentInputObject.datePosted = d.toDateString();

    var comment = new Comment(commentInputObject);
    var commentEl = comment.getHtml();
    commentsContainerDiv.appendChild(commentEl);

    comment.save();
};








// FUNCTII UTILITARE
function ajax(requestType, url, myFunction){
    var httpRequest = new XMLHttpRequest();

    httpRequest.onreadystatechange = function() {
        if (httpRequest.readyState === XMLHttpRequest.DONE) {
            if (httpRequest.status === 200) {
                var myRequest = JSON.parse(httpRequest.responseText);
                myFunction(myRequest);
            } else {
                console.log('problema ajax');
            }
        }
    };
    httpRequest.open(requestType, url);
    httpRequest.send();
}