<?php
    include_once("./includes/header.php");
    require("controllers/funcoes_db.php");
    include_once("./includes/menu_geral.php");
    $conexao=fazconexao();
    $query = "select * from produtos order by cod_prod limit 3";
    $resultados=ConsultaSelectAll($query);
?>

<body>


<div class="form-container-3">  
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3392.312372337319!2d-52.360816684990475!3d-31.761965120230055!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9511b583c6a7a82f%3A0x9ee49efa9e47c433!2sAv.%20Duque%20de%20Caxias%2C%20132%20-%20COHAB%20Guabiroba%2C%20Pelotas%20-%20RS%2C%2096030-420!5e0!3m2!1spt-BR!2sbr!4v1671745406817!5m2!1spt-BR!2sbr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>         
    <div class="container-3">
        <h1>Saiba onde nos encontrar!</h1>
        <p>Av. Duque de Caxias, 132 - COHAB Guabiroba</p>
        <p>Pelotas - RS, 96030-420</p>
        <p><h3>Clique no botão para pegar suas coordenadas.</h3></p>
        <button onclick="getLocalizacao()"> Clique aqui </button>
        <div id="teste"></div>
    </div>
</div> 
</body>
<script scr="text/javascript">
    var x = document.getElementById("teste");

        function getLocalizacao() {
        if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(mostraPosicao);
        } else {
        x.innerHTML = "Geolocalização não suportada pelo browser.";
        }
        }
            function mostraPosicao(posicao) {
            x.innerHTML = "Latitude: " + posicao.coords.latitude +
            "<br>Longitude: " + posicao.coords.longitude;
            }
                    function mostraErro(erro) {

                        switch (erro.code) {
                        case erro.PERMISSION_DENIED:
                        x.innerHTML = "Usuário negou a solicitação de localização."
                        break;
                        case erro.POSITION_UNAVAILABLE:
                        x.innerHTML = "Informação de localização indisponível."
                        break;
                        case erro.TIMEOUT:
                        x.innerHTML = "Tempo de requisição expirou."
                        break;
                        case erro.UNKNOWN_erro:
                        x.innerHTML = "Erro desconhecido."
                        break;
                        }
                    }
</script>

<?php
    include_once("./includes/footer.php");
?>
<script src="./js/menu.js"></script>