console.group('PUNCTUL 2');

var arr = ['1', 23, null, 46.5, '34e2', , false, 'true', , 40];


// Functie de clonat array
function clone(myArray) {
    // se poate folosi slice(0) sau, var clonedArray = JSON.parse(JSON.stringify(nodesArray)) sau, [].concat(data);
    return myArray.slice(0);
}

function canBeBool(myValue) {
    // cast to string
    var myValueStr = String(myValue);

    if (myValueStr.toLowerCase() == 'true' || myValueStr.toLowerCase() == 'false'){
        return Boolean(myValue);
    } else {
        return myValue;
    }

}


console.group('printing original ARRAY for refference');
console.log(arr);
console.groupEnd();


console.group('subpunctul a');
function a(myArray)
{
    function isNumeric(n)
    {
        //return !isNaN(parseFloat(n)) && isFinite(n);
        // aici cred ca trebuiaul filtrate dupa tipul number, avand in vedere ca mai jos se cere sa fie parsate si cele care nu sunt string numere.
        if (typeof(n) === 'number'){
            return n;
        }
    }
    console.log(myArray.filter(isNumeric));
}

console.group('doar numere, de tipul number');
a(clone(arr));
console.groupEnd();
console.groupEnd('subpunctul a end');



console.group('subpunctul b');
function b(myArray)
{
    var arrDivided = [];

    for (var d = 0; d < myArray.length; d++) {
        // parse em for string booleans
        myArray[d] = canBeBool(myArray[d]);

        if (!isNaN(myArray[d])) {
            arrDivided[d] = myArray[d] / 10;
        } else {
            arrDivided[d] = myArray[d];
        }
    }
    console.log(arrDivided);
}

console.group('imparte la 10');
b(clone(arr));
console.groupEnd()
console.groupEnd('subpunctul b end');



console.group('subpunctul c');
function c(myArray)
{
     for (var d = 0; d < myArray.length; d++) {
         // parse em for string booleans
        myArray[d] = canBeBool(myArray[d]);

        if (!isNaN(myArray[d])) {
            console.log(myArray[d]);
            console.log('este un numar, sau poate fi evaluat ca numar');
        } else {
            console.log(myArray[d]);
            console.log('nu este un numar, si nici nu poate fi evaluat ca numar');
        }
    }
}
console.group('doar numere, sau numere parsate');
c(clone(arr));
console.groupEnd();
console.groupEnd('subpunctul c end');

console.groupEnd('PUNCTUL 2 END');