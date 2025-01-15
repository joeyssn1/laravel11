<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Santo's Menu</title>
    

    <link href="https://fonts.googleapis.com/css2?family=Inknut+Antiqua:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inknut+Antiqua:wght@300;400;500;600;700;800;900&family=Italianno&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    

</head>

<body class="bg-maroon text-white font-sans">

    <!-- Header -->
    <x-navigation></x-navigation>

<div class="font-antiquity">
    <!-- Title -->
    <div class="text-center mt-20 font-antiquity">
        <h2 class="text-3xl font-bold tracking-widest">Santo's Menu</h2>
    </div>

    <div class="flex justify-center mt-6">
        <button class="bg-maroon3 hover:bg-rose-300 text-white px-4 py-2 rounded" onclick="openModal('addMenu')">
            Add Menu
        </button>
    </div>


    <!-- Navigation Links -->
    <div class="flex justify-center space-x-8 mt-4 mb-8">
        <a href="#appetizers" class="text-lg font-semibold hover:text-orange-400 transition duration-300"
            onclick="filterMenu('Appetizers', this)">Appetizers</a>
        <a href="#entrees" class="text-lg font-semibold hover:text-orange-400 transition duration-300"
            onclick="filterMenu('Entrees', this)">Entrees</a>
        <a href="#desserts" class="text-lg font-semibold hover:text-orange-400 transition duration-300"
            onclick="filterMenu('Desserts', this)">Desserts</a>
        <a href="#beverages" class="text-lg font-semibold hover:text-orange-400 transition duration-300"
            onclick="filterMenu('Beverages', this)">Beverages</a>
    </div>

    <!-- Menu Section -->
    <main class="p-8">
        <div id="menu-container" class="flex flex-col space-y-6">
            <!-- Menu items will be injected here -->
        </div>

        <!-- Action Buttons -->
    </main>

    <!-- Edit Modals -->
    <div id="editMenuModal"
        class="modal hidden fixed inset-0 bg-black bg-opacity-70 flex justify-center items-center z-50">
        <div class="modal-content text-white rounded-lg shadow-lg p-6 max-w-md w-full bg-maroon3">
            <h3 class="text-xl font-bold text-white mb-4">Edit Menu</h3>
            <form>

                <!-- New Name -->
                <label class="block text-sm font-medium mb-2">New Name:</label>
                <input type="text" id="editMenuName" class="w-full bg-white text-black border p-2 rounded mb-4"
                    placeholder="Enter new name">

                <!-- New Description -->
                <label class="block text-sm font-medium mb-2">New Description:</label>
                <textarea id="editMenuDescription" class="w-full bg-white text-black border p-2 rounded mb-4"
                    placeholder="Enter new description"></textarea>

                <!-- New Price -->
                <label class="block text-sm font-medium mb-2 ">New Price:</label>
                <input type="text" id="editMenuPrice" class="w-full bg-white text-black border p-2 rounded mb-4"
                    placeholder="Enter new price">

                <!-- New Photo File -->
                <label class="block text-sm font-medium mb-2">New Image:</label>
                <input type="file" id="editMenuImage" accept="image/*"
                    class="w-full bg-white text-black border p-2 rounded mb-4">

                <!-- Save Button -->
                <button type="button" class="bg-green-500 text-white px-4 py-2 rounded" onclick="saveEditedMenu()">
                    Save Changes
                </button>

                <!-- New Remove Button -->
                <button type="button" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded mt-4"
                    onclick="removeIte
                    mById()">
                    Remove Item
                </button>
            </form>
        </div>
    </div>




    <!-- Add Modals -->
    <div id="addMenuModal" class="modal hidden fixed inset-0 bg-opacity-70 flex justify-center items-center z-50">
        <div class="modal-content text-white rounded-lg shadow-lg p-6 max-w-md w-full bg-maroon3">
            <h3 class="text-xl font-bold text-white mb-4">Add Menu</h3>
            <form>

                <!-- Add Name -->
                <label class="block text-sm font-medium mb-2">Name:</label>
                <input type="text" id="newMenuName" class="w-full bg-white text-black p-2 rounded mb-4"
                    placeholder="Enter menu item name">

                <!-- Add Description -->
                <label class="block text-sm font-medium mb-2">Description:</label>
                <textarea id="newMenuDescription" class="w-full bg-white text-black p-2 rounded mb-4" placeholder="Enter description"></textarea>

                <!-- Add Price -->
                <label class="block text-sm font-medium mb-2">Price:</label>
                <input type="text" id="newMenuPrice" class="w-full bg-white text-black p-2 rounded mb-4"
                    placeholder="Enter price">

                <!-- Add Photo -->
                <label class="block text-sm font-medium mb-2">Image:</label>
                <input type="file" id="newMenuImage" accept="image/*"
                    class="w-full bg-white text-black p-2 rounded mb-4">

                <!-- Add Category -->
                <label class="block text-sm font-medium mb-2">Category:</label>
                <select id="newMenuCategory" class="w-full bg-white text-black p-2 rounded mb-4">
                    <option>Appetizers</option>
                    <option>Entrees</option>
                    <option>Desserts</option>
                    <option>Beverages</option>
                </select>

                <!-- New Add Item -->
                <button type="button" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded"
                    onclick="">
                    Add Item
                </button>

            <!-- Return (Cancel) Button -->
            <button type="button" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded mt-4" onclick="closeModal('addMenu')">
                Cancel
            </button>
            </form>
        </div>
    </div>
</div>

</body>

</html>