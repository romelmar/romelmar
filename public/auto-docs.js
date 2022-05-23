$(document).ready(function () {

    var dummy = [];

    $('.autocomp').each(function (i, el) {
        el = $(el);
        var id = el.attr('id');
        el.autocomplete({
            source: function (request, response) {
                var bd_tbl = el.attr('data-db');

                $.ajax({
                    url: siteUrl + '/' + "live-search",
                    data: {
                        term: request.term,
                        db: bd_tbl
                    },
                    dataType: "json",
                    success: function (data) {
                        searchRows = "";
                        openTag = "<tbody id='live-result'>";
                        closeTag = "</tbody>";

                        console.log(siteUrl + '/' + "live-search");

                        var resp = $.map(data, function (obj) {
                            const d = new Date();
                            let month_p = d.getMonth() + 1;
                            let month =("0" + month_p).slice(-2);
                            let year = d.getFullYear();
                            let date = ("0" + d.getDate()).slice(-2);
                            
                            let today = year + "-" + month + "-" + date;

                            let thisweek =  today + 6;

                            if( obj.deadline >= today){
                                if(obj.deadline < thisweek && obj.deadline != today) elClass =  "success";
                                 else if( obj.deadline == today)  elClass =  "warning";
                            }
                            else  elClass =  "danger";

                            var urlView = siteUrl + "/documents/" + obj.id;
                            var urlEdit = siteUrl + "/documents/" + obj.id + "/edit";
                            
                            searchRows += "<tr>" +
                                            "<td>" + 
                                             
                                            '<button type="button" class="btn btn-info">Received<span class="badge bg-primary">' + obj.date_received + '</span></button>' +
                                            '<button type="button" class="btn btn-'+elClass+'">Deadline<span class="badge bg-secondary">' + obj.deadline + ' </span></button>' +
                                            "</td>"+
                                            "<td>" 
                                                + obj.subject + 
                                            "</td>"+
                                            '<td class="flex action-td">' +
                                                '<a href="' +  urlView +'"><i class="material-icons">visibility</i></a>' +
                                                '<a href="' +  urlEdit +'" rel="tooltip" title="Edit: {{ '+ obj.subject +' }}" ><i class="material-icons">edit</i></a></td>' +
                                          "</tr>";
                   
                        });

                        searchRows = openTag + searchRows + closeTag;
                        $("#live-result").replaceWith(searchRows );
                        response(resp);
                
                    }
                });
            },
        });
    });

});