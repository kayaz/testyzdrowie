const resizeDelay = 200;

function onWindowResize() {
    window.setTimeout(function () {
        const e = $('.invesmentplan-holder').width();
        $("#invesmentplan").mapster("resize",e);
    }, resizeDelay);
}

$(document).ready(function(){
    $('#invesmentplan').mapster({
        fillColor: 'BA892F',
        fillOpacity: 0.6,
        clickNavigate: true,
        onClick: function() {
            const f = $(this).attr("data-slick");
            $('#floors').slick('slickGoTo', f);
            $('.floorCounter span').text(f);
            return false
        }
    });
    $("area[alt='floor-0']").mapster("set", true, {
        fillColor: "BA892F",
        fillOpacity: 0.6
    })

    $('#floors').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        fade: true,
        cssEase: 'linear',
        infinite: false
    }).on('beforeChange', function (event, slick, currentSlide, nextSlide) {
        $('.floorCounter span').text(nextSlide);

        $("area").mapster("set", false);
        $("area[alt='floor-" + nextSlide + "']").mapster("set", true, {
            fillColor: "BA892F",
            fillOpacity: 0.6
        })
    });

    $('area[title]').each(function () {
        const elem = $(this), classAttr = $(this).attr('class');
        elem.qtip({
            content: $(this).attr('title'),
            position: {
                my: 'bottom center',
                at: 'bottom center',
                target: 'mouse',
                adjust: {x:0, y: -10} ,
            },
            style: {classes: classAttr,tip: {corner: true,mimic: false,width: 12, height: 8,border: true,offset: 0}},
            hide: {fixed: false, effect: false, show: false},
        });
    });
});

$(window).bind('resize', onWindowResize);
