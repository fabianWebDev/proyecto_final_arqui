import './bootstrap';
import 'datatables.net-dt';
import $ from 'jquery';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

$('#empleado_table').DataTable({
    "lengthChange": false,
    "language": {
        'searchPlaceholder': 'Buscar',
        "search": "",
        "info": "Mostrando _END_ colaboradores de _TOTAL_ en total",
    },
    "pagingType": 'simple_numbers',
    "pageLength": 5,
});

$('#control-asistencia').DataTable({
    "lengthChange": false,
    "language": {
        'searchPlaceholder': 'Buscar',
        "search": "",
        "info": "Mostrando _END_ colaboradores de _TOTAL_ en total",
    },
    "pagingType": 'simple_numbers',
    "pageLength": 5,
});

$('#dt-search-0').addClass("mt-1 mb-4 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm");