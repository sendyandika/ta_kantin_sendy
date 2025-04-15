<?php

namespace App\Http\Controllers; 

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::all(); 
        return view('admin.menu', compact('menus'));
    }

    public function create()
    {
        return view('admin.createmenu');
    }
    
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name'  => 'required|string|max:255',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        // Simpan gambar jika ada
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('menu_images', 'public');
        }

        // Simpan data menu ke database
        Menu::create([
            'name'  => $request->name,
            'price' => $request->price,
            'image' => $imagePath,
        ]);

        return redirect()->route('menu')->with('success', 'Menu berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        return view('admin.editmenu', compact('menu'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $menu = Menu::findOrFail($id);
        $menu->name = $request->name;
        $menu->price = $request->price;

        // Jika ada gambar baru, hapus yang lama dan upload yang baru
        if ($request->hasFile('image')) {
            if ($menu->image) {
                Storage::delete('public/' . $menu->image);
            }
            $imagePath = $request->file('image')->store('menus', 'public');
            $menu->image = $imagePath;
        }

        $menu->save();

        return redirect()->route('menu')->with('success', 'Menu berhasil diperbarui!');
    }


    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);
    
        if ($menu->image) {
            Storage::delete('public/' . $menu->image);
        }
    
        $menu->delete();
    
        return redirect()->route('menu')->with('success', 'Menu berhasil dihapus');
    }

}
