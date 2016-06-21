function validateEmail(email) {
    var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
    return re.test(email);
};

function isVisible(row, container) {
    var elementTop = $(row).offset().top,
        elementHeight = $(row).height(),
        containerTop = container.scrollTop(),
        containerHeight = container.height();
    return ((((elementTop - containerTop) + elementHeight) > 0) && ((elementTop - containerTop) < containerHeight));
};

var sec2_scrolled = false;
var sec3_scrolled = false;
var sec4_scrolled = false;
var sec5_scrolled = false;
var sec6_scrolled = false;
var sec7_scrolled = false;

$(document).ready(function() {

    $('#textarea-br').attr('placeholder', 'По какому городу и отрасли\nподоготовить вам список клиентов?');

    $('header .btn_head').click(function(e) {
        e.preventDefault();
        $('#pop1').fadeIn(250);
        $('header').addClass('pop-open');
    });

    $('input[type="file"]').on('propertychange change click keyup input paste', function() {
        $('.file_gr:visible input[name="fileinput"]').val($(this)[0].files[0].name);
    });

    $('.tabl').click(function(e) {
        e.preventDefault();
        $(this).parent().find('.file_gr').hide();
        $(this).parent().find('.tabr').removeClass('active');
        $(this).parent().find('input[name="package"]').val($(this).text());
        $(this).parent().find('input[name="event"]').val($(this).data('event'));
        if (!$(this).hasClass('active')) {
            $(this).addClass('active')
        }
    });

    $('.tabr').click(function(e) {
        e.preventDefault();
        $(this).parent().find('.file_gr').show();
        $(this).parent().find('.tabl').removeClass('active');
        $(this).parent().find('input[name="package"]').val($(this).text());
        $(this).parent().find('input[name="event"]').val($(this).data('event'));
        if (!$(this).hasClass('active')) {
            $(this).addClass('active')
        }
    });

    $('input[name="name"]').on('propertychange change click keyup input paste', function() {
        var id = $(this).attr('id');
        if ($(this).val().length < 2) {
            $(this).removeClass('checked').addClass('error-input');
            $(this).parent().find('label[for="' + id + '"]').addClass('error');
        } else {
            $(this).removeClass('error-input').addClass('checked');
            $(this).parent().find('label[for="' + id + '"]').removeClass('error');
            if ($(this).parent().find('input[name="email"],input[name="name"],input[name="phone"]').length == $(this).parent().find('.checked').length) {
                $(this).parent().find('[type="submit"]').removeClass('disabled');
            }
        }
    });

    $('input[name="email"]').on('propertychange change click keyup input paste', function() {
        var id = $(this).attr('id');
        if (!validateEmail($(this).val())) {
            $(this).removeClass('checked').addClass('error-input');
            $(this).parent().find('label[for="' + id + '"]').addClass('error');
        } else {
            $(this).removeClass('error-input').addClass('checked');
            $(this).parent().find('label[for="' + id + '"]').removeClass('error');
            if ($(this).parent().find('input[name="email"],input[name="name"],input[name="phone"]').length == $(this).parent().find('.checked').length) {
                $(this).parent().find('[type="submit"]').removeClass('disabled');
            }
        }
    });

    $('input[name="phone"]').mask('+7 (999) 999-99-99');
    $('input[name="phone"]').on('propertychange change click keyup input paste', function() {
        var id = $(this).attr('id');
        if ($(this).val().length != 18 || $(this).val().indexOf("_") != -1) {
            $(this).removeClass('checked').addClass('error-input');
            $(this).parent().find('label[for="' + id + '"]').addClass('error');
        } else {
            $(this).removeClass('error-input').addClass('checked');
            $(this).parent().find('label[for="' + id + '"]').removeClass('error');
            if ($(this).parent().find('input[name="email"],input[name="name"],input[name="phone"]').length == $(this).parent().find('.checked').length) {
                $(this).parent().find('[type="submit"]').removeClass('disabled');
            }
        }
    });

    $('.close').click(function(e) {
        e.preventDefault();
        $(this).parent().arcticmodal('close');
        $('input[name="fileinput"]').val('');

    });

    $('.sec2 .btn_pr').click(function(e) {
        e.preventDefault();
        $('#pop5').arcticmodal();
    });

    $('.sec2 .btn_sp').click(function(e) {
        e.preventDefault();
        $('#pop3').arcticmodal();
    });

    $('.btn_sec3').click(function(e) {
        e.preventDefault();
        $('#pop5_1').arcticmodal();
    });

    $('.btn_sec5').click(function(e) {
        e.preventDefault();
        $('#pop5_2').arcticmodal();
    });

    $('.sec3 .container .item span').click(function() {
        yaCounter37858040.reachGoal('EXAMPLE_FALSE_CLICK');
    });

    $('[data-click-event]').click(function() {
        yaCounter37858040.reachGoal($(this).data('click-event'));
    });

    function getURLParameter(name) {
        return decodeURIComponent((new RegExp('[?|&]' + name + '=' + '([^&;]+?)(&|#|;|$)').exec(location.search) || [, ""])[1].replace(/\+/g, '%20')) || null;
    }

    function run_geo(geo_url) {
        $.ajax({
            type: 'GET',
            url: geo_url,
            dataType: 'xml',
            success: function(xml) {
                $(xml).find('ip').each(function() {
                    var city = $(this).find('city').text();
                    var region = $(this).find('region').text();
                    if (city != region) {
                        var ipg = city + ', ' + region;
                    } else {
                        var ipg = city;
                    }
                    $('<input type="hidden" />').attr({
                        name: 'location',
                        class: 'location',
                        value: ipg
                    }).appendTo("form");
                });
            }
        });
    }
    $.get("http://ipinfo.io", function(response) {
        geo_url = 'http://ipgeobase.ru:7020/geo?ip=' + response.ip;
        run_geo(geo_url);
    }, "jsonp");
    utm = [];
    $.each(["utm_source", "utm_medium", "utm_campaign", "utm_term", 'source_type', 'source', 'position_type', 'position', 'added', 'creative', 'matchtype'], function(i, v) {
        $('<input type="hidden" />').attr({
            name: v,
            class: v,
            value: function() {
                if (getURLParameter(v) == undefined) return '-';
                else return getURLParameter(v)
            }
        }).appendTo("form")
    });
    $('<input type="hidden" />').attr({
        name: 'url',
        value: document.location.href
    }).appendTo("form");
    $('<input type="hidden" />').attr({
        name: 'title',
        value: document.title
    }).appendTo("form");


    $('form').submit(function(e) {
        e.preventDefault();
        $(this).find('input[type="text"]').trigger('input');
        if (!$(this).find('input[type="text"]').hasClass('error-input')) {
            var type = $(this).attr('method');
            var url = $(this).attr('action');
            var data = new FormData($(this)[0]);
            var track_event = $(this).find('input[name="event"]').val();
            var okgo = $(this).find('input[name="okgo"]').val();

            $.ajax({
                type: type,
                url: url,
                cache: false,
                contentType: false,
                processData: false,
                data: data,
                success: function() {

                    $.arcticmodal('close');
                    if (okgo == 'pop1t') {
                        $('#pop2').fadeIn(250);
                    }
                    if (okgo == 'pop2t') {
                        $('#pop6').arcticmodal();

                    }
                    if (okgo == 'pop3t') {
                        $('#pop4').arcticmodal();

                    }

                    if (yaCounter37858040 != 'undefined') {
                        yaCounter37858040.reachGoal(track_event);
                    }

                }
            });
        }
    });
});





