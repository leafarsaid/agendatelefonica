$( document ).ready(function() {
    listTag();
    listContact();
    
});

function listTag(){

    $.ajax({
        url : "api/v1/listTag.php",
        dataType: "text",
        success : function (data) {
            var tags = "";
            var combotags = "<option value=\"-1\">Todos os contatos</option>";
            combotags += "<option value=\"0\">Favoritos</option>";
            var tags_array = jQuery.parseJSON(data);
            $.each(tags_array, function(i, item) {
                tags += "<li class=\"nav-item mb-0\">";
                tags += "<div class=\"d-inline-block w-75\">";
                tags += "<a class=\"nav-link\" id=\""+item.id+"\" href=\"#\">";
                tags += "<span data-feather=\"file-text\"></span>";
                tags += item.tagname;
                tags += "</a>";
                tags += "</div>";
                tags += "<div class=\"d-inline-block w-25\">";
                tags += '<a class="" href="#">';
                tags += '<span data-feather="minus-circle"></span>';
                tags += '</a>';
                tags += '</div>';
                tags += '</li>';

                combotags += '<option value="'+item.id+'">'+item.tagname+'</option>';
            });
            $("#taglist").html(tags);
            $("#combotags").html(combotags);
            feather.replace();
        }
    });
}

function listContact(){

    $.ajax({
        url : "api/v1/listContact.php",
        dataType: "text",
        success : function (data) {
            var contacts = '<table class="table table-striped table-hover">';
            contacts += '<thead><tr><th></th><th>Título</th><th>Nome</th><th>Apelido</th>';
            contacts += '<th>Telefone</th><th>Ações</th></tr></thead><tbody>';
            var phonenumber = '';
            var contacts_array = jQuery.parseJSON(data);
            $.each(contacts_array, function(i, item) {
                if (item.phonenumber.length == 11){
                    phonenumber = item.phonenumber.replace(/(\d{2})(\d{5})(\d{4})/, '($1)$2-$3');
                }
                else if (item.phonenumber.length == 10){
                    phonenumber = item.phonenumber.replace(/(\d{2})(\d{4})(\d{4})/, '($1)$2-$3');
                }
                else {
                    phonenumber = item.phonenumber;
                }
                contacts += '<tr>';
                contacts += '<td></td>';
                contacts += '<td>'+item.title+'</td>';
                contacts += '<td>'+item.firstname+' '+item.lastname+'</td>';
                contacts += '<td>'+item.nickname+'</td>';
                contacts += '<td>'+item.countrycode+' <span class="phone">'+phonenumber+'</span></td>';
                contacts += '<td class="align-center">';
                contacts += '<button class="btn btn-sm btn-outline-secondary">';
                contacts += '<span data-feather="edit"></span>';
                contacts += '</button>';
                contacts += '<button class="btn btn-sm btn-outline-secondary">';
                contacts += '<span data-feather="trash-2"></span>';
                contacts += '</button>';
                contacts += '</td>';
                contacts += '</tr>';
            });
            contacts += '</tbody></table>';
            $("#maincontent").html(contacts);
            feather.replace();
        }
    });

    $(function(){
        $("#maincontent tr").hover(
            function(){
                //$(this).children(2).children(2).show();
                $(this).find("td > button").show();
            },
            function(){
                //$(this).children(2).children(2).hide();
                $(this).find("td > button").hide();
            }
        );
    });
}