<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Category; // Import the Category model
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    public function getMenuforPayment()
    {
        $menus = Menu::all(); // Fetch all menus
        return view('menu', compact('menus')); // Pass the $menus variable to the view
    }

    public function getMenu()
    {
        $categories = Category::all();  // Assuming you have a Category model
        $menus = Menu::all();
        $quantities = session()->get('quantities', []);

        return view('menuUser', compact('categories', 'menus', 'quantities'));
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

        return redirect('/menu')->with('success', 'Menu added successfully');
    }

    
    public function order(Request $request, $id)
    {
        $action = $request->input('action');
        $quantities = session()->get('quantities', []);

        if (!isset($quantities[$id])) {
            $quantities[$id] = 0;
        }

        if ($action === 'increase') {
            $quantities[$id]++;
        } elseif ($action === 'decrease' && $quantities[$id] > 0) {
            $quantities[$id]--;
        }

        // Remove item if quantity is 0
        if ($quantities[$id] <= 0) {
            unset($quantities[$id]);
        }

        session()->put('quantities', $quantities);

        return response()->json(['quantity' => $quantities[$id] ?? 0]);
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

            return redirect()->route('menu')->with('success', 'Menu updated successfully');
        }

        return redirect()->route('menu')->with('error', 'Menu not found');
    }

    public function delete($id)
    {
        $menu = Menu::find($id);
        

        if ($menu) {
            // Remove related records in order_details
            $menu->orderDetails()->delete(); // Assuming you have a relationship defined in the Menu model
            
            // Then delete the menu
            $menu->delete();

            return redirect()->route('menu')->with('error', 'Menu not found');
        }

        return redirect()->route('menu')->with('error', 'Menu not found');
    }

    // menu user button add to cart
    public function index()
    {
        // Retrieve all menus and categories
        $menus = \App\Models\Menu::all();
        $categories = \App\Models\Category::all();

        // Get current quantities from the session
        $quantities = session()->get('quantities', []);

        return view('menu.index', compact('menus', 'categories', 'quantities'));
    }

    // Handle the increase or decrease of menu quantity
    public function updateQuantity(Request $request, $id)
    {
        $action = $request->input('action');
        $quantities = session()->get('quantities', []);

        if ($action == 'increase') {
            $quantities[$id] = isset($quantities[$id]) ? $quantities[$id] + 1 : 1;
        } elseif ($action == 'decrease') {
            if (isset($quantities[$id]) && $quantities[$id] > 0) {
                $quantities[$id]--;
            }
        }

        // Save the updated quantities to the session
        session()->put('quantities', $quantities);

        // Return updated quantity as JSON response
        return response()->json(['quantity' => $quantities[$id] ?? 0]);
    }

    // Add this new method to handle adding to cart
    public function addToCart()
    {
        $quantities = session()->get('quantities', []);
        
        // If cart is empty, redirect back with message
        if (empty($quantities)) {
            return redirect()->back()->with('error', 'Please select items before adding to cart');
        }

        // Create new order
        $order = Order::create([
            'user_id' => Auth::id(),
            'status' => 'unpaid'
        ]);

        // Add items to order_details
        foreach ($quantities as $menuId => $quantity) {
            if ($quantity > 0) {
                $menu = Menu::find($menuId);
                if ($menu) {
                    OrderDetail::create([
                        'order_id' => $order->id,
                        'menu_id' => $menuId,
                        'quantity' => $quantity,
                        'subtotal' => $menu->price * $quantity
                    ]);
                }
            }
        }

        // Clear the cart
        session()->forget('quantities');

        return redirect()->route('payment');
    }
}