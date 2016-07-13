var images = [
    '1',
    '2',
    '3',
    '4',
    '6',
    '7',
    '20',
    '14',
    '15',
    '16'
];

var $myGallery = $('#gallery');
var nrImg = images.length;

// punem un event, myevent, si-i dam tricget din ajax done
$myGallery.on('myevent click', function(e) {
    console.log('A venit myevent', e);
    console.log(e.currentTarget);
    //$myGallery.off('click'); // scoatem clikul
});

for(var i = 0; i < nrImg; i++) {
   $('<img>')
            .attr('src', 'public/uploads/' + images[i])
            //.css('display','none')
            .addClass('image')
            .appendTo($myGallery);
}

// facem prima imagine vizibila
var $imageList = $('.image');
$imageList.first().addClass('visible');

// momentan prima imagine e afisata
var currentImage = 1;

var galleryTimer = setInterval(function(){
    // daca folosim find, cauta doar copii primului element, optimizare pentru performanta
    $myGallery.find('.visible').removeClass('visible');
    // // rezolvam contorul incremental
    // currentImage++;
    // if(nrImg < currentImage) {
    //     currentImage = 1;
    // }
    var rand = Math.round(Math.random() * (nrImg-1));

    $imageList.eq(rand).addClass('visible');



}, 3000);

// opreste intervalul
//clearInterval(galleryTimer);

// TIMEOUT se executa o singura data la intervalul setat
// setTimeout(function() {
//     clearInterval(galleryTimer);
// }, 5000);






//////////////// AJAX ///////////////////////////////

$.ajax({
        url: 'https://smartblog-pantea-lucian.c9users.io/index.php',
        method: 'GET',
        data: 'page=ajax&action=getComments'
    })
    .done(function(date) {
        console.log('DONE', date);
        $('#gallery').trigger('myevent');
    })
    .fail(function(err){
        console.log('ERROR: ', err);
    })
    .always(function(){
        console.log('Always');
});


$('img').on('click', function(elem){
    console.log(elem.target);
})