<x-app-layout>
    <style>
        #moveableButton {
            position: absolute;
            top: 160px;
            /* initial top position */
            left: 260px;
            /* initial left position */
            z-index: 9999;
        }
    </style>
    <script>
        var clickCount = 0;

        function moveButton() {
            // Increment the click count
            clickCount++;

            // Get the button element
            var button = document.getElementById('moveableButton');

            // Generate random coordinates for the button
            var newTop = Math.floor(Math.random() * (window.innerHeight - button.offsetHeight));
            var newLeft = Math.floor(Math.random() * (window.innerWidth - button.offsetWidth));

            // Set the new position
            button.style.top = newTop + 'px';
            button.style.left = newLeft + 'px';
        }
    </script>
    <button id="moveableButton" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900" onmouseover="moveButton()">¡Reclamar Bono!</button>
    <div class="mt-20">
        <div class="w-full mx-auto p-1">
            <div class="text-gray-900 dark:text-gray-100">
                <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-3">
                    <h2>Hola {{ auth()->user()->empleado->nombre }}!</h2>
                    <p>Bienvenido al sistema de gestion de de empleados de Soporte Patitos S.A.</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>