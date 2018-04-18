$(document).ready(function() {
    listTag();
    listContact();

    //Região de definições de comportamento
    $(document.body).on( "click", ".marcadores", function() {
        selectTag($(this));
    });
    
    //
    $('#combotags').on( "change", function() {
        selectTag($(this), true);
    });

    //
    $('#pesquisar').bind("enterKey",function(e){
        listContact($(this).val());
     });
     $('#pesquisar').keyup(function(e){
         if(e.keyCode == 13)
         {
             $(this).trigger("enterKey");
         }
     });

    //$('#linkAdd').on( "click", function() {
        //selectTag($(this), true);
    //});

    //
    $(document.body).on( "submit", "#addTag", function(event) {
        event.preventDefault();
        deActiveAll();
        var texto = $('#addTagText').val();
        addTag(texto);
        listTag();
    });

    //
    $("#formAdd").submit(function(event) {
        event.preventDefault();
        var modal = $("#Modal2");
        if (parseInt(modal.find('#id-contact-modal').val()) > 0){
            updContact(modal);
        } else{
            addContact(modal);
        }
    });

    //
    $('#Modal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var modal = $(this);
        if (button.hasClass('del-tag')){
            modal.find('.modal-title').text('Exclusão');
            modal.find('.modal-body').text('Você deseja realmente excluir o marcador?');
            deActiveAll();
            $(document.body).on( "click", ".modal-ok", function() {
                delTag(id);
                listTag();
                modal.modal('hide');
            });
        }
        if (button.hasClass('del-contact')){
            modal.find('.modal-title').text('Exclusão');
            modal.find('.modal-body').text('Você deseja realmente excluir o contato?');
            $(document.body).on( "click", ".modal-ok", function() {
                delContact(id);
                listContact();
                modal.modal('hide');
            });
        }
    });

    //
    $('#Modal2').on('show.bs.modal', function (event) {
        $("form input:checkbox").prop('checked', false);
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var modal = $(this);
        if (button.hasClass('add-contact')){
            resetContact(modal);
        }
        if (button.hasClass('upd-contact')){
            modal.find('.modal-title').text('Atualizar contato');
            loadContact(id, modal);
        }
    });
    
    /*$("#phonenumber").mask("(99) 9999?9-9999");

    $("#phonenumber").on("blur", function() {
        var last = $(this).val().substr( $(this).val().indexOf("-") + 1 );

        if( last.length == 3 ) {
            var move = $(this).val().substr( $(this).val().indexOf("-") - 1, 1 );
            var lastfour = move + last;
            var first = $(this).val().substr( 0, 9 );

            $(this).val( first + '-' + lastfour );
        }
    });*/
    $("#phonenumber")
        .mask("(99)99999-99999")
        .focusout(function (event) {  
            var target, phone, element;  
            target = (event.currentTarget) ? event.currentTarget : event.srcElement;  
            phone = target.value.replace(/\D/g, '');
            element = $(target);  
            element.unmask();  
            if(phone.length > 10) {  
                element.mask("(99)99999-99999");  
            } else {  
                element.mask("(99)9999-99999");  
            }  
        });
    //Fim da região de definições de comportamento
});

/**
 * Define ações ao selecionar um link de marcador (que possua a classe marcador)
 * @param {*} element 
 * @param {*} iscombo 
 */
function selectTag(element, iscombo=null) {
    deActiveAll();
    var idtag = '-1';
    if (element.hasClass('favoritos')){ 
        $.each($('.favoritos'), function(i, item) {
            $(this).addClass('active');
        });
        idtag = '0';
    } else if(element.hasClass('todos')){
        idtag = '-1';
        element.addClass('active');
    } else if(parseInt(element.data('id'))>0){
        idtag = element.data('id');
        element.addClass('active');
    } else if(iscombo){
        idtag = element.val();
    }
    //console.log(idtag);
    $('#combotags').val(idtag);
    listContact(null,null,idtag);
}

/**
 * Desativa todos os realces de links
 */
