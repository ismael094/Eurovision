
var base_url =  '';
$(".paises").click(function() {
    var year = $(this).data('year');
    var idPais = $(this).data('id');
    var num = $(this).data('num');
    console.log(num);
    printBackgroundCountry(num);
    ajaxSongsDataByCountry(year,idPais,num);
});
function ajaxSongsDataByCountry(year,idPais,num) {
    $.ajax({
        type: 'POST',
        url: base_url+"index.php/PaisData/printData",
        data: {'year': year,'idPais' : idPais, 'num' : num},
        success: function (data) {
            $('#dataSong').html(data);
        },
        error: function (error) {
            console.log(error);
        }

    });
}

function printBackgroundCountry(num) {
    var paises = document.getElementsByClassName('hovDiv');
    for (var x = 0;x<paises.length;x++) {
        $(paises[x]).removeClass("btn-3");
    }
    $(paises[num]).addClass("btn-3");
    //paises[num].style = "background: #1e5799;background: -moz-linear-gradient(top,  #1e5799 0%, #2989d8 50%, #7db9e8 100%);background: -webkit-linear-gradient(top,  #1e5799 0%,#2989d8 50%,#7db9e8 100%);background: linear-gradient(to bottom,  #1e5799 0%,#2989d8 50%,#7db9e8 100%);filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#1e5799', endColorstr='#7db9e8',GradientType=0 );"  
   
}
$('body').on('click', '.like',function() {
    $(this).addClass("nlike");
    $(this).removeClass("like");
    var idSong = $(this).data('id');
    $.ajax({
        type: 'POST',
        url: base_url+"index.php/AjaxPuntuacion/like",
        data: {'idSong': idSong},
        success: function (data) {
            
            
        },
        error: function (error) {
            console.log(error);
        }

    });
});

$('body').on('click', '.nlike',function() {
    $(this).addClass("like");
    $(this).removeClass("nlike");
    var idSong = $(this).data('id');
    $.ajax({
        type: 'POST',
        url: base_url+"index.php/AjaxPuntuacion/nlike",
        data: {'idSong': idSong},
        success: function (data) {
            $(this).addClass("like");
            $(this).removeClass("nlike");
            relooad(idSong);
        },
        error: function (error) {
            console.log(error);
        }

    });
});
$('body').on('click', '.nlike2',function() {
    var idSong = $(this).data('id');
    $.ajax({
        type: 'POST',
        url: base_url+"index.php/AjaxPuntuacion/nlike2",
        data: {'idSong': idSong},
        success: function (data) {
            $('.misCanc').html(data);
            
        },
        error: function (error) {
            console.log(error);
        }

    });
});

function relooad(idSong) {
    $.ajax({
        type: 'POST',
        url: base_url+"index.php/AjaxPuntuacion/nlike2",
        data: {'idSong': idSong},
        success: function (data) {
            $('.misCanc').html(data);
            
        },
        error: function (error) {
            console.log(error);
        }

    });
};

$('body').on('click', '.replay',function() {
    var name = $(this).data('name');
    var href = $(this).data('enlace');
    var id = $(this).data('id');
    $.ajax({
        type: 'POST',
        url: base_url+"index.php/Modals/printModal",
        data: {'name': name,'href' : href,'id' : id},
        success: function(data){
            $("#myModal").html(data);
            $("#myModal").modal('toggle'); 
            
        }
    });
});

