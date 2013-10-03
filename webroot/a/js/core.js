/**
 * ----------------
 * Sorting
 * ----------------
 */
var _ra = $('.fRange');
var _me = $('.fMelee');
var _le = $('.fLegion');
var _hb = $('.fHellbourne');
var _ag = $('.fAgi');
var _in = $('.fInt');
var _st = $('.fStr');

_ra.on('click', function() { _ra.addClass('selected'); _me.removeClass('selected'); });
_me.on('click', function() { _me.addClass('selected'); _ra.removeClass('selected'); });
_le.on('click', function() { _le.addClass('selected'); _hb.removeClass('selected'); });
_hb.on('click', function() { _hb.addClass('selected'); _le.removeClass('selected'); });
_ag.on('click', function() { _ag.addClass('selected'); _in.removeClass('selected'); _st.removeClass('selected'); });
_in.on('click', function() { _in.addClass('selected'); _ag.removeClass('selected'); _st.removeClass('selected'); });
_st.on('click', function() { _st.addClass('selected'); _ag.removeClass('selected'); _in.removeClass('selected'); });

$('.filter').on('click', function() {
    var af = getFilters();

    $('ul.hero-list li').each(function() { $(this).hide(); });

    for (var i = 0; i < af.length; i++) {
        $('ul.hero-list li').each(function() {
            if (i == 0) {
                if ($(this).hasClass(af[i])) {
                    $(this).show();
                    $(this).addClass('active');
                }
            } else {
                if ($(this).hasClass('active')) {
                    if (!$(this).hasClass(af[i])) {
                        $(this).hide();
                    }
                }
            }
        });
    }
});

// sorts
$('.sHP').on('click', function() {
    select('.sHP');
    var sorted = $('ul.hero-list li').toArray().sort(function(a, b) {
        return b.getAttribute('data-hp') - a.getAttribute('data-hp');
    });
    $.each(sorted, function(index, value) {
        $('ul.hero-list').append(value);
    });
});

$('.sDMG').on('click', function() {
    select('.sDMG');
    var sorted = $('ul.hero-list li').toArray().sort(function(a, b) {
        return b.getAttribute('data-dmg') - a.getAttribute('data-dmg');
    });
    $.each(sorted, function(index, value) {
        $('ul.hero-list').append(value);
    });
});

$('.sARMOR').on('click', function() {
    select('.sARMOR');
    var sorted = $('ul.hero-list li').toArray().sort(function(a, b) {
        return b.getAttribute('data-armor') - a.getAttribute('data-armor');
    });
    $.each(sorted, function(index, value) {
        $('ul.hero-list').append(value);
    });
});

$('.sDIFF').on('click', function() {
    select('.sDIFF');
    var sorted = $('ul.hero-list li').toArray().sort(function(a, b) {
        return b.getAttribute('data-diff') - a.getAttribute('data-diff');
    });
    $.each(sorted, function(index, value) {
        $('ul.hero-list').append(value);
    });
});

/**
 * ----------------
 * helper functions 
 * ----------------
 */
function select(sort) {
    $('.sHP').removeClass('selected');
    $('.sDMG').removeClass('selected');
    $('.sARMOR').removeClass('selected');
    $('.sDIFF').removeClass('selected');
    $(sort).addClass('selected');
}

function getFilters() {
    var range = $('.fRange').hasClass('selected');
    var melee = $('.fMelee').hasClass('selected');
    var hb    = $('.fHellbourne').hasClass('selected');
    var le    = $('.fLegion').hasClass('selected');
    var agi   = $('.fAgi').hasClass('selected');
    var _int  = $('.fInt').hasClass('selected');
    var str   = $('.fStr').hasClass('selected');
    var active = new Array(); 

    if (range) { active.push('range'); } 
    else if (melee) { active.push('melee'); }

    if (hb) { active.push('hb'); }
    else if (le) { active.push('le'); }
    
    if (agi) { active.push('agi'); }
    else if (_int) { active.push('int'); }
    else if (str) { active.push('str'); }

    return active;
}