function deActiveAll(){
    $.each($('nav ul li a'), function(i, item) {
        $(this).closest('nav ul').find('a.active').removeClass('active');
    });
}

/**
 * Adiciona um marcador
 * @param {*} tagname 
 */
function addTag(tagname){
    var data = { tagname: tagname };
    data = JSON.stringify(data);
    $.ajax({
        method: "POST",
        url: "api/v1/insertTag.php",
        data: data
    })
    .done(function( msg ) {
        $('#addTagText').val('');
        if(msg==0){
            alert('Erro ao inserir');
        }
        listTag();
    });
}

/**
 * Remove um marcador
 * @param {*} tagid 
 */
function delTag(tagid){
    
    var data = { id: tagid };
    data = JSON.stringify(data);
    $.ajax({
        method: "POST",
        url: "api/v1/deleteTag.php",
        data: data
    })
    .done(function( msg ) {
        if(msg==0){
            alert('Erro ao excluir');
        }
        listTag();
    });
}

/**
 * Lista os marcadores no menu lateral e na combo
 */
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
                tags += "<a class=\"nav-link marcadores\" id=\"tag"+item.id+"\" data-id=\""+item.id+"\" style=\"cursor: pointer;\">";
                tags += "<span data-feather=\"file-text\"></span>";
                tags += item.tagname;
                tags += "</a>";
                tags += "</div>";
                tags += "<div class=\"d-inline-block w-25\">";
                tags += '<a class="del-tag" id="deltag'+item.id+'" data-toggle="modal" data-target="#Modal" data-id="'+item.id+'" style="cursor: pointer;">';
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

/**
 * Limpa o formulário de cadastro de contatos
 * @param {*} modal 
 */
function resetContact(modal){
    modal.find('.modal-title').text('Novo contato');
    modal.find('#id-contact-modal').val('');
    modal.find('#firstname').val('');
    modal.find('#lastname').val('');
    modal.find('#nickname').val('');
    modal.find('#title').val('');
    modal.find('#countrycode').val('');
    modal.find('#phonenumber').val('');
}

/**
 * Carrega com informações o formulário de cadastro de contatos
 * @param {*} id 
 * @param {*} modal 
 */
function loadContact(id, modal){
    var data = { id: id };
    $.ajax({
        method: "GET",
        url: "api/v1/listContact.php",
        data: data,
        success : function( msg ) {
            $.each(msg, function(i, item) {
                modal.find('#id-contact-modal').val(id);
                modal.find('#firstname').val(item.firstname);
                modal.find('#lastname').val(item.lastname);
                modal.find('#nickname').val(item.nickname);
                modal.find('#title').val(item.title);
                modal.find('#countrycode').val(item.countrycode);
                modal.find('#phonenumber').val(item.phonenumber);
                if (item.tags != null){
                    $.each(item.tags.split(","), function(j, tag) {
                        modal.find("#chk"+tag).prop('checked', true);
                    });
                }
            });
        }
    });
    $("#phonenumber").mask("(99)99999-99999");
}

/**
 * Adiciona um contato
 * @param {*} modal 
 */
function addContact(modal){
    var data = { 
        firstname: modal.find('#firstname').val(),
        lastname: modal.find('#lastname').val(),
        nickname: modal.find('#nickname').val(),
        title: modal.find('#title').val(),
        countrycode: modal.find('#countrycode').val(),
        phonenumber: modal.find('#phonenumber').val() 
    };

    data = JSON.stringify(data);
    $.ajax({
        method: "POST",
        url: "api/v1/insertContact.php",
        data: data
    })
    .done(function( msg ) {
        modal.modal('hide');
        if(msg==1){
            listContact();
        } else{
            alert('Erro ao inserir');
        }
    });
}

/**
 * Exclui um contato
 * @param {*} id 
 */
function delContact(id){
    var data = { 
        id: id
    };

    data = JSON.stringify(data);
    $.ajax({
        method: "POST",
        url: "api/v1/deleteContact.php",
        data: data
    })
    .done(function( msg ) {
        if(msg==1){
            listContact();
        } else{
            alert('Erro ao excluir');
        }
    });
}

/**
 * Atualiza um contato
 * @param {*} modal 
 */
function updContact(modal){

    var data = { 
        id: modal.find('#id-contact-modal').val(),
        firstname: modal.find('#firstname').val(),
        lastname: modal.find('#lastname').val(),
        nickname: modal.find('#nickname').val(),
        title: modal.find('#title').val(),
        countrycode: modal.find('#countrycode').val(),
        phonenumber: modal.find('#phonenumber').val() 
    };

    data = JSON.stringify(data);
    $.ajax({
        method: "POST",
        url: "api/v1/updateContact.php",
        data: data
    })
    .done(function( msg ) {
        modal.modal('hide');
        if(msg==1){
            listContact();
        } else{
            alert('Erro ao atualizar');
        }
    });
}

/**
 * Lista contatos
 * @param {*} txt 
 * @param {*} id 
 * @param {*} idtag 
 */
function listContact(txt=null, id=null, idtag=null){

    var get = { txt: txt, id: id, idtag: idtag };
    $.ajax({
        method: "GET",
        url : "api/v1/listContact.php",
        dataType: "text",
        data: get,
        success : function (data) {
            var contacts = '<table class="table table-striped table-hover">';
            contacts += '<thead><tr>';
            contacts += '<th class="d-md-table-cell">#</th>';
            contacts += '<th class="d-none d-md-table-cell">Título</th>';
            contacts += '<th class="d-md-table-cell">Nome</th>';
            contacts += '<th class="d-none d-md-table-cell">Apelido</th>';
            contacts += '<th class="d-md-table-cell">Telefone</th>';
            contacts += '<th class="d-md-table-cell w-10"></th>';
            contacts += '<th class="d-md-table-cell w-10"></th>';
            contacts += '</tr></thead><tbody>';
            var phonenumber = '';
            var contacts_array = jQuery.parseJSON(data);
            $.each(contacts_array, function(i, item) {
                if (item.phonenumber.length == 11){ 
                    phonenumber = item.phonenumber.replace(/(\d{2})(\d{5})(\d{4})/, '($1)$2-$3');
                }
                else if (item.phonenumber.length == 10){
                    phonenumber = item.phonenumber.replace(/(\d{2})(\d{4})(\d{4})/, '($1)$2-$3');
                }
                else if (item.phonenumber.length == 9){
                    phonenumber = item.phonenumber.replace(/(\d{5})(\d{4})/, '$1-$2');
                }
                else if (item.phonenumber.length == 8){
                    phonenumber = item.phonenumber.replace(/(\d{4})(\d{4})/, '$1-$2');
                }
                else {
                    phonenumber = item.phonenumber;
                }
                contacts += '<tr>';
                contacts += '<td>'+(i+1)+'</td>';
                contacts += '<td class="d-none d-md-block">'+item.title+'</td>';
                contacts += '<td>'+item.firstname+' '+item.lastname+'</td>';
                contacts += '<td class="d-none d-md-block">'+item.nickname+'</td>';
                contacts += '<td>'+item.countrycode+' <span class="phone">'+phonenumber+'</span></td>';
                contacts += '<td>';
                contacts += '<a class="nav-link upd-contact" style="cursor: pointer;" data-toggle="modal" data-target="#Modal2" data-id="'+item.id+'">';
                contacts += '<span data-feather="edit"></span>';
                contacts += '</a>';
                contacts += '</td><td>';
                contacts += '<a class="nav-link del-contact" data-id="'+item.id+'"data-toggle="modal" data-target="#Modal" style="cursor: pointer;">';
                contacts += '<span data-feather="trash-2"></span>';
                contacts += '</a>';
                contacts += '</td>';
                contacts += '</tr>';
            });
            contacts += '</tbody></table>';
            $("#maincontent").html(contacts);
            feather.replace();
        }
    });
}