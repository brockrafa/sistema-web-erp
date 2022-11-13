var nomeUsario = '';

// ------------ CONSTANTES DE MEIO PAGAMENTO --------------------


const CARTAO_DEBITO= 600;
const DINHEIRO = 601;
const PIX = 602;
const CARTAO_CREDITO = 900;
const DINHEIRO_PARCELADO = 901;


$(document).ready(function (){

    // Limpa os argumentos GET da url
        let rota = window.location.pathname
        window.history.pushState("reset", "titulo", rota);

    // Remover mensagem de alerta caso exista
        if($('.alerta')){
            setTimeout(()=>{
                $('.alerta').fadeOut();
            },5000)
        }
    // Adicionar mascara de cpf caso exista o campo
        if($('#cpf')){
            $("#cpf").mask("999.999.999-99");
        }

    // Marcar a pagina ativa no menu lateral
        let pag = rota.split('/')[2]
        $('#'+pag).toggleClass('actived')

    // Colocar cor de 'novo status' automaticamente ao carregar pagina
        let nome = $('#status').val()
        let fonte = $('#font_color').val()
        let background = $('#background_color').val()
        let novo = $('#exemplo-status-novo');
        novo.html(nome)
        novo.css('color',fonte)
        novo.css('background-color',background)

    // Colocar data atual nos campos de data venda

    
        let data = new Date();

        let mudancaAno = false;

        let dia = ("0" + data.getDate()).slice(-2);
        let mes = data.getMonth() + 1
        let dataHoje = data.getFullYear()+"-"+(mes)+"-"+(dia);
        let mesProx  = '01'

        if((data.getMonth()+2
        ) > 12){
            mesProx = '01'
            mudancaAno = true
        }else{
            mesProx = data.getMonth()+2
            mudancaAno = false;
        }
        let anoProx = mudancaAno ? data.getFullYear() + 1 : data.getFullYear()
        let dataProxMes = anoProx+"-"+(mesProx)+"-"+(dia);

        if($('#data-venda').length >=1){
            $('#data-venda').val(dataHoje)
            $('#data-primeira-parcela').val(dataProxMes)
            $('#data-vencimento').val(dataProxMes)
        }

    // Verificar meio de pagamento
        if($('#forma-pagamento').length >= 1){
            $('#forma-pagamento').change(function (){

                let valorTotalItens = $('#valor_total').val()
                atualizaPagamento(valorTotalItens);
                
                if($('#forma-pagamento').val() == CARTAO_CREDITO || $('#forma-pagamento').val() == DINHEIRO_PARCELADO){
                    $('#qtd-parcelas').removeAttr('disabled')
                }else{
                    $('#qtd-parcelas').attr('disabled',true)
                }

            })
        }
        
})

function render(janela,e){
    e.preventDefault();
    paginas.push(janela)
    $('.quadro-exibicao').html(' <div id="tela-loading"><img src="/imagens/loading.gif" }}" alt=""></div>');

    setTimeout(()=>{
            $.get('/'+janela,(data)=>{
            $('.quadro-exibicao').html(data)
        })
    },1000)
}

function voltar(pag){
    window.location.href = "/app/"+pag;
}

function limparFiltroChamados(){
    $('#cliente').val("")
    $('#data_inicio').val("")
    $('#data_fim').val("")
    $('#situacao').val("")
    $('#usuario').val("")
    $('#departamento').val("")
    $('#atendente').val("")
}

function limparFiltroCliente(){
    $('#cliente').val("")
    $('#data_nascimento').val("")
    $('#cep').val("")
    $('#cpf').val("")
    $('#sexo').val("")
}

function limparNovoChamado(){
     $('#cliente').val("")
    $('#data_abertura').val("")
    $('#setor').val("")
    $('#tipo').val("")
    $('#prioridade').val("")
    $('#atendente').val("")
    $('#status').val("")
    $('#contrato').val("")
    $('#descricao').val("")
}

function mostrarNotificacoes(){
    $('#area-notificacoes').fadeToggle()
}

function expandDropDown(element,e){

    let elDrop = element + '-dropdown'
    let elImg = element + '-img'
    
    if($('#'+elDrop).css('display') == 'block'){
        $('#'+elDrop).fadeOut('fast');
        $('#'+elImg).toggleClass('rotate-img')
    }
    else{
        $('#'+elDrop).fadeIn('fast');
        $('#'+elImg).toggleClass('rotate-img')
    }
}

function changeColorStatus(){
    let nome = $('#status').val()
    let fonte = $('#font_color').val()
    let background = $('#background_color').val()
    let novo = $('#exemplo-status-novo');

    novo.html(nome)
    novo.css('color',fonte)
    novo.css('background-color',background)
}

function toggleMenu(){
    
    nomeUsario = $('.nome-usuario-barra-navegacao-completo').html()

    $('.barra-navegacao-container').toggleClass('fechado')
    $('body').toggleClass('body-max')

    if($('.fechado').length){
        nomeAbreviado  = nomeUsario[0]
        $('.nome-usuario-barra-navegacao').html(nomeAbreviado)
        $.get('/app/menu/1',function (data){})
    }else{
        $.get('/app/menu/0',function (data){})
        setTimeout(() => {
            $('.nome-usuario-barra-navegacao').html(nomeUsario)
        }, 200);
    }
}

