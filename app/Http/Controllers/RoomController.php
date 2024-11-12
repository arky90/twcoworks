<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;

class RoomController extends Controller
{
    public function create(Request $request)
    {
        // Validación de los datos
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'id' => 'nullable'
        ]);
 
        $id = $request->input('id'); 
        if($id){
            $rom = Room::findOrFail($id);
            $rom->name = $request->input('name');
            $rom->description = $request->input('description');
            $rom->save();
        
            return redirect()->back()->with('success', 'Actualizado Room ID: '.$id);
        }else{
            // Creación de la nueva sala
            Room::create([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
            ]); 

            // Redirecciona con un mensaje de éxito
             return redirect()->back()->with('success', 'Room agregado exitosamente.');
        }
    }

    // Delete the Room by Id
    public function delete($id)
    {
        $post = Room::findOrFail($id);
        $post->delete();
    
        return redirect()->back()->with('success', 'El Room ha sido eliminado correctamente.');
    }
}