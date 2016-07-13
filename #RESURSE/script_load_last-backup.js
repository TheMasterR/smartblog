
// create a new style element, and style the new comment with opacity pf 0.3 till it is submitted
var style = document.createElement('style');
style.setAttribute('type', 'text/css');
style.textContent = '.comment-container.initial { opacity: 0.3; }';
document.head.appendChild(style);


var Comment = function(commentInputData) {
    this.authorName = commentInputData.authorName;
    this.authorThumbSrc = commentInputData.authorThumbSrc;
    this.authorPage = commentInputData.authorPage;
    this.text = commentInputData.text;
    this.datePosted = commentInputData.datePosted;

    this.id = 0;

    this._el = null;
}

Comment.prototype.save = function() {

    var self = this;

    this.getHtml();

    var fd = new FormData();
    fd.append('commentBody', this.text);
    fd.append('articleId', extractArticleIdFromSearch());

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {

            try {
                var response = JSON.parse(xhr.responseText);
                if (response.success) {
                    self._el.classList.remove('initial');
                    self.setId(response.commentId);
                }
            } catch(e) {
                alert('Internal serveer error');
            };


        }
    }
    xhr.open('POST', '/?page=ajax&action=saveComment');
    xhr.send(fd);
};

Comment.prototype.setId = function(id) {
    this.id = id;

    var inputs = this._el.querySelectorAll('input[name="commentId"]');
    for (var i = 0, input; input = inputs[i++];) {
        input.value = this.id;
    }
}

Comment.prototype.getHtml = function() {

    if (!this._el) {
        var self = this;

        var commentDiv = document.createElement('div');
        commentDiv.classList.add('comment-container');
        commentDiv.classList.add('initial');

        // image
        var img = DOMUtils.createElement(
            'img',
            null,
            null,
            [
                {
                    name: 'src',
                    value: this.authorThumbSrc
                },
                {
                    name: 'alt',
                    value: 'Profile image'
                }
            ],
            commentDiv
        );

        // comment right
        var commentRightDiv = DOMUtils.createElement(
            'div',
            null,
            ['comment-right'],
            null,
            commentDiv
        );

        var commentTopDiv = DOMUtils.createElement(
            'div',
            null,
            ['top'],
            null,
            commentRightDiv
        );

        var profileAnchor = DOMUtils.createElement(
            'a',
            null,
            null,
            [{name: 'href', value: this.authorPage}],
            commentTopDiv,
            this.authorName
        );

        var deleteForm = DOMUtils.createElement(
            'form',
            null,
            ['delete-comment'],
            null,
            commentTopDiv
        );

        deleteForm.onsubmit = function(e) {
            e.preventDefault();

            self.delete(new FormData(e.currentTarget));
        }

        deleteForm.innerHTML = '<input type="hidden" name="commentId" value="' + this.id + '"><input type="submit" value="Remove">';

        var dateDiv = DOMUtils.createElement(
            'div',
            null,
            ['comment-date'],
            null,
            commentTopDiv,
            this.datePosted
        );

        var clearSpan = DOMUtils.createElement(
            'span',
            null,
            ['clear'],
            null,
            commentTopDiv
        );


        var commentBodyDiv = DOMUtils.createElement(
            'div',
            null,
            ['comment'],
            null,
            commentRightDiv,
            this.text
        );


        // clear span
        var clearSpan = DOMUtils.createElement(
            'span',
            null,
            ['clear'],
            null,
            commentDiv
        );


        // TODO DATE POSTED

        this._el = commentDiv;
    }

    return this._el;
};

Comment.prototype.delete = function(fd) {
    var self = this;

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {

            try {
                var response = JSON.parse(xhr.responseText);
                if (response.success) {
                    self.remove();
                }
            } catch(e) {
                alert('Internal serveer error');
            };


        }
    }
    xhr.open('POST', '/?page=ajax&action=deleteComment');
    xhr.send(fd);
};

Comment.prototype.remove = function() {
    this._el.parentNode.removeChild(this._el);
}


var DOMUtils = {

  createElement: function(tagName, id, classes, attributes, parent, textContent) {
      var el = document.createElement(tagName);

      if (id) {
          el.id = id;
      }

      if (classes) {
          for (var i = 0, className; className = classes[i++];) {
              el.classList.add(className);
          }
      }

      if (attributes) {
          var attribute;

          for (i = 0, attribute; attribute = attributes[i++];) {
              el.setAttribute(attribute.name, attribute.value);
          }
      }

      if (textContent) {
          el.textContent = textContent;
      }

      parent.appendChild(el);

      return el;
  }

};


var commentsContainerDiv = document.querySelector('#comments-container');

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

function extractArticleIdFromSearch() {

    if (!location.search) {
        return 0;
    }

    var search = location.search.substr(1);
    var params = search.split('&');
    for (var i = 0, param; param = params[i++];) {
        var paramSplit = param.split('=');
        console.log(paramSplit);
        if (paramSplit[0] === 'id') {
            return paramSplit[1];
        }
    }

    return 0;
}

/*
var comment = new Comment(
    'Nume autor',
    './public/img/thumb.png',
    '/public/1',
    'Comment body',
    'Jul 19. 2016'
);
*/

//var commentHtml = comment.getHtml();
//var commentsContainerDiv = document.querySelector('#comments-container');



//commentsContainerDiv.appendChild(commentHtml);
//commentsContainerDiv.insertBefore(commentHtml, document.getElementById('add-comment'));

//console.log(document.querySelector('.comment > .sp'));

/*var el = document.getElementById('labels');
el.style.color = 'red';
el.textContent = '<p>Hello world</p>';
el.innerHTML = '<p>Hello world</p>';

var anchor = document.createElement('a');
anchor.setAttribute('href', 'http://www.google.com/');
anchor.setAttribute('target', '_blank');

// metoda 1 de a seta clasa
anchor.setAttribute('class', 'my-anchor');

// metoda 2 de a seta clasa
anchor.className += ' my-special-anchor';

// metoda 3 de a seta clasa
anchor.classList.add('my-really-special-anchor');

var anchorText = document.createTextNode('Google');
anchor.appendChild(anchorText);

var p = el.children[0];
p.appendChild(anchor);


var style = document.createElement('style');
style.setAttribute('type', 'text/css');
style.textContent = '.my-anchor { color: blue; }';

document.head.appendChild(style);
*/