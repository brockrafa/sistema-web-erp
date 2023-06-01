let visualizarContaModalID = 'visualizarConta'

function visualizarConta(idConta){
    $.get('/app/contas/receber/receive/'+idConta,function (data){
        let dados = JSON.parse(data)
        let dataFormatada =''
        if(dados.data_pagamento){
            let dataOriginal = new Date(dados.data_pagamento);
            let dia = dataOriginal.getDate().toString().padStart(2, '0');
            let mes = (dataOriginal.getMonth() + 1).toString().padStart(2, '0');
            let ano = dataOriginal.getFullYear().toString();
    
            dataFormatada = dia+'/'+mes+'/'+ano
        }

        $('#id_conta_view').val(dados.id)
        $('#valor_parcela_view').val('R$ '+dados.valor_receber.toFixed(2).replace('.',','))
        $('#data_vencimento_view').val(dados.data_vencimento)
        let nome = dados.venda.cliente.nome
        nome= nome[0].toUpperCase() + nome.substring(1)

        $('#cliente_nome_view').val(nome)
        $('#data_pagamento_view').val(dataFormatada)
        $('#valor_pago_view').val('R$ '+ Number.parseFloat(dados.valor_recebido).toFixed(2).replace('.',','))
        $('#quantidade_parcelas_view').val('Parcela '+ dados.parcela_atual + ' de ' +dados.total_parcelas + ' parcela(s)')
        
        $('#modal-area-'+visualizarContaModalID).show()
    })
}

function receberConta(id){
    window.scrollTo(0, 0);

    let data = new Date();
    let dia = ("0" + data.getDate()).slice(-2);
    let mes = (data.getMonth() + 1).toString()
   
    if(mes.length == 1){
        mes = "0" + mes
    }
    
    let dataHoje = data.getFullYear()+"-"+(mes)+"-"+(dia);
    
    $.get('/app/contas/receber/receive/'+id,function (data){
        let dados = JSON.parse(data)
        $('#id_conta').val(dados.id)
        $('#valor_parcela').val('R$ '+dados.valor_receber.toFixed(2))
        valor = dados.valor_receber
        $('#valor_pago').val(dados.valor_receber.toFixed(2))
        $('#data_vencimento').val(dados.data_vencimento)
        $('#cliente_nome').val(dados.venda.cliente.nome)
        $('#data_pagamento').val(dataHoje)
        $('#modalReceberConta').show()
    })
}

$('#btnFormReceberConta').click(function (e){

    let valorPago = $('#valor_pago').val()
    valorPago =  valorPago.replace(',','.') 
    valorPago = valorPago.replace('R$','') * 1

    let valorParcela = $('#valor_parcela').val()
    valorParcela =  valorParcela.replace(',','.')
    valorParcela = valorParcela.replace('R$','') * 1


    let decisao = $('#decisao-conta').val()

    if(valorPago > 0 && valorPago < valorParcela && decisao  == ''){
        e.preventDefault();
        $('#mensagem-modal-confirmacao p').html('<span class="texto-alerta">O valor recebido é menor do que o valor da parcela atual.</span><br> Deseja manter a conta deste mês aberta ou passar a diferença para as proximas parcelas?')
        $('#grupo-botoes-modal-confirmacao').html('<button onclick="escolhaContaModal(\'manter\')" type="button"><span>Manter conta aberta</span></button><button onclick="escolhaContaModal(\'passar\')" type="button"><span>Passar para proximas parcelas</span></button>')
        $('#modal-escolha').show()
    }else if(valorPago > 0 && valorPago > valorParcela && decisao  == ''){
        e.preventDefault();
        $('#mensagem-modal-confirmacao p').html('<span class="texto-alerta">O valor pago é maior do que o valor da parcela.</span><br> A diferença no valor será abatido no próximo mês')
        $('#grupo-botoes-modal-confirmacao').html('<button onclick="fecharModal(\'escolha-\')" type="button"><span>Cancelar</span></button><button onclick="escolhaContaModal(\'abater\')" type="button"><span>Passar para proximas parcelas</span></button>')
        $('#modal-escolha').show()
    }
    
})

