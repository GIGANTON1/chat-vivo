<html>
<head>
    <title>Chat en vivo</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<h1 style="text-align: center; font-weight: bolder ">Chat de negocios web</h1>
<div class="d-flex flex-row-reverse bd-highlight">
    <div class="p-2 bd-highlight"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            Direccion Ip y Puerto
        </button></div>
</div>

<!-- Modal-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Escriba la direccion Ip</label>
                    <input type="text" class="form-control" id="ip">
                </div>
                <div class="form-group">
                    <label for="">Escriba el Pueto</label>
                    <input type="text" class="form-control" id="puerto">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
<div class="form-gruop">
    <button class="btn btn-primary" onclick="mostrar()">Iniciar chat</button>
    <hr>
    <div id="Oculto">

    </div>
</div>
<hr>
<input class="form-control" id="myInput" type="text" placeholder="Buscar Mensaje..." style="width: 20%; margin: auto">
<div style="overflow-y: scroll; height: 350px; width: 50%; margin: auto">
    <table class="table table-sm" style="margin: auto">
        <thead>
        <tr>
            <th>Nombre del que lo Envia</th>
            <th>Mensaje</th>
        </tr>
        </thead>
        <tbody id="CuerpoChat" >

        </tbody>
    </table>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<script>

    function mostrar(){
        html = `
            <label for="">Escriba un Mensaje</label>
            <input type="text" class="form-control" id="mensaje" style="width: 30%;" >
            <button id="enviar" class="btn btn-outline-dark" onclick="enviar()">Enviar mensaje</button>
        `;
        document.getElementById("Oculto").innerHTML = html;
    }

    var  ws = new WebSocket('ws://192.168.43.101:4000');

    function enviar(){
        var mensaje = document.getElementById("mensaje").value;
        var usuario = 'Oliver - ';
        ws.send(usuario+mensaje);
        document.getElementById("mensaje").value = '';
        $('#CuerpoChat').append('<tr> <td>' + mensaje +'</td> </tr>')
    }
    ws.onmessage = function(event){
        var capturar = event.data;
        $('#CuerpoChat').append('<tr> <td>'+ capturar +'</td> </tr>')
    };

    $(document).ready(function(){
        $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#CuerpoChat tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>

</body>
</html>
