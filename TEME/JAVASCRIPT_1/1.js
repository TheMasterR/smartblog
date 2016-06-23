console.group('PUNCTUL 1');
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

console.group('CALLING: window.myFunction_1();');
window.myFunction_1();
console.groupEnd();

console.group('CALLING: window.myFunction_2();');
window.myFunction_2();
console.groupEnd();

console.group('GALLING: window[\'myFunction_6\']();');
window['myFunction_6']();
console.groupEnd();

console.groupEnd('PUNCTUL 1 END');