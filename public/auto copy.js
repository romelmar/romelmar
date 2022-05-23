$(document).ready(function () {
    var dummy=[];
    $(".autocomp").autocomplete({

        source: function (request, response) {
            $.ajax({
                url: siteUrl + '/' + "autocomplete",
                data: {
                    term: request.term
                },
                dataType: "json",
                success: function (data) {
                    var resp = $.map(data, function (obj) {
                        dummy[obj.name] = obj.id;
                        return obj.name;
                    });
                    
                    response(resp);
                }
            });
        },
        select: function (event, ui) { 
            // $("#origin_office").val(dummy[ui.item.label]);
            name = $(this).attr('id');
            // alert(name);
             $("[name=" + name +"]").val(dummy[ui.item.label]);
        },
        minLength: 2
    });
});