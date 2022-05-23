$(document).ready(function () {

    var dummy = [];

    $('.autocomp').each(function (i, el) {
        el = $(el);
        var id = el.attr('id');

        el.autocomplete({
            source: function (request, response) {
                var bd_tbl = el.attr('data-db');

                $.ajax({
                    url: siteUrl + '/' + "autocomplete",
                    data: {
                        term: request.term,
                        db: bd_tbl
                    },
                    dataType: "json",
                    success: function (data) {
                        var resp = $.map(data, function (obj) {
                            dummy[obj.name] = obj.id;
                           
                            return obj["name"];
                        });
                        response(resp);
                    }
                });
            },

            select: function (event, ui) {
                 $("[name=" + id +"]").val(dummy[ui.item.label]);
            },
            minLength: 2
        });
    });

});