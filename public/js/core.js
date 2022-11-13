$(document).ready(function (){
    if($('#myChart').length){
        new Chart(document.getElementById('myChart'),config);
        new Chart(document.getElementById('graficoClientes'),configClientes);
    }
})