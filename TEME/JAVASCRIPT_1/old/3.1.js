console.log('/----------------------------------\\');
console.log('|        ##** PUNCTUL 3 **##       |');
console.log('\\----------------------------------/');

var test, test2, personsList = [{
    firstName: 'Addison',
    lastName: 'Jane',
    age: 25,
    specialization: 'engineer'
}, {
    firstName: 'Kenley',
    lastName: 'Michael',
    age: 21,
    specialization: 'tech-support'
}, {
    firstName: 'Richards',
    lastName: 'James',
    age: 31,
    specialization: 'copyrighter'
}, {
    firstName: 'Daley',
    lastName: 'Jennifer',
    age: 29,
    specialization: 'engineer'
}, {
    firstName: 'Vaughn',
    lastName: 'Dalton',
    age: 25,
    specialization: 'designer'
}, {
    firstName: 'Jacobs',
    lastName: 'Richard',
    age: 35,
    specialization: 'engineer'
}, {
    firstName: 'Gannon',
    lastName: 'John',
    age: 28,
    specialization: 'marketing'
}, {
    firstName: 'Landry',
    lastName: 'Leslie',
    age: 24,
    specialization: 'designer'
}, {
    firstName: 'Maccabee',
    lastName: 'Laura',
    age: 27,
    specialization: 'tech-support'
}, {
    firstName: 'Caldwell',
    lastName: 'Michele',
    age: 30,
    specialization: 'engineer'
}];

// incercam sa clonez obiectele din array
test = personsList;

// *********************** \\
// ACTUAL WORK STARTS HERE \\
// *********************** \\

function a(myList) {
    // Ordoneaza personList dupa firsName
    function sortByFirstName(a, b) {
        if (a.firstName < b.firstName) {
        return -1;
        }
        if (a.firstName > b.firstName) {
        return 1;
        }
        return 0; // nu fa nimic daca nu e nimic de comparat
    }

    console.dir(myList.sort(sortByFirstName));
}
console.log('-> punctul a: (sortam dupa firstName)');
a(personsList);


function b() {
    // Ordoneaza personList dupa Age
    function sortByAge(a, b) {
        if (a.age < b.age) {
        return -1;
        }
        if (a.age > b.age) {
        return 1;
        }
        return 0; // nu fa nimic daca nu e nimic de comparat
    }
    // Ordoneaza personList dupa Specialization
    function sortBySpecialization(a, b) {
        if (a.specialization < b.specialization) {
        return -1;
        }
        if (a.specialization > b.specialization) {
        return 1;
        }
        return 0; // nu fa nimic daca nu e nimic de comparat
    }

    console.dir(personsList.sort(sortByAge).sort(sortBySpecialization));
}
console.log('-> punctul b: (ordoneze lista dupa varsta fiecarei persoane si sa se grupeze in functie de specialitatea ei.)');
b();


function c() {
    // creem noua lista
    var newList = [];
    var newList2 = [];

    // Ordoneaza newList2 dupa Name
    function sortByName(a, b) {
        if (a.name < b.name) {
        return -1;
        }
        if (a.name > b.name) {
        return 1;
        }
        return 0; // nu fa nimic daca nu e nimic de comparat
    }

    // Lipim lastName + firstName + adaugam specializarea
    for (var i = 0; i < personsList.length; i++) {
        // varianta cu OBIECTE, name:  lastName + firstName, specialization : specialization
        newList2.push({
            'name': personsList[i].lastName + ' ' + personsList[i].firstName,
            'specialization': personsList[i].specialization
        });
        newList.push(personsList[i].lastName + ' ' + personsList[i].firstName + ' - ' + personsList[i].specialization);
        // varianta cu string, care cred ca s-a cerut
    }

    newList = newList.sort();
    newList2 = newList2.sort(sortByName);

    console.log('Varianta de array cu string:');
    console.dir(newList);
    console.log('Varianta de array cu object:')
    console.dir(newList2);
}
console.log('-> punctul c: (Sa se creeze o alta lista cu numele complet al persoanelor (lastName si firstName) si specializarea lor. Sa se ordoneze lista alfabetic.) - am creat doua variante intrucat nu am inteles exact ce trebuia sa fac');
c();



// declare myFuncList on window scope
var myFuncList = [];
function d() {

    // closure
    function myFuncBuilder(obj) {
        return function() {
            console.log(obj);
        }
    }

    // creaza functiile
    for (var i = 0; i < personsList.length; i++) {
        myFuncList[i] = myFuncBuilder(personsList[i]);
    }

    // apeleaza functiile
    for (var j = 0; j < myFuncList.length; j++) {
        console.log('Calling myFuncList[' + j + ']();');
        myFuncList[j]();
    }
}
console.log('-> punctul d: ');
d();

