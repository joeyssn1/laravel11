<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Menu</title>
</head>
<body>
    <x-navigation></x-navigation>

<div class="modal fixed inset-0 bg-black bg-opacity-70 flex justify-center items-center z-50">
    <div class="modal-content text-white rounded-lg shadow-lg p-6 max-w-md w-full bg-maroon3">
        <h3 class="text-xl font-bold text-white mb-4">Edit Menu</h3>
        <form>
            <label class="block text-sm font-medium mb-2">New Name:</label>
            <input type="text" id="editMenuName" class="w-full bg-white text-black border p-2 rounded mb-4" placeholder="Enter new name">

            <label class="block text-sm font-medium mb-2">New Description:</label>
            <textarea id="editMenuDescription" class="w-full bg-white text-black border p-2 rounded mb-4" placeholder="Enter new description"></textarea>

            <label class="block text-sm font-medium mb-2">New Price:</label>
            <input type="text" id="editMenuPrice" class="w-full bg-white text-black border p-2 rounded mb-4" placeholder="Enter new price">

            <label class="block text-sm font-medium mb-2">New Image:</label>
            <input type="file" id="editMenuImage" accept="image/*" class="w-full bg-white text-black border p-2 rounded mb-4">

            <button type="button" class="bg-green-500 text-white px-4 py-2 rounded" onclick="saveEditedMenu()">
                Save Changes
            </button>

            <button type="button" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded mt-4" onclick="removeItemById()">
                Remove Item
            </button>
        </form>
    </div>
</div>

</body>
</html>