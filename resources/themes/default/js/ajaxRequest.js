
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
    var paises = document.getElementsByClassName('paises');
    for (var x = 0;x<paises.length;x++) {
        paises[x].style = "background:#f5f5f5";
    }
    paises[num].style = "background: #1e5799;background: -moz-linear-gradient(top,  #1e5799 0%, #2989d8 50%, #7db9e8 100%);background: -webkit-linear-gradient(top,  #1e5799 0%,#2989d8 50%,#7db9e8 100%);background: linear-gradient(to bottom,  #1e5799 0%,#2989d8 50%,#7db9e8 100%);filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#1e5799', endColorstr='#7db9e8',GradientType=0 );"  
   
}

$('body').on('click', '.buttonSong',function() {
    
    var num = $(this).data('num');
    var idSong = $(this).data('id');
    var puntVoz = $('#puntVoz').val();
    var puntCan = $('#puntCan').val();
    var comment = $('#comment').val();
    var paises = document.getElementsByClassName('paises');
    var year = $(paises[1]).data('year');
    if (num != paises.length) {
        printBackgroundCountry(num);
        var idPais = $(paises[num]).data('id');
        year = $(paises[num]).data('year');
    }
    
    if ((puntVoz > 10 || puntVoz < 0) || (puntCan > 10 || puntCan < 0 )) {
        alert('Las puntuaciones deben estar entre 0 y 10...idiot');
        
    }
    
    else if (puntVoz != '' && puntCan != '') {
        $.ajax({
            type: 'POST',
            url: base_url+"index.php/AjaxPuntuacion/setPunt",
            data: {'puntVoz': puntVoz,'puntCan' : puntCan,'comment' : comment, 'idSong' : idSong},
            success: function (data) {
                if (num != paises.length) {
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
$('body').on('dblclick', '.dyCo',function() {
    var name = $(this).data('name');
    var href = $(this).data('enlace');
    var id = $(this).data('id');
    $.ajax({
        type: 'POST',
        url: base_url+"index.php/Modals/printModal",
        data: {'name': name,'href' : href,'id' : id},
        success: function(data){
            if (isEmpty($("#myModal1"))) {
                  $("#myModal").html(data);
                  $("#myModal").modal('show');

            } else {
                
                $("#myModal1").modal('toggle');
                $("#myModal").html(data);
                $("#myModal").modal('toggle');
                 
                
            }
            $('.modal-backdrop').removeClass("modal-backdrop");  
            
        }
    });
});

$('body').on('click', '.close',function() {
    if ($(this).data('model') == "0") {
        if (isEmpty($("#myModal1"))) {
            $("#myModal").modal('hide');
            $("#myModal").html('');
        } else {
            $("#myModal").modal('hide');
            $("#myModal").html('');
            $("#myModal1").modal('show');
        }
    } else {
        $("#myModal1").modal('hide');
        $("#myModal1").html('');
    }
    
});
            
$('body').on('click', '#StopButton','.close',function() {
    $("#myModal1").modal('hide');
    $("#myModal1").html('');
});

$('body').on('click', '#StopButton1','.close1',function() {
    if (isEmpty($("#myModal1"))) {
        $("#myModal").modal('hide');
        $("#myModal").html('');
    } else {
        $("#myModal").modal('hide');
        $("#myModal").html('');
        $("#myModal1").modal('show');
    }
    
    
});

function isEmpty(el) {
    return !$.trim(el.html());
}
$('body').on('click', '.dyCo',function() {
    var id = $(this).data('id');
    var name = $(this).data('name');
    var href = $(this).data('enlace');
    var tr = document.getElementsByClassName('dyCo');
    for (var x = 0;x<tr.length;x++) {
        tr[x].style = "background:white";
    }
    $(this).css("background", "#f5f5f5");
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
            $('#my-table').dynatable();
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


$(".addSongs").click(function() {
    var num = $(this).data('num');
    $('#addSongNum').val(num);
    printBackgroundCountry2(num);
});

function printBackgroundCountry2(num) {
    var addSongs = document.getElementsByClassName('addSongs');
    for (var x = 0;x<addSongs.length;x++) {
        addSongs[x].style = "background:#f5f5f5";
    }
    addSongs[num].style = "background: #1e5799;background: -moz-linear-gradient(top,  #1e5799 0%, #2989d8 50%, #7db9e8 100%);background: -webkit-linear-gradient(top,  #1e5799 0%,#2989d8 50%,#7db9e8 100%);background: linear-gradient(to bottom,  #1e5799 0%,#2989d8 50%,#7db9e8 100%);filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#1e5799', endColorstr='#7db9e8',GradientType=0 );"  
   
}
$('body').on('click', '.submitAddSong',function() {
    var num = $('#addSongNum').val();
    var name = $('#addSongName').val();
    var author = $('#addSongAuthor').val();
    var enlace = $('#addSongEnlace').val();
    var agno = $('#addSongAgno').val();
    var finalista = $('#submitAddFinal').val();
    var paises = document.getElementsByClassName('addSongs');
    if (num != paises.length) {
        printBackgroundCountry2(num);
        var idPais = $(paises[num]).data('id');
    }
    $.ajax({
        type: 'POST',
        url: base_url+"index.php/Anadir/addSongByAdmin",
        data: {'idPais': idPais,'name': name,'author' : author,'enlace' : enlace, 'agno' : agno, 'finalista' : finalista},
        success: function(data){
            console.log(data);
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
    
    
    
    
});

