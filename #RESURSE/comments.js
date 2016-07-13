function Comment(obj) {
    var commentData = {
        userName: obj.user,
        date: obj.date,
        text: obj.text || '',
        prettyDate: ''
    };

    function checkForBadWords(searchedWords) {
        // verif. existenta cuvintelor cautate
        // returneaza true cel putin un cuvant din lista e gasit
        for (var i = 0; i < searchedWords.length; i++) {
            if (commentData.text.search(searchedWords[i]) > 0) {
                return true
            }
        }

        /**
         * Using for loopEach
         *
         */
        // searchedWords.forEach(function (item){
        //     if (commentData.text.search(item) > 0)
        //         return true
        // });
    }

    function replaceWords(searchedWords, replacementWords) {
        // inlocuieste cuv cautate in commentData.text
        for (var i = 0; i < searchedWords.length; i++) {
            commentData.text = commentData.text.replace(searchedWords[i], replacementWords[i]);
        }

    }

    function prettifyDate() {
        // Rescrie data de pe server intr-un format mai lizibil
        var dateTimeStart = (new Date(commentData.date)).getTime(),
            now = new Date(getDateTimeNow()).getTime(),
            differenceInSeconds = (now - dateTimeStart) / 1000;

        function getDateTimeNow() {
            var starttime = new Date();
            var isotime = new Date((new Date(starttime)).toISOString());
            var fixedtime = new Date(isotime.getTime() - (starttime.getTimezoneOffset() * 60000));
            var formatedMysqlString = fixedtime.toISOString().slice(0, 19).replace('T', ' ');
            return formatedMysqlString;
        }

        function prettifyDate(diff) {
            day_diff = Math.floor(diff / 86400);
            if (isNaN(day_diff) || day_diff < 0)
                return;

            return day_diff == 0 && (
                    diff < 60 && "chiar acum" ||
                    diff < 120 && "acum un minut" ||
                    diff < 3600 && "acum " + Math.floor(diff / 60) + " de minute" ||
                    diff < 7200 && "acum o ora" ||
                    diff < 86400 && "acum " + Math.floor(diff / 3600) + " ore") ||
                day_diff == 1 && "ieri" ||
                day_diff < 7 && "acum " + day_diff + " zile" ||
                day_diff == 7 && "acum o saptamana" ||
                day_diff < 31 && "acum " + Math.floor(day_diff / 7) + " saptamani" ||
                day_diff < 365 && " acum " + Math.floor(day_diff / 7 / 4) + " luni" ||
                day_diff <= 730 && " acum un an";
                day_diff > 730 && " acum " + Math.floor(day_diff / 7 / 4 / 12) + " ani";
        }
        commentData.prettyDate = prettifyDate(differenceInSeconds);
    }

    prettifyDate();

    return {
        getText: function () {
            return commentData.text
        },
        getUserName: function () {
            return commentData.userName;
        },
        getDate: function () {
            return commentData.date;
        },
        getPrettyDate: function () {
            return commentData.prettyDate;
        },
        hasNotAllowedWords: function (searchedWords) {
            return checkForBadWords(searchedWords);
        },
        parseText: function (searchedWords, replacementWords) {
            replaceWords(searchedWords, replacementWords);
        }
    }
}

function CommentsList(obj) {
    var searchedWords = obj.searchedWords;
    var replacementWords = obj.replacementWords;
    var comments = [];

    function createList(list) {
        // var trebui sa genereze fiecare instanta de Comment in array-ul comments

        /**
         * Using for loop
         *
         */

        // for (var n = 0; n < list.length; n++) {
        //     comments.push(new Comment(list[n]));
        // }

        /**
         * Using forEach methon of array
         *
         */

        list.forEach(function (item) {
            comments.push(new Comment(item));
        });
    }

    function parseText(searchedWords, replacementWords) {
        // apeleaza parseText de pe fiecare comment din lista comments

        /**
         * Using for loop
         *
         */

        // for (var n = 0; n < comments.length; n++) {
        //     comments[n].parseText(searchedWords, replacementWords);

        comments.forEach(function (item) {
            item.parseText(searchedWords, replacementWords);
        });



    }
    // Sort function for getMoreRecent method;
    function sortByDate(a, b) {
        if (a.getDate() < b.getDate()) {
            return 1;
        }
        if (a.getDate() > b.getDate()) {
            return -1;
        }
        return 0;
    }

    return {
        setComments: function (list) {
            createList(list);
            parseText(searchedWords, replacementWords);

        },

        addComment: function (obj) {
            // se adauga in comments si se parseaza textul
            var newComment = new Comment(obj);
            newComment.parseText(searchedWords, replacementWords);
            comments.push(newComment);
        },

        getMoreRecent: function (num) {
            // return array cu ultimele num comentarii
            var tempComments = comments.slice(0);
            tempComments.sort(sortByDate);

            var result = [];

            for (var n = 0; n < num; n++) {
                result.push({
                    userName: tempComments[n].getUserName(),
                    date: tempComments[n].getDate(),
                    text: tempComments[n].getText()
                });
            }
            return result;
        },

        getCommentsForUser: function (userName) {
            // filtrare comentarii dupa userName - return array
            var result = [];
            for (var n = 0; n < comments.length; n++) {

                if (comments[n].getUserName() === userName) {
                    result.push({
                        userName: comments[n].getUserName(),
                        date: comments[n].getDate(),
                        text: comments[n].getText()
                    });
                }
            }
            return result;
        },

        getCommentsByDate: function (date) {
            // filtrare comentarii dupa data - return array
            var result = [];
            for (var n = 0; n < comments.length; n++) {

                if (+(new Date(comments[n].getDate().substr(0, 10))) === +date) {
                    result.push({
                        userName: comments[n].getUserName(),
                        date: comments[n].getDate(),
                        text: comments[n].getText()
                    });
                }
            }

            return result;
        },

        getComments: function () {
            // returneaza Array cu obiecte in format
            /*
            {
                userName: {string},
                date: {string}, -> pretty date
                text: {string}
            }
            */

            var result = [];
            for (var n = 0; n < comments.length; n++) {
                result.push({
                    userName: comments[n].getUserName(),
                    date: comments[n].getPrettyDate(),
                    text: comments[n].getText()
                });
            }
            return result;

        }
    }
}

// Trebuie instantiata clasa CommentsList si sa primeasca cele doua liste de cuvinte
var searchedWords = ['one', 'expect', 'more', 'null', 'abyss'];
var replacementWords = ['1', 'exp', ' ... ', '0', 'ABS'];
// Se foloseste variabila list pentru a seta lista pe instanta CommentsList
var list = [{
    'id': '1',
    'user': 'Dennis',
    'date': '2016-06-24 18:33:33',
    'text': 'Lorem ipsum dolor one sit amet, consectetur one more adipiscing elit. Vestibulum ac augue abyss cursus, fermentum more tellus a, rutrum metus.'
}, {
    'id': '2',
    'user': 'Angela',
    'date': '2016-06-24 18:15:22',
    'text': 'Vivamus nec justomore sed metus expect condimentummore ullamcorper one nec vitae nisl. Donec more consequat vehicula ipsum non aliquam.'
}, {
    'id': '3',
    'user': 'Robert',
    'date': '2016-06-24 17:09:05',
    'text': 'Integer feugiat sapien sit one amet tortor semper expect fringilla eget in ex. Vivamus diam mi, efficitur quis pretium expect accumsan, rhoncus in orci.'
}, {
    'id': '4',
    'user': 'Dennis',
    'date': '2016-06-24 12:34:45',
    'text': 'Etiam feugiat nibh id expect commodo dapibus. Mauris dictum abyss ipsum expect one neque, ac efficitur expect ex aliquam non. Etiam id expect sollicitudin urna.'
}, {
    'id': '5',
    'user': 'Angela',
    'date': '2016-06-22 15:46:03',
    'text': 'Fusce non sapien sed metus moremore euismod one null nullcondimentum velmore at expect more nulllectus.'
}, {
    'id': '6',
    'user': 'Jane',
    'date': '2016-06-22 04:55:59',
    'text': 'Nullam elementum null maurismore more tellus, at one fermentum abyss orci expect consequat quis.'
}, {
    'id': '7',
    'user': 'Dennis',
    'date': '2016-05-12 13:33:44',
    'text': 'Curabitur ipsum est, ornare expect eu ullamcorper ut, sodales expect ac urna.'
}, {
    'id': '8',
    'user': 'Joe',
    'date': '2016-02-24 10:15:25',
    'text': 'Integer tincidunt nulla ut lacus rutrum porta. Ut consequat ipsum est, id dapibus enim suscipit vel.'
}, {
    'id': '9',
    'user': 'Dennis',
    'date': '2015-11-20 11:24:41',
    'text': 'Maecenas lacinia viverra arcu, nullnull tempus one imperdiet leo. Suspendisse one in bibendum abyss mi, a aliquet erat.'
}, {
    'id': '10',
    'user': 'Angela',
    'date': '2015-11-02 18:31:32',
    'text': 'Ut congue lobortis abyss auctor. Mauris eu nibh condimentum, rutrum nunc ac, null nullnullultricies ex.'
}, {
    'id': '11',
    'user': 'Robert',
    'date': '2015-05-23 17:32:32',
    'text': 'Vivamus tincidunt expect quam sit amet velit expect one fringilla null rutrum. Nulla vitae abyss urna one semper, facilisis leo nec, sodales ipsum.'
}];

var commentList = new CommentsList({
    searchedWords: searchedWords,
    replacementWords: replacementWords,
    comments: list
});

commentList.setComments(list);

//OUTPUT
console.group('getMoreRecent');
console.log(commentList.getMoreRecent(6));
console.groupEnd()

console.group('getCommentsForUser');
console.log(commentList.getCommentsForUser('Dennis'));
console.groupEnd()

console.group('getCommentsByDate');
console.log(commentList.getCommentsByDate(new Date('2016-06-24')));
console.groupEnd()

console.group('addComment');
console.log(commentList.addComment({
    id: '123',
    user: 'Michael',
    date: '2016-06-25',
    text: 'The last comment.'
}));
console.groupEnd()

console.group('getComments');
console.log(commentList.getComments());
console.groupEnd()

console.group('getMoreRecent');
console.log(commentList.getMoreRecent(3));
console.groupEnd();