$(window).scroll(function() {

    if (!sec2_scrolled && isVisible($('.sec3'), $(window)) && yaCounter37858040 != 'undefined') {
        sec2_scrolled = true;
        yaCounter37858040.reachGoal('SCROLLING_6HOURS');
    };

    if (!sec3_scrolled && isVisible($('.sec4'), $(window)) && yaCounter37858040 != 'undefined') {
        sec3_scrolled = true;
        yaCounter37858040.reachGoal('SCROLLING_EXAMPLES');
    };

    if (!sec4_scrolled && isVisible($('.sec5'), $(window)) && yaCounter37858040 != 'undefined') {
        sec4_scrolled = true;
        yaCounter37858040.reachGoal('SCROLLING_EXPLAINING');
    };

    if (!sec5_scrolled && isVisible($('.sec6'), $(window)) && yaCounter37858040 != 'undefined') {
        sec5_scrolled = true;
        yaCounter37858040.reachGoal('SCROLLING_FACTS');
    };

    if (!sec6_scrolled && isVisible($('.sec7'), $(window)) && yaCounter37858040 != 'undefined') {
        sec6_scrolled = true;
        yaCounter37858040.reachGoal('SCROLLING_PRICES');
    };

    if (!sec7_scrolled && isVisible($('footer'), $(window)) && yaCounter37858040 != 'undefined') {
        sec7_scrolled = true;
        yaCounter37858040.reachGoal('SCROLLING_TELETRADE');
    };

});

$(window).load(function() {

    setTimeout(function() {
        yaCounter37858040.reachGoal('15SECONDS')
    }, 15000);

    setTimeout(function() {
        yaCounter37858040.reachGoal('1MINUTE')
    }, 60000);

});