function adicionarItemContaReceber(){
    let item = $('#nome_item_add').val()
    let valor= $('#valor_item_add').val()
    let qtd  = $('#quantidade_item_add').val()
    let vlT = $('#valor_total_itens').val()

    if(item != '' && valor != '' && qtd != ''){
        if($('#tabela-vazia').length){
            $('#tabela-vazia').remove()
        }
        valor = valor.replace(',','.')
        valorTotalItens = vlT*1 +(valor * qtd)
        let valorTotal = (valor * qtd).toString();
        valorTotal = "R$" + valorTotal.replace('.',',')
        valor = "R$" +  valor.replace('.',',');

        let idTemp = Math.floor(Date.now() * Math.random()).toString(36)
        let elemento = '<tr class="input-table-row" id="'+idTemp+'"><td><input readonly type="text" name="item[]" value="'+item+'"></td><td><input readonly type="text"  name="valor[]" value="'+valor+'"></td><td><input type="text" readonly name="quantidade[]" value="'+qtd+'"></td><td><input readonly type="text" value="'+valorTotal+'"></td><td><button  type="button" class="delete" onclick="deleteItemContaReceber(\''+idTemp+'\',\''+valorTotal+'\')"><img src="/icones/lixeira.svg" alt=""></button></td></tr>'
        let tr = $(elemento);
        $("tbody").append(tr);
        $('#nome_item_add').val('')
        $('#valor_item_add').val('')
        $('#quantidade_item_add').val('')
        $('#valor_total_itens').val(valorTotalItens)
        $('#valor_total').val('')
        $('#valor_total').val(valorTotalItens)
        atualizaPagamento(valorTotalItens);
    }else{
        alert('Preencha os campos para adicionar um item')
    }
}

function atualizaPagamento(valor){
    
    if(valor <= 0){
        return
    }

    let formaPagamento = $('#forma-pagamento').val()
    $("#qtd-parcelas").html('');
    $('#data-primeira-parcela').attr('disabled',true)
    if( (formaPagamento == CARTAO_CREDITO || formaPagamento == DINHEIRO_PARCELADO) && valor > 0){
        if(formaPagamento == DINHEIRO_PARCELADO){
            $('#data-primeira-parcela').removeAttr('disabled')
        }
        for(i = 1;i<=10;i++){
            let parc = valor/i;
            let elemento = '<option value="'+i+'">'+i+'x R$ '+parc.toFixed(3)+', sem juros</option>'
            let tr = $(elemento);
            $("#qtd-parcelas").append(tr);
            $('#qtd-parcelas').attr('disabled',true)
        }
    }else{
        $('#qtd-parcelas').attr('disabled',true)
        valor = valor*1
        let elemento = '<option value="'+valor+'">1x R$ '+valor.toFixed(3)+'</option>'
        let tr = $(elemento);
        $("#qtd-parcelas").append(tr);
    }
}

function deleteItemContaReceber(id,valorTotal){
    let resp = confirm('Deseja remover esse item?')
    if(resp){
        $('#'+id).remove()
    }
    let valor = valorTotal.replace(',','.')
    valor = valor.replace('R$','')
    let valorCampo = $('#valor_total_itens').val()
    let valorCorrigido = valorCampo - valor
    if(valorCorrigido <= 0){
        $('#valor_total').val('')
        $('#valor_total_itens').val('')
    }else{
        temp = valorCorrigido+''
        $('#valor_total').val(valorCorrigido)
        $('#valor_total_itens').val(valorCorrigido)
    }
    atualizaPagamento(valor)
}

//------------------------------------------ Requisições para back end ---------------------------------//

function loadTableClientes(){

    let args = "cliente="+$('#cliente').val()+"&documento="+$('#documento').val()+"&data_nascimento="+$('#data_nascimento').val()+"&cep="+$('#cep').val()+"&sexo="+$('#sexo').val()
 
    //Icone de loading
    $('.table').html(' <div id="tela-loading"><img src="/imagens/loading.gif" }}" alt=""></div>');

    $.get('/app/get-table-clientes?'+args,function(data){
        setTimeout(()=>{  
            $('.table').html(data)     
        },1000)
    })
}

function deleteCliente(id){
    let conf = confirm('Tem certeza que deseja remover esse cliente?')
    if(conf){
        $.get('/app/cliente/delete/'+id,function (data){
            if(data == 1){
                let cliente = '#cliente_'+id
                $(cliente).remove()
                alert('O cliente foi removido com sucesso')
            }else{
                alert('O cliente em questão tem um chamado associado')
            }
        })
    }
}

function deleteStatus(id){
    let conf = confirm('Tem certeza que deseja remover esse status?')
    if(conf){
        $.get('/app/configuracao/status/delete/'+id,function (data){
            if(data == 1){
                let cliente = '#status_'+id
                $(cliente).remove()
                alert('O status foi removido com sucesso')
            }else{
                alert('O status em questão tem um chamado associado')
            }
        })
    }
}

function editar(id){
    window.location.href = "/app/cliente/editar/"+id;
}

function pesquisarCep(){
    let cep = $('#cep').val()
    $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?",function (info){
        $('#logradouro').val(info.logradouro)
        $('#uf').val(info.uf)
        $('#cidade').val(info.localidade)
        $('#bairro').val(info.bairro)
    })
}

function listaClientes(valor,elemento){
    $.get('/list/clientes?nome='+valor,function (data){
        let clientes= JSON.parse(data)
        clientes.forEach(cliente => {
            let on = "onclick=\"selectedOption("+cliente.id+",'"+cliente.nome+"','"+elemento+"')\""
            $('#'+elemento).append("<span "+on+">"+cliente.id + " - " +cliente.nome+"</span>")
        });
    })
}

function listaUsuarios(valor,elemento){
    $.get('/list/usuarios?nome='+valor,function (data){
        let clientes= JSON.parse(data)
        clientes.forEach(cliente => {
            let on = "onclick=\"selectedOption("+cliente.id+",'"+cliente.nome+"','"+elemento+"')\""
            $('#'+elemento).append("<span "+on+">"+cliente.id + " - " +cliente.nome+"</span>")
        });
    })
}