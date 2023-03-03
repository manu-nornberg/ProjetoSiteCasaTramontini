<link rel="stylesheet" href="./css/estilo.css">

<?php

    echo "<div id='msg'>";

    if(isset($_SESSION['msg']))
    { 
        echo "<br><br>".$_SESSION['msg']."<br><br>";
        unset($_SESSION['msg']);
    }

    echo "</div>";

?>

<div class="rodapezao">
    <div class="rodape">
        <h3>argelymanu@gmail.com -
        (53) 999630649 </h3>
    </div>
</div>    

</body>