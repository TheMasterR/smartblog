// REZOLVAREA lui Claudiu Neaga

console.group('EXERCITIUL 1');

var i = 1;
var length = 10;
var functionName = 'myFunction_';

function createClosureFunction(index) {
    return function() {
        console.log('index', index);
    }
}

for (; i <= length; i++){
    window[functionName + i] = createClosureFunction(i);
}

window.myFunction_1();
window.myFunction_2();
window['myFunction_6']();

console.groupEnd();



console.group('EXERCITIUL 2');

var arr = ['1', 23, null, 46.5, '34e2', , false, 'true', , 40];

function cloneArray(originalArray) {
    return originalArray.concat([]);
}


function isStrictlyNumber(value){
    return typeof value === 'number';
}

var numberList = cloneArray(arr).filter(isStrictlyNumber);
var dividedList = cloneArray(arr).map(function(element) {
    return isNaN(element) ? element : element / 10;
});
var listHasNaN = cloneArray(arr).some(function(element) {
    return isNaN(element);
});

console.log('Original list:', arr);
console.log('Punctul a:', numberList);
console.log('Punctul b:', dividedList);
console.log('Punctul c:', listHasNaN);

console.groupEnd();




console.group('EXERCITIUL 3');

