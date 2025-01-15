<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Table List</title>

    <link href="https://fonts.googleapis.com/css2?family=Inknut+Antiqua:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inknut+Antiqua:wght@300;400;500;600;700;800;900&family=Italianno&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    @vite('resources/css/app.css')
    
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const container = document.getElementById("button-container");
            const addButton = document.getElementById("add-button");
            const removeButton = document.getElementById("remove-button");
            const modal = document.getElementById("modal");
            const modalContent = document.getElementById("modal-content");
            const closeModal = document.getElementById("close-modal");

            let currentTableButton = null;

            // Tambahkan tombol Table
            addButton.addEventListener("click", () => {
                const newButton = document.createElement("button");
                newButton.className = "bg-maroon2 text-bone text-lg font-semibold py-5 px-40 rounded-lg hover:bg-gray-300 transition duration-300 shadow-lg";
                const tableNumber = container.children.length + 1;
                newButton.textContent = `Table ${tableNumber}`;
                newButton.addEventListener("click", () => showPopUp(newButton, tableNumber));
                container.appendChild(newButton);
            });

            // Hapus tombol terakhir
            removeButton.addEventListener("click", () => {
                if (container.lastElementChild) {
                    container.removeChild(container.lastElementChild);
                }
            });

            // Tampilkan Pop-up
            function showPopUp(button, tableNumber) {
                currentTableButton = button;
                modalContent.innerHTML = `
                    <h2 class="text-2xl font-bold mb-4 text-bone">Status Table ${tableNumber}</h2>
                    <div class="flex space-x-4">
                        <button id="status-tiada" class="bg-red-500 text-white px-7 py-2 rounded hover:bg-red-600">Add Reservation</button>
                        <button id="status-ada" class="bg-green-500 text-white px-7 py-2 rounded hover:bg-green-600">Cancel Reservation</button>
                    </div>`;
                modal.classList.remove("hidden");

                // Event listener untuk tombol "Ada" dan "Tiada"
                document.getElementById("status-ada").addEventListener("click", () => {
                    currentTableButton.className = "bg-maroon2 text-bone text-lg font-semibold py-4 px-6 rounded-lg hover:bg-gray-300 transition duration-300 shadow-lg";
                    modal.classList.add("hidden");
                });

                document.getElementById("status-tiada").addEventListener("click", () => {
                    currentTableButton.className = "bg-red-500 text-bone text-lg font-semibold py-4 px-6 rounded-lg hover:bg-red-600 transition duration-300 shadow-lg";
                    modal.classList.add("hidden");
                });
            }

            // Tutup Pop-up
            closeModal.addEventListener("click", () => {
                modal.classList.add("hidden");
            });
        });
    </script>
</head>



<body class="min-h-screen flex flex-col items-cente bg-maroon font-antiquity">

    <x-navigation></x-navigation>

    <!-- Header -->
    <header class="w-full bg-transparent text-bone py-20 flex justify-center space-x-7">
        <button id="add-button" class="bg-green-500 px-10 py-2 rounded hover:bg-green-600">Add Table</button>
        <button id="remove-button" class="bg-red-500 px-10 py-2 rounded hover:bg-red-600" >Remove Table</button>
    </header>

    <!-- Body -->
    <main class="flex flex-col items-center mt-8">
        <h1 class="text-2xl font-bold mb-6 text-bone">{{ $pagetitle }}</h1>
        <div id="button-container" class="grid grid-cols-3 gap-8">
        </div>
    </main>

    <!-- Modal -->
    <div id="modal" class=" fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center">
        <div class="bg-maroon2 p-6 rounded shadow-lg w-1/3 text-center">
            <div id="modal-content">
            </div>
            <button id="close-modal" class="mt-4 bg-gray-500 text-bone px-4 py-2 rounded hover:bg-gray-600">Close</button>
        </div>
    </div>
</body>
