var qtdAtual = 0;
var regra = 1;
var regraSec = 1;
var qtdDig = 0;
let time 
var tempo = 500

$(document).ready(function (){
    if($('.lista-autocomplete').length >= 1){
        $('.lista-autocomplete-input').focus(function (e){
            let elemento = e.currentTarget.id
            elemento = elemento.replace('-input','')
            $('#'+elemento).css("display",'flex')
        })
        $('.lista-autocomplete-input').blur(function (e){
            let elemento = e.currentTarget.id
            elemento = elemento.replace('-input','')
            setTimeout(function(){$('#'+elemento).hide()},500)
        })
    }
    
})

function comboBoxList(elemento,hidden){
    let ele = document.getElementById(elemento);
    let valor = document.getElementById(elemento+'-input').value
    ele.innerHTML = ""

    if(hidden == false){
        ele.style.display = 'none'
        return
    }

    let fun = elemento.split('-')
    fun = fun[0]+fun[1][0].toUpperCase()+fun[1].substring(1);
    window[fun](valor,elemento)
    ele.style.display = 'flex'
    $('#icone-loading-select').remove()
}

function verificaCampo(elemento,hidden){
    let inp = document.getElementById(elemento+'-input')
    let con = inp.value.length
    $('#'+elemento+'-input-hiden').val('')
    if($('#icone-loading-select').length < 1){
        $("#"+elemento).after('<img id="icone-loading-select" src="/imagens/loading-redondo.gif" alt="">')
        $('#autoselect-arrow-down-'+elemento).remove()
        $('#autoselect-delete-'+elemento).remove()
    }
    clearTimeout(time)

    if(con >= regra && qtdDig >= regraSec){
        qtdDig = 0;
        time = setTimeout(()=>{
            comboBoxList(elemento,hidden);
        },tempo)
    }
    qtdDig++

    if(con == 0){
        let e = document.getElementById(elemento)
        $("#"+elemento).after('<img id="autoselect-arrow-down-'+elemento+'"  class="autoselect-arrow-down" src="/icones/arrow-down.svg" alt="">')
        $('#icone-loading-select').remove()
        e.style.display = 'none'
    }
}

function selectedOption(id,nome,elemento,callback){
    let obj = '<img id="autoselect-delete-'+elemento+'"  onclick="limparSelectLista(\''+elemento+'\')" class="autoselect-delete" src="/icones/fechar-x.svg" alt="">'
    $("#"+elemento).after(obj)
    $('#'+elemento).fadeOut()
    $('#'+elemento+'-input').val(nome)
    $('#'+elemento+'-input-hiden').val(id+" - " +nome)
    
    console.log($('#'+elemento+'-input-hiden').val())
    callback(id)
}

function limparSelectLista(elemento){
    $('#'+elemento+'-input').val('')
    $('#autoselect-delete-'+elemento).remove()
    $("#"+elemento).after('<img id="autoselect-arrow-down-'+elemento+'"  class="autoselect-arrow-down" src="/icones/arrow-down.svg" alt="">')

}