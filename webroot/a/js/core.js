/**
 * ----------------
 * Sorting
 * ----------------
 */
var filters = '.sHP, .sARMOR, .sDMG',
    _ra     = $('.fRange'),
    _me     = $('.fMelee'),
    _le     = $('.fLegion'),
    _hb     = $('.fHellbourne'),
    _ag     = $('.fAgi'),
    _in     = $('.fInt'),
    _st     = $('.fStr');

_ra.on('click', function() { _ra.toggleClass('selected'); _me.removeClass('selected'); });
_me.on('click', function() { _me.toggleClass('selected'); _ra.removeClass('selected'); });
_le.on('click', function() { _le.toggleClass('selected'); _hb.removeClass('selected'); });
_hb.on('click', function() { _hb.toggleClass('selected'); _le.removeClass('selected'); });
_ag.on('click', function() { _ag.toggleClass('selected'); _in.removeClass('selected'); _st.removeClass('selected'); });
_in.on('click', function() { _in.toggleClass('selected'); _ag.removeClass('selected'); _st.removeClass('selected'); });
_st.on('click', function() { _st.toggleClass('selected'); _ag.removeClass('selected'); _in.removeClass('selected'); });

$('.filter').on('click', function() {
    var af = getFilters();

    if (af.length) {
        $('ul.hero-list li').each(function() { $(this).hide(); });
    } else {
        $('ul.hero-list li').each(function() { 
            $(this).removeClass('active').show();
        });
    }

    $.each(af, function(index, filter) {
        $('ul.hero-list li').each(function() {
            if (index == 0) {
                if ($(this).hasClass(filter)) {
                    $(this).addClass('active').show();
                }
            } else {
                if ($(this).hasClass('active')) {
                    if (!$(this).hasClass(filter)) {
                        $(this).hide();
                    }
                }
            }
        });
    });
});

// sorts
$(filters).on('click', function() {
    // if filter is already on, remove all sorts and re-sort by Name
    if ($(this).hasClass('selected')) return sortDefault();

    // sort by hp
    var attr = ($(this).hasClass('sHP')) ? 'data-hp' : ($(this).hasClass('sDMG') ? 'data-dmg' : 'data-armor');
    var sorted = $('ul.hero-list li').toArray().sort(function(a, b) {
        // if attr is the same, add another sort (title)
        if (b.getAttribute(attr) - a.getAttribute(attr) == 0)  {
            if (a.getAttribute('title') > b.getAttribute('title')) return 1;
            if (a.getAttribute('title') < b.getAttribute('title')) return -1;
            return 0;
        }
        return b.getAttribute(attr) - a.getAttribute(attr);
    });

    $.each(sorted, function(index, value) {
        $('ul.hero-list').append(value);
    });

    // pre-select
    $(filters).removeClass('selected');
    $(this).addClass('selected');
});


/**
 * ----------------
 * helper functions 
 * ----------------
 */
function sortDefault() {
    var sorted = $('ul.hero-list li').toArray().sort(function(a, b) {
        if (a.getAttribute('title') > b.getAttribute('title')) return 1;
        if (a.getAttribute('title') < b.getAttribute('title')) return -1;
        return 0;
    });

    $.each(sorted, function(index, value) {
        $('ul.hero-list').append(value);
    });

    return $(filters).removeClass('selected');
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

