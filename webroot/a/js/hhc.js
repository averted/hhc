/**
 * ----------------
 * HHC Class
 * ----------------
 */
$(function() {
    HHC.initialize();
});

var HHC = {
    initialize: function() {
        HHC.Filters.init();
        HHC.Sorts.init();
        HHC.Tooltips.init();
    },
};

HHC.Filters = {
    init: function() {
        $('.filter').on('click', function() {
            var af = HHC.Filters.getActive($(this));

            if (af.length)
                $('ul.hero-list li').hide();
            else
                $('ul.hero-list li').removeClass('active').show();

            $.each(af, function(index, filter) {
                $('ul.hero-list li').each(function() {
                    var li = $(this);

                    if (index == 0 && li.hasClass(filter)) 
                        return li.addClass('active').show();

                    if (li.hasClass('active') && !li.hasClass(filter))
                        li.hide();
                });
            });
        });
    },

    getActive: function(f) {
        var filters = {
            'range' : { id:'.fRange',      name:'range', group:'.fMelee' },
            'melee' : { id:'.fMelee',      name:'melee', group:'.fRange' },
            'hb'    : { id:'.fHellbourne', name:'hb',    group:'.fLegion' },
            'le'    : { id:'.fLegion',     name:'le',    group:'.fHellbourne' },
            'agi'   : { id:'.fAgi',        name:'agi',   group:'.fInt, .fStr' },
            'int'   : { id:'.fInt',        name:'int',   group:'.fAgi, .fStr' },
            'str'   : { id:'.fStr',        name:'str',   group:'.fAgi, .fInt' },
        }, active = [];

        // pre-select
        f.toggleClass('selected');
        $(filters[f.attr('data-name')].group).removeClass('selected');

        // generate active array
        $.each(filters, function(i, filter) {
            if ($(filter.id).hasClass('selected')) active.push(filter.name);
        });

        return active;
    }
};

HHC.Sorts = {
    init: function() {
        $('.sort').on('click', function() {
            var sort = $(this),
                attr = (sort.hasClass('sHP')) ? 'data-hp' : (sort.hasClass('sDMG') ? 'data-dmg' : 'data-armor');

            // if sort is already selected, remove all sorts and re-sort by Name
            if (sort.hasClass('selected'))
                return HHC.Sorts.origSort();

            HHC.Sorts.typeSort(attr);

            // pre-select
            sort.addClass('selected');
        });
    },

    origSort: function() {
        // sort by title
        var sorted = $('ul.hero-list li').toArray().sort(function(a, b) {
            if (a.getAttribute('title') > b.getAttribute('title')) return 1;
            if (a.getAttribute('title') < b.getAttribute('title')) return -1;
            return 0;
        });

        // generate list
        $.each(sorted, function(index, value) {
            $('ul.hero-list').append(value);
        });

        // de-select all sorts
        return $('.sort').removeClass('selected');
    },

    typeSort: function(attr) {
        // sort by attr 
        var sorted = $('ul.hero-list li').toArray().sort(function(a, b) {
            // if attr is the same, add another sort (title)
            if (b.getAttribute(attr) - a.getAttribute(attr) == 0)  {
                if (a.getAttribute('title') > b.getAttribute('title')) return 1;
                if (a.getAttribute('title') < b.getAttribute('title')) return -1;
                return 0;
            }
            return b.getAttribute(attr) - a.getAttribute(attr);
        });

        // generate list
        $.each(sorted, function(index, value) {
            $('ul.hero-list').append(value);
        });

        // de-select all sorts
        return $('.sort').removeClass('selected');
    }
};

HHC.Tooltips = {
    init: function() {
        // init ui-tooltip
        $('.hero-list').tooltip({
            position: { my: "center top-31", at: "center top" },
            show: { effect: "fade", delay: 100, }
        });

        $('.search').tooltip({
            position: { my: "center top-51", at: "center top" },
            show: { effect: "fade", delay: 100, }
        });
    },
}
