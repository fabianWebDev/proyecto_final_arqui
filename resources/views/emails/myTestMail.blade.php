<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Colilla de Pago</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 p-8">
    <div class="max-w-4xl mx-auto bg-white shadow-md rounded-md p-6">
        <div class="flex justify-between items-center mb-6">
            <div class="text-left">
                <h1 class="text-lg font-bold">Soporte Patitos S.A</h1>
                <p>Carlos García Pérez</p>
                <p><a href="#" class="text-blue-500">soporte-patitos.com</a></p>
                <p>carlos.garcia@soporte-patitos.com</p>
                <p>Cédula jurídica: 3-209-548721</p>
                <p>Identificación: 207890123</p>
                <p>Edificio Oeste, Oficina #301</p>
                <p>San José, Costa Rica</p>
            </div>
            <div class="text-right">
                <img class="w-20 h-20 fill-current text-gray-500" src="{{ asset('img/logo_empresa.png') }}" alt="Logo Empresa">
            </div>
        </div>
        <hr class="my-6">
        <div class="grid grid-cols-2 gap-6 mb-6">
            <div>
                <h2 class="text-lg font-bold mb-4">RECIBO OFICIAL DE SALARIO</h2>
                <p>Período de Pago: 1 - 15 de Abril de 2024</p>
                <p>Tipo de cambio: ₡510.25 Segunda Quincena de Abril, 2024</p>
                <p>Puesto: Desarrollador Web</p>
                <p>Cuenta Bancaria: 1234567890</p>
            </div>
            <div>
                <h2 class="text-lg font-bold mb-4">Impuestos</h2>
                <p>CCSS @ 9.34%: -$157.82</p>
                <p>Renta @ 10%: -$50.72</p>
                <p>Renta @ 15%: -$38.09</p>
                <p>Renta @ 20%: -$0.00</p>
                <p>Renta @ 25%: -$0.00</p>
                <p>Crédito Familiar: -$0.00</p>
                <p class="font-bold mt-4">Total Impuestos: -$246.63</p>
            </div>
        </div>
        <hr class="my-6">
        <div class="grid grid-cols-2 gap-6 mb-6">
            <div>
                <h2 class="text-lg font-bold mb-4">Turnos</h2>
                <p>Jornada Regular: 11.00 días - $1,155.55</p>
                <p>Feriados: 3.00 días - $311.11</p>
                <p>Días de compensación: 2.00 días - $222.22</p>
                <p>Enfermedad - Pagado: 1.00 día - $111.11</p>
                <p>Horas Extra: 0.00 horas - $0.00</p>
                <p>Pensión Voluntaria: -$0.00</p>
            </div>
            <div>
                <h2 class="text-lg font-bold mb-4">Deducciones</h2>
                <p>Médicas: -$50.00</p>
                <p>Maternidad: -$0.00</p>
                <p>Paternidad: -$0.00</p>
                <p>Odontológicos: -$20.00</p>
                <p>Otras: -$0.00</p>
                <p class="font-bold mt-4">Total Deducciones: -$70.00</p>
            </div>
        </div>
        <hr class="my-6">
        <div class="text-right">
            <h2 class="text-lg font-bold">Salario Neto</h2>
            <p class="font-bold">$1,135.03</p>
        </div>
    </div>
</body>

</html>