$('body').on('click', '.buttonSong',function() {
    
    var num = $(this).data('num');
    var idSong = $(this).data('id');
    var puntVoz = $('#puntVoz').val();
    var puntCan = $('#puntCan').val();
    var puntEsc = $('#puntEsc').val();
    var comment = $('#comment').val();
    comment = comment.trim();
    var paises = document.getElementsByClassName('paises');
    var year = $(paises[1]).data('year');
    if (num != paises.length) {
        printBackgroundCountry(num);
        var idPais = $(paises[num]).data('id');
        year = $(paises[num]).data('year');
    }
    
    if ((puntVoz > 10 || puntVoz < 0) || (puntCan > 10 || puntCan < 0) || (puntEsc > 10 || puntEsc < 0)) {
        alert('Las puntuaciones deben estar entre 0 y 10...idiot');
        
    } else if (puntVoz != '' && puntCan != '' && puntEsc != '') {
        $.ajax({
            type: 'POST',
            url: base_url+"index.php/AjaxPuntuacion/setPunt",
            data: {'puntVoz': puntVoz,'puntCan' : puntCan,'comment' : comment, 'idSong' : idSong,'puntEsc':puntEsc,'year' : year},
            success: function (data) {
                if (num < paises.length) {
                    ajaxSongsDataByCountry(year,idPais,num);
                }
                else  {
                    $.ajax({
                        type: 'POST',
                        url: base_url+"index.php/AjaxPuntuacion/printEnd",
                        data: {'year' : year},
                        success: function (data) {
                            $('#dataSong').html(data);
                        },
                        error: function (error) {
                            console.log(error);
                        }

                    }); 
                }
            },
            error: function (error) {
                console.log(error);
            }

        });
    } 
    else {
        ajaxSongsDataByCountry(year,idPais,num);
    }
    
    if (num != (paises.length)) {
        
    }
});
$('body').on('click', '.buttonSong2',function() {
    var paises = document.getElementsByClassName('paises');
    var idPais = $(paises[0]).data('id');
    var year = $(paises[0]).data('year');
    var num=0;
    printBackgroundCountry(num);
    ajaxSongsDataByCountry(year,idPais,num);
});
$('body').on('click', '.test1 .dyCo',function() {
    var name = $(this).data('name');
    var href = $(this).data('enlace');
    var id = $(this).data('id');
    $.ajax({
        type: 'POST',
        url: base_url+"index.php/Modals/printModal",
        data: {'name': name,'href' : href,'id' : id},
        success: function(data){
            $("#myModal").html(data);
            $("#myModal").modal('toggle'); 
            
        }
    });
});

$('body').on('dblclick', '.hoop .dyCo',function() {
    var name = $(this).data('name');
    var href = $(this).data('enlace');
    var id = $(this).data('id');
    $.ajax({
        type: 'POST',
        url: base_url+"index.php/Modals/printModal",
        data: {'name': name,'href' : href,'id' : id},
        success: function(data){
            $("#myModal").html(data);
            
            $("#myModal1").modal('toggle');
            $("#myModal").modal('toggle');
            
        }
    });
});   

$('#myModal1').on('hidden.bs.modal', function () {
    if (isEmpty($("#myModal"))) {
        $('#myModal').html('');
    }
    
});

$('#myModal').on('hidden.bs.modal', function () {
    if (!isEmpty($("#myModal1 .modal-content"))) {
        $("#myModal1").modal('toggle');
    }
    $('#myModal').html('');
});

//when modal opens
$('#myModal').on('shown.bs.modal', function (e) {
    $("body").addClass("modal-open");
})
function isEmpty(el) {
    return !$.trim(el.html());
}
$('body').on('click', '.hoop .dyCo',function() {
    var id = $(this).data('id');
    var name = $(this).data('name');
    var href = $(this).data('enlace');
    var tr = document.getElementsByClassName('dyCo');
    for (var x = 0;x<tr.length;x++) {
        $(tr[x]).children().removeClass("hover2");
    }
    $(this).children().addClass("hover2");
    var num = $('#control').val();
    $('#'+num).val(id);

});


$('body').on('click', '.topButton',function() {
    var puesto = $(this).data('puesto');
    var year = $('#year').val();
    $.ajax({
        type: 'POST',
        url: base_url+"index.php/Modals/printModalTop",
        data: {'puesto' : puesto,'year' : year},
        success: function(data){
            $("#myModal1").html(data);
            $("#myModal1").modal('show');
            $('#my-table').dynatable();
            $(".modal-body").css({
                'overflow-x': 'auto'
            });
            
        }
    });
});



$('body').on('click', '.topSave',function() {
    var num = $('#control').val();
    var idCancion = $('#'+num).val();
    var puesto = num;
    var year = $('#year').val();
    $.ajax({
        type: 'POST',
        url: base_url+"index.php/TopSongs/save",
        data: {'idCancion': idCancion, 'puesto' : puesto,'year' : year},
        success: function(data){
            $('.topSongContainer').html(data);
            $('#myModal1').modal('hide')
        },
        error: function (error) {
             console.log(error);
        }
    });
});




$('body').on('click', '.modes',function() {
    var year = $('#puntYear').val();
    var mode = $(this).data('mode');
    $.ajax({
        type: 'POST',
        url: base_url+"index.php/AjaxPuntuacion/printPunt",
        data: {'mode': mode, 'site' : 'punt','year' : year},
        success: function(data){
            $('#dyTable').html(data);
            $('#my-table').dynatable({
                    readers: {
                      'can': function(el, record) {
                        return parseFloat(el.innerHTML) || 0;
                      },
                      'voz': function(el, record) {
                        return parseFloat(el.innerHTML) || 0;
                      },
                      'canj': function(el, record) {
                        return parseFloat(el.innerHTML) || 0;
                      },
                      'vozj': function(el, record) {
                        return parseFloat(el.innerHTML) || 0;
                      },
                      'cand': function(el, record) {
                        return parseFloat(el.innerHTML) || 0;
                      },
                      'vozd': function(el, record) {
                        return parseFloat(el.innerHTML) || 0;
                      },
                      'media': function(el, record) {
                        return parseFloat(el.innerHTML) || 0;
                      }
                    }
                  });
        }
    });
});

$('body').on('click', '#topUsuF',function() {
    var usu = $(this).data('usu');
    var year = $(this).data('year');
    $.ajax({
        type: 'POST',
        url: base_url+"index.php/Modals/printTopByUsu",
        data: {'usu': usu,'year' : year},
        success: function(data){
            $("#myModal1").html(data);
            $("#myModal1").modal('show');
        }
    });
    
});

$('body').on('click', '.addSongs',function() {
    var num = $(this).data('num');
    $('#addSongNum').val(num);
    printBackgroundCountry2(num);
});

function printBackgroundCountry2(num) {
    var paises = document.getElementsByClassName('hovDiv');
    for (var x = 0;x<paises.length;x++) {
        $(paises[x]).removeClass("btn-3");
    }
    $(paises[num]).addClass("btn-3");
    
}

$('#addPais').keydown(function (e){
    if(e.keyCode == 13){
        if ($('#addPais').val() != '') {
            $.ajax({
            type: 'POST',
            url: base_url+"index.php/PaisData/addCountry",
            data: {'name': $(this).val()},
            success: function(data){
                $('.lop').html(data);
                $('#addPais').val("");
            },
            error: function (error) {
                 console.log(error);
            }
        });
        }
    }
})

$('body').on('click', '.submitAddSong',function() {
    var num = $('#addSongNum').val();
    var name = $('#addSongName').val();
    var author = $('#addSongAuthor').val();
    var enlace = $('#addSongEnlace').val();
    var agno = $('#addSongAgno').val();
    var finalista = $('#submitAddFinal').val();
    var paises = document.getElementsByClassName('addSongs');
    if (num < paises.length) {
        var idPais = $(paises[num]).data('id');
    }
    if (name != '') {
        $.ajax({
        type: 'POST',
        url: base_url+"index.php/Anadir/addSongByAdmin",
        data: {'idPais': idPais,'name': name,'author' : author,'enlace' : enlace, 'agno' : agno, 'finalista' : finalista},
        success: function(data){
            $('#addSongEnlace').val("");
            $('#addSongName').val("");
            $('#addSongAuthor').val("");
            num++;
            $('#addSongNum').val(num);
            printBackgroundCountry2(num);
        },
        error: function (error) {
             console.log(error);
        }
    });
    }
});

$('body').on('click', '.closeMess',function() {
    $("#messBett").modal('toggle');
});

$('body').on('click', '.openMess',function() {
    $("#messBett").modal('toggle');
});

$('#perModal').on('hidden.bs.modal', function (e) {
    $("#messBett").modal('hide');
})

$('body').on('click', '.send',function() {
    var mess = $('#message-text').val();
    if (mess != '') {
        $.ajax({
        type: 'POST',
        url: base_url+"index.php/Anadir/addComment",
        data: {'mess': mess},
        success: function(data){
            $('#message-text').val('');
            $('#messBett').modal('toggle');
        },
        error: function (error) {
             console.log(error);
        }
    });
    }
});

