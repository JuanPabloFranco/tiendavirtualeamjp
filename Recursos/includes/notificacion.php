<?php
include '../../Conexion/consulSQL.php';
include '../plantillas/datos.php';
$notiVentas = ejecutarSQL::consultar("SELECT * FROM factura WHERE estado_factura='En Verificación'");
$verificaltotal = mysqli_num_rows($notiVentas);
if ($verificaltotal > 0) {
    ?>
    <script type="text/javascript">
        if (Notification) {
            if (Notification.permission !== "granted") {
                Notification.requestPermission()
            }
            var title = "<?php echo EMPRESA . " ". NEMPRESA?>"
            var extra = {
                icon: "Recursos/img/carrito.png",
                body: "Pedido nuevo"
            }
            var noti = new Notification(title, extra)
            var audio = new Audio('Recursos/pedido.mp3');
            audio.play();
            noti.onclick = (ev) => {
                window.open("index.php?page=ventas")
            }
            noti.onclose = {
                // Al cerrar
            }
            setTimeout(function () {
                noti.close()
            }, 20000)
        } else {
            alert("Tu navegador no soporta Notificaciones");
        }
    </script>
    <?php

}