<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\Laravel\Facades\Image;
use App\Models\Dog;


class DogController extends Controller
{
    
    public function index(Request $request)
    {
        $dogs = Dog::query();
        if($request->searchQuery != ''){
            $dogs = Dog::where('breedName', 'like', '%' . $request->searchQuery . '%');
        }
        
        $dogs = $dogs->latest()->get();
        return response()->json([
            'dogs' => $dogs], 200);
    }

    public function store(Request $request)
    {
        
       $dog = new Dog();
        $dog->breedName = $request->breedName; 
        $dog->breedSize = $request->breedSize; 
        $dog->description = $request->description;

        // Handle image upload
        if ($request->hasFile('image')) {
            // Get the uploaded image file
            $imageFile = $request->file('image');
            $imageName = time() . '.' . $imageFile->getClientOriginalExtension();

            // Resize and save the image
            $image = Image::make($imageFile)->resize(300, 300);
            $uploadPath = public_path('/upload/'); 
            $image->save($uploadPath . $imageName);

            // Save the image name to the dog record
            $dog->image = $imageName;
            $imageName = time() . '.' . $imageFile->getClientOriginalExtension();
        } else {
            $dog->image = 'no-img.png'; // Default image if none is provided
        }

        // Save the dog record to the database
        $dog->save();

        return response()->json(['message' => 'Dog added successfully!'], 201);
    }

    public function edit($id)
    {
        $dog = Dog::find($id);
        return response()->json(['dog' => $dog], 200);
    }
    public function update(Request $request, $id)
    {
        
        $dog = Dog::find($id);
        $dog->breedName = $request->breedName; 
        $dog->breedSize = $request->breedSize; 
        $dog->description = $request->description;

        // Handle image upload
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $imageName = time() . '.' . $imageFile->getClientOriginalExtension();

            
            $image = Image::make($imageFile)->resize(300, 300);
            $uploadPath = public_path('/upload/'); 
            $image->save($uploadPath . $imageName);
            $image = $uploadPath . $dog->image;
            if (file_exists($image))
            {
                unlink($image);
            } else {
                $dog->image = $dog->image; 
            }

            
            $dog->image = $imageName;
            $imageName = time() . '.' . $imageFile->getClientOriginalExtension();
        } else {
            $dog->image = 'no-img.png'; 
        }

        
        $dog->save();

        return response()->json(['message' => 'Dog updated successfully!'], 200);
    }

    public function destroy($id)
    {
        $dog = Dog::find($id);
        if ($dog) {
            $dog->delete();
            return response()->json(['message' => 'Dog deleted successfully']);
        }
        return response()->json(['message' => 'Dog not found'], 404);
    }
    
}
