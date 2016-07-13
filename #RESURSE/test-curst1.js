/*var test = true;
var test2 = 'retwt';
var test3 = 123;
var test4;
var test5 = null;
/*var test6 = new Object();
test6.unu = 1;
test6.doi = 2;


var test6 = { //declarare object
    unu: '1',
    doi: '2',
    trei: test2,
    test5: 'fffffff',
    test:test4
};

test6.patru = 'patru';
console.log(test, test2, test3,test4,test5,test6 );

test = 456;
test = 'Idon\'t';
test = 321.121;
test = 34e2;
console.log(test);
'use strict';
var test = 'test global';
console.log(test);

function testFunction(param1,param2){
    var testLocal = 'local';
    var test2;

    console.log(test);
    console.log(testLocal);
    console.log('test2 ?'.test2);
    console.log(param1,param2);

}

testFunction(1,2);
//console.log(testLocal);

var testFunc2 = function(){
    console.log('testFunc2');
};

testFunc2();

function trei(param){
    console.log(this.test);
}

console.log(this);
trei(); */
//closures
/*
function main(){
    var mainVar = 'local';

    console.log(mainVar);
    console.log(this);

    var testInner = function(){ ///declare functie ca o expresie
        var innerVar = 'innerVar';
        console.log('sunt test inner');
        console.log(innerVar, mainVar);
        console.log(this);
    };

    return testInner;

}

var inner = main();
console.log(inner);
inner();
*/
/////////////////////////////////////////////////////////////////////////////////////
/*
var arr = [];
var max = 10;

function makeClosure(param){
    return function(){
        console.log(param);
    }
}

for(var contor = 0; contor < max; contor++){
    arr.push(makeClosure(contor));
    console.log(contor,arr[contor]);
}


arr[2]();
arr[0]();
arr[7]();
*/

//////////////////////////////////////////////////////hoisting, urcarea
var test2;
test();
function test(){
    console.log('test');
}
test();

test2();

test2 = function(){
    console.log('test2');
}

test2();