/* Se da urmatorul
    Array: ['1', 23, null, 46.5, '34e2', , false, 'true', , 40].
    a. Sa se filtreze lista dupa elemente strict de tip numar si sa se afiseze o alta lista cu acestea.
    b. Sa se imparta la 10 toate elementele (daca e posibil) si sa se genereze un nou array care sa contina tot atatea
        elemente ca si lista originala (elementele care nu pot fi impartite isi vor pastra valoarea originala).
    c. Sa se specifice daca lista contine elemente care nu sunt numerice sau nu pot fi transformate in valori numerice.

Pentru fiecare punct al problemei sa se scrie o functie separata.

Hint: folositi-va de functiile specializate ale obiectului Array.
*/

console.log('/----------------------------------\\');
console.log('|        ##** PUNCTUL 2 **##       |');
console.log('\\----------------------------------/');

// definim array-ul nostru
var arr = ['1', 23, null, 46.5, '34e2', , false, 'true', , 40];



// punctul a
function a()
{
    function isNumeric(n)
    {
        //return !isNaN(parseFloat(n)) && isFinite(n);
        // aici cred ca trebuiaul filtrate dupa tipul number, avand in vedere ca mai jos se cere sa fie parsate si cele care nu sunt string numere.
        if (typeof(n) === 'number'){
            return n;
        }
    }
    console.log(arr.filter(isNumeric));
}

console.log('PRINTING original ARRAY');
console.log(arr);
console.log('-------------------------------------------------------------');
console.log('-> punctul a: (doar numere, de tipul number)');
a();




// punctul b
function b()
{
    function isNumeric(n)
    {
        if (!isNaN(parseFloat(n)) && isFinite(n)){
            return n / 10;
        } else {
            return n;
        }
    }

    var arrDivided = [];

    for (var i = 0; i < arr.length; i++)
    {
        arrDivided[i] = isNumeric(arr[i]);
    }
    console.log(arrDivided);
}

console.log('-> punctul b: (numere, atat de tipul number, cat si parsate ca number, impartite la 10)');
b();



// punctul c
function c()
{
    function isNumeric(n)
    {
        if (!isNaN(parseFloat(n)) && isFinite(n)) {
            return n;
        } else
        {
            return 'NaN';
        }
    }

    var arrCustom = [];
    var contineNaN = false;

    for (var i = 0; i < arr.length; i++)
    {
        if (isNumeric(arr[i]) === 'NaN'){
            contineNaN = true;
        }
        arrCustom[i] = isNumeric(arr[i]);
    }
    if (contineNaN){
        console.log('Array-ul contine valori care nu pot fi convertite in numere, desemnate cu NaN (not a number)');
        console.log(arrCustom);
    } else {
        console.log('Array-ul nu decat numere');
        console.log(arrCustom);
    }
}
console.log('-> punctul c: (doar numere, sau numere parsate)');
c();