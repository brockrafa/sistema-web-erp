$(document).ready(function (){
    let rota = window.location.pathname
    window.history.pushState("reset", "titulo", rota);
    if($('.alert')){
        setTimeout(()=>{
            $('.alert').fadeOut();
        },5000)
    }
})