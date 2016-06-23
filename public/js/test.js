// cursul 2, obiecte
console.group('Cursul 2, obj.js');

// var obj1 = {
//     unu : 1,
//     doi : 2
// }; // prima varianta de creere obiect, cu literal notation
// console.log(obj1);

// obj1.firstName = 'Jason';
// obj1.age = 21;
// obj1.lastName = 'Maccabee';


// var obj2 = new Object(); // a doua varianta, cu new
// console.log(obj2);


/*
// CLASA SIMPLA DE JAVASCRIPT
function Persoana(nume, prenume, varsta) {

        // this.nume = nume,
        // this.prenume = prenume,
        // this.varsta = varsta,

        // this.getName = function() {
        //     return this.nume + ' ' + this.prenume;
        // };



        // tot ce e definit aici e privat
        var personObj = {
            lastName : nume,
            firstName : prenume,
            age: varsta
        };

        // functie privata

        function myPrivateFunc(){
            return 'this can be used only in here!';
        }


        // tot ce e la return e public
        return {
            getName: function(){
                return personObj.lastName + ' ' + personObj.firstName;
            },

            getAge: function(){
                return personObj.age;
            },

            setAge: function(age){
                personObj.age = age;
            },
            // variabile publice
            prenume : prenume,
            nume : nume
        }

}


var myPerson = new Persoana('Jason', 'Macabbee', 34);
var fullName = myPerson.getName();
console.log(fullName);

// END OF SIMPLE CLASS
*/


// in acest caz nu se poate folosi new person, pentru ca Person este obiect, si nu poate fi folosit decat la functii, dar putem crea un prototyp
/*
var Person = {
    nume: 'Jason',
    age: 35,
    getName : function getName(){
        return this.nume;
    }
};


var myPerson = new Object(Person);
console.log(myPerson);
*/

// PROTOTYPE EX

function Person(fname, lname, age) {
    this.firstName = fname;
    this.lastName = lname;
    this.age = age;


}

var myPerson = new Person('Jason', 'Statham', 35);

console.log(myPerson.age);

Person.prototype.skill = 'none';


// END of obj.js
console.groupEnd();