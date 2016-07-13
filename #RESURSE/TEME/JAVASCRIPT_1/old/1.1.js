/*
# PUNCTUL 1
    Sa se scrie o functie care sa creeze un set de 10 functii direct pe obiectul global window,
    folosind un ciclu for pentru a genera toate cele 10 functii.
    Numele functiilor va fi myFunction_{index}, unde index este indexul curent din ciclul for (primul index sa fie 1).
    Functiile, cand se apeleaza, vor trebuie sa afiseze in consola indexul la care au fost create.

    Dupa ce se executa functia principala, se vor apela urmatoarele functii create din cod:
        window.myFunction_1();
        window.myFunction_2();
        window['myFunction_6']();

    // Rezultatul afisat ar trebui sa fie 1, 2 si 6.

    Hint: folositi-va de notiunea de closure.
*/

console.log('/----------------------------------\\');
console.log('|        ##** PUNCTUL 1 **##       |');
console.log('\\----------------------------------/');


// VARIANTA LUNGA
// Functia unde creem closure pentru index
// function createMyFunction(index) {
//     return function () {
//         console.log(index);
//     };
// }

// for (index = 1; index <= 10; index++) {

//     //## varianta 1: creem functia direct pe window ##//
//     // window ['myFunction_' + index] = createMyFunction(index);

//     //## varianta 2: evaluam functia cu eval ##//
//     // eval('myFunction_' + index + "=createMyFunction(index)");

//     //## varianta 3: folosim this ##//
//     this['myFunction_' + index] = createMyFunction(index);
// }

// VARIANTA SCURTA

function a (){
    // how many functions should I make?
    var nrOfFunc = 10;

    function createMyFunction(index) {
        return function () {
            console.log(index);
        };
    }
    // loop
    for (var index = 1; index <= nrOfFunc; index++) {
        // putem folosi this deoarece va fi chemata functia din window
        this['myFunction_' + index] = createMyFunction(index);
    }
}
a();

console.log('CALLING: window.myFunction_1();');
window.myFunction_1();

console.log('CALLING: window.myFunction_2();');
window.myFunction_2();

console.log('GALLING: window[\'myFunction_6\']();');
window['myFunction_6']();
