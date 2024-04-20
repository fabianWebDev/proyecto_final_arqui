<head>
    <title>Colilla de Pago - {{ $empleado->nombre }}</title>
</head>
<style>
    body {
        margin: 0;
        padding: 0;
        font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        font-size: 14px;
    }

    .font-lg {
        font-size: 22px;
    }

    .text-center {
        text-align: center;
    }

    .bold {
        font-weight: bold;
    }

    .m-auto {
        margin: 0 auto;
    }

    .container {
        width: 800px;
        margin: 0 auto;
    }

    .row {
        padding: 8px;
    }

    .col {
        display: inline-block;
        width: 49%;
    }

    #logo {
        width: 100px;
    }
</style>

<body>
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>Soporte Patitos S.A</h1>
                <p><a href="#">soporte-patitos.com</a></p>
                <p>Cédula jurídica: 3-209-548721</p>
                <p>Edificio Oeste, Oficina #301</p>
                <p>San José, Costa Rica</p>
            </div>
            <div class="col text-center">
                <img id="logo" src="{{ public_path('img/logo_empresa.png') }}" alt="Logo Empresa">
            </div>
        </div>
      
        <div class="row">
            <div class="col">
                <h2>Colilla de Pago</h2>
                <p>{{ $empleado->nombre }}</p>
                <p>{{ $empleado->puesto->nombre }}</p>
                <p>{{ $empleado->correo_electronico }}</p>
            </div>
            <div class="col">
                <h2>Período de Pago: {{ $this_month }}</h2>
                <p>Horario: {{ $empleado->horario->hora_entrada }} - {{ $empleado->horario->hora_salida }}</p>
                <p>Puesto: {{ $empleado->puesto->nombre }}</p>
                <p>Cuenta Bancaria: xxxxxxxxx</p>
            </div>
        </div>
      
        <div class="row">
            <div class="col">
                <h2>Impuestos</h2>
                <p>CCSS 10.67%: -{{ $reduccion_caja }}</p>
                <p>Renta: -{{ $renta }}</p>
                <p>Total Impuestos: {{ $reduccion_caja + $renta }}</p>
            </div>
            <div class="col">
                <h2>Turnos</h2>
                <p>Jornada Regular: 30 días</p>
                <p>Ausencias: {{ $ausencias }}</p>
                <p>Días trabajados: {{ $days_worked }}</p>
            </div>
        </div>
      
        <div class="row">
            <div class="col">
                <h2>Salario Bruto</h2>
                <p>{{ $empleado->puesto->salario }}</p>
            </div>
            <div class="col">
                <h2>Salario Neto</h2>
                <p class="bold">{{ $final_salary }}</p>
            </div>
        </div>
</body>