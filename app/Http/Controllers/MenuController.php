<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Category; // Import the Category model
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function getMenuforPayment()
    {
        $menus = Menu::all(); // Fetch all menus
        return view('menu', compact('menus')); // Pass the $menus variable to the view
    }

    public function getMenu(Request $request)
    {
        // Get the selected category from the query string (default to 'all' if not provided)
        $category = $request->input('category', 'all');

        if ($category !== 'all') {
            // Filter menus by category if a specific category is selected
            $menus = Menu::where('category_id', $category)->get();
        } else {
            // Retrieve all menus if 'all' is selected
            $menus = Menu::all();
        }

        // Retrieve all categories for display
        $categories = Category::all();

        // Send menus and categories data to the view
        return view('menuUser', compact('menus', 'categories'));
    }
    public function create()
    {
        return view('addMenu'); // Ensure this matches the name of your Blade file
    }

    // Handle form submission
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'food_description' => 'required|string',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
        ]);

        Menu::create([
            'name' => $request->input('name'),
            'food_description' => $request->input('food_description'),
            'price' => $request->input('price'),
            'category_id' => $request->input('category_id'),
        ]);

        return redirect('/home')->with('success', 'Menu added successfully');
    }

    public function order(Request $request, $id)
    {
        // Ambil tindakan dari tombol
        $action = $request->input('action');
        $quantities = session()->get('quantities', []);

        // Jika menu belum ada di sesi, set ke 0
        if (!isset($quantities[$id])) {
            $quantities[$id] = 0;
        }

        // Tangani logika berdasarkan tindakan
        if ($action === 'order') {
            $quantities[$id] = 1; // Jika ORDER ditekan, mulai dengan 1
        } elseif ($action === 'increase') {
            $quantities[$id]++; // Tambahkan 1 jika tombol + ditekan
        } elseif ($action === 'decrease') {
            $quantities[$id]--; // Kurangi 1 jika tombol - ditekan
        }

        // Jika jumlahnya 0 atau kurang, hapus dari sesi
        if ($quantities[$id] <= 0) {
            unset($quantities[$id]);
        }

        // Simpan kembali jumlah ke sesi
        session()->put('quantities', $quantities);

        // Redirect ke halaman menu
        return redirect()->route('menu.index');
    }


    public function showEditForm($id)
{
    $menu = Menu::find($id);
    $categories = Category::all(); // Retrieve all categories for the dropdown

    if ($menu) {
        return view('editMenu', compact('menu', 'categories'));
    }

    return redirect()->route('menu.index')->with('error', 'Menu not found');
}

public function edit(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'food_description' => 'required|string',
        'price' => 'required|numeric',
        'category_id' => 'required|exists:categories,id',
    ]);

    $menu = Menu::find($id);
    if ($menu) {
        $menu->update([
            'name' => $request->input('name'),
            'food_description' => $request->input('food_description'),
            'price' => $request->input('price'),
            'category_id' => $request->input('category_id'),
        ]);

        return redirect()->route('menu.index')->with('success', 'Menu updated successfully');
    }

    return redirect()->route('menu.index')->with('error', 'Menu not found');
}
public function delete($id)
{
    $menu = Menu::find($id);
    

    if ($menu) {
        // Remove related records in order_details
        $menu->orderDetails()->delete(); // Assuming you have a relationship defined in the Menu model
        
        // Then delete the menu
        $menu->delete();

        return redirect()->route('menu.index')->with('success', 'Menu deleted successfully');
    }

    return redirect()->route('menu.index')->with('error', 'Menu not found');
}


}