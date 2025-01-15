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

    public function edit(Request $request, $id)
    {
        $menu = Menu::find($id);
        if ($menu) {
            $menu->name = $request->input('name');
            $menu->description = $request->input('description');
            $menu->price = $request->input('price');
            if ($request->hasFile('image')) {
                $menu->image = $request->file('image')->store('images', 'public');
            }
            $menu->save();
            return response()->json(['message' => 'Menu updated successfully']);
        } else {
            return response()->json(['message' => 'Menu not found'], 404);
        }
    }

    public function delete($id)
    {
        $menu = Menu::find($id);
        if ($menu) {
            $menu->delete();
            return response()->json(['message' => 'Menu deleted successfully']);
        } else {
            return response()->json(['message' => 'Menu not found'], 404);
        }
    }
    
}
