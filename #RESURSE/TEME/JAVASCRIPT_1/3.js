console.group('PUNCTUL 3');

var personsList = [{
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

// Functie de clonat array
function clone(myArray) {
    // se poate folosi slice(0) sau, var clonedArray = JSON.parse(JSON.stringify(nodesArray)) sau, [].concat(data);
    return myArray.slice(0);
}

console.group('subpunctul a');
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

    console.log(myList.sort(sortByFirstName));
}
console.group('sortam dupa firstName, ASC');
a(clone(personsList));
console.groupEnd();
console.groupEnd('subpunctul a end');

console.group('subpunctul b');
function b(myList) {
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

    console.log(myList.sort(sortByAge).sort(sortBySpecialization));
}
console.group('ordoneze lista dupa varsta fiecarei persoane si sa se grupeze in functie de specialitatea ei');
b(clone(personsList));
console.groupEnd();
console.groupEnd('subpunctul b end');

console.group('subpunctul c');
function c(myList) {
    // creem noua lista
    var newList = [];

    // Lipim lastName + firstName + adaugam specializarea
    for (var i = 0; i < myList.length; i++) {
        newList.push(myList[i].lastName + ' ' + myList[i].firstName + ' - ' + myList[i].specialization);
        // varianta cu string, care cred ca s-a cerut
    }
    newList = newList.sort();
    console.table(newList);

}
console.group('Sa se creeze o alta lista cu numele complet al persoanelor (lastName si firstName) si specializarea lor. Sa se ordoneze lista alfabetic.) - am creat doua variante intrucat nu am inteles exact ce trebuia sa fac');
c(clone(personsList));
console.groupEnd();
console.groupEnd('subpunctul c end');


console.group('subpunctul d');
// declare myFuncList on window scope
var myFuncList = [];
function d(myList) {

    // closure
    function myFuncBuilder(obj) {
        return function() {
            //console.log(JSON.stringify(obj));
            console.log(obj);
        }
    }

    // creaza functiile
    for (var i = 0; i < myList.length; i++) {
        myFuncList[i] = myFuncBuilder(myList[i]);
    }

    // apeleaza functiile
    for (var j = 0; j < myFuncList.length; j++) {
        console.group('Calling myFuncList[' + j + ']();');
        myFuncList[j]();
        console.groupEnd();
    }
}
d(clone(personsList));
console.groupEnd('subpunctul d');
console.groupEnd('PUNCTUL 3 END');