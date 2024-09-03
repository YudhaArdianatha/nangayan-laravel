<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rooms = Room::all();

        if(request()->ajax()){
            return response()->json($rooms);
        }

        return view('admin.rooms.rooms', compact('rooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.rooms.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'room_type' => 'required|max:255',
            'room_description' => 'required',
            'room_price' => 'required',
            'room_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'bathroom_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'extra_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        

        $photos = [
            'room_image' => $request->file('room_image'),
            'bathroom_image' => $request->file('bathroom_image'),
            'extra_image' => $request->file('extra_image'),
        ];

        $room = Room::create($request->only(['room_type', 'room_description', 'room_price']));

        $roomSlug = $room->slug;


        foreach ($photos as $type => $photo) {
            if ($photo) {
                // Buat nama file baru
                $fileExtension = $photo->getClientOriginalExtension();
                $fileName = "{$roomSlug}_{$type}.{$fileExtension}";
    
                // Simpan file dengan nama baru
                $path = $photo->storeAs('rooms_image', $fileName, 'public');
    
                Photo::create([
                    'room_id' => $room->id,
                    'photo_type' => $type,
                    'photo_path' => $path,
                ]);
            };
        }

        return redirect('/rooms')->with('success', 'Room has been created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Room $room)
    {
        return view('admin.rooms.room', compact('room'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(room $room)
    {
        return view('admin.rooms.edit', compact('room'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Room $room)
    {
        $rules = [
            'room_type' => 'required|max:255',
            'room_description' => 'required',
            'room_price' => 'required',
            'room_image' => 'image|mimes:jpeg,png,jpg|max:2048',
            'bathroom_image' => 'image|mimes:jpeg,png,jpg|max:2048',
            'extra_image' => 'image|mimes:jpeg,png,jpg|max:2048',
        ];
    
        // Validasi input
        $validatedData = $request->validate($rules);
    
        // Handle file upload
        $photos = [
            'room_image' => $request->file('room_image'),
            'bathroom_image' => $request->file('bathroom_image'),
            'extra_image' => $request->file('extra_image'),
        ];
    
        foreach ($photos as $type => $photo) {
            if ($photo) {
                // Hapus gambar lama jika ada
                $oldPhotoPath = $room->photos->where('photo_type', $type)->first()->photo_path ?? null;
                if ($oldPhotoPath) {
                    Storage::delete('public/' . $oldPhotoPath);
                }
    
                // Simpan gambar baru
                $fileExtension = $photo->getClientOriginalExtension();
                $fileName = "{$room->slug}_{$type}.{$fileExtension}";
                $path = $photo->storeAs('rooms_image', $fileName, 'public');
    
                // Update atau buat entri photo baru
                Photo::updateOrCreate(
                    ['room_id' => $room->id, 'photo_type' => $type],
                    ['photo_path' => $path]
                );
            }
        }
    
        // Update room data
        $room->update($validatedData);
    
        return redirect('/rooms')->with('success', 'Room has been updated!');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
{
    // Hapus file gambar terkait
    foreach ($room->photos as $photo) {
        if ($photo->photo_path) {
            Storage::delete('public/' . $photo->photo_path);
        }
    }

    // Hapus entri foto dari database
    Photo::where('room_id', $room->id)->delete();

    // Hapus entri room dari database
    Room::destroy($room->id);

    return redirect('/rooms')->with('success', 'Room and associated photos have been deleted!');
}

}
