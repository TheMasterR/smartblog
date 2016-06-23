// COMMENTS CLASS
function Comment(obj) {
    // private variable obj
    var commentData = {
        username: obj.username,
        date: obj.date,
        text: obj.text || '', // daca nu primim nimic, OR seteaza o valoare default
        prettyDate : '' // formatare frumoasa pentru date
    };
    // private funcrion
    function checkForBadWords(searchedWords) {
        // verifica existenta cuvintelor interzise
        // returneaza true, daca cel putin un cuvant este gasit
    }

    function replaceWords(searchedWords, replacementWords) {
        // inlocuieste cuvintele interzise in commentData.text
    }
    function prettifyDate() {
        // Rescrie data de pe server intr-un format mai lizibil
        // var dt = new Date();
    }
    // apelare in constructor
    prettifyDate();

    // public functions / vars passed as an object
    return {
        getText: function () {
            return commentData.text;
        },
        getuserName: function () {
            return commentData.username;
        },
        getDate: function () {
            return commentData.date;
        },
        hasNotAllowrdWords: function (searchedWords) {
            return checkForBadWords(searchedWords);
        },
        parseText: function (searchedWords, replacementWords) {
            replaceWords(searchedWords, replacementWords);
        },
        getPrettyDate: function() {
            return commentData.prettyDate;
        }
    };


}


function CommentsList(obj) {
    var searchedWords = obj.searchedWords;
    var replacementWords = obj.replacementWords;
    var comments = [];

    // privat

    function createList(list) {
        // va trebui sa genereze array-ul de comments
    }
    function parseText(searchedWords, replacementWords) {
        // apeleaza  parseText pe fiecare comments, in functie de cum e primit de la server
    }

    //public

    return {
        setComments: function (list) {
            createList(list);
            parseText(searchedWords, replacementWords);
        },
        addComment: function (obj) {
            // se adauga in comments si se parseaza textul

        },
        getMoreRecent: function(num) {
            // returneaza array cu ultimele comentarii, in functie de nr. specificat
        },
        getCommetsForUser: function(username) {
            // filtrare comentarii dupa username - return array
        },
        getCommentsByDate: function(date) {
            // filtrare comentarii dupa data - return array
        },
        getCommets: function() {
            // returneaza array cu obiecte in format
            /*
            {
                userName: {string},
                date: {string}, -> pretty date
                text: {string}
            }
            */
        }

    }
}

// extantiere de commentList si trimitem obiect cu proprietatile specificate
var commList = new CommentsList({
    searchedWords: [],
    replacementWords: []
});

// primim lista de commente
commList.setComments([
        {},
        {},
        {}
    ]);

commList.getCommetsForUser(''); // returneaza array cu comments

// AJAX