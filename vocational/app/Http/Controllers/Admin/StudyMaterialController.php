<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StudyMaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StudyMaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $studyMaterials = StudyMaterial::all();
        return view('admin.study_materials.index', compact('studyMaterials'));
    }

    public function getAllStudyMaterials()
    {
        $studyMaterials = StudyMaterial::all();

        $studyMaterials = $studyMaterials->map(function ($item) {
            $item->image_path = asset('storage/' . $item->image_path);
            $item->file_path = asset('storage/' . $item->file_path);
            return $item;
        });

        return response()->json($studyMaterials);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.study_materials.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120', // Image validation (max 5 MB)
            'department' => 'required|string|max:255',
            'semester' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file' => 'required|file|mimes:pdf,doc,docx|max:5120', // File validation
        ]);

        $imagePath = $request->file('image')->store('images', 'public'); // Store image
        $filePath = $request->file('file')->store('study_materials', 'public'); // Store file

        // Create a new study material entry
        StudyMaterial::create([
            'title' => $request->title,
            'image_path' => $imagePath, // Save image path
            'department' => $request->department,
            'semester' => $request->semester,
            'file_path' => $filePath, // Save file path
            'description' => $request->description, // Store description
            'is_visible' => true, // For visibility, set it true by default
        ]);

        return redirect()->route('admin.study_materials.index')->with('success', 'Study Material uploaded successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(StudyMaterial $studyMaterial)
    {
        return view('admin.study_materials.show', compact('studyMaterial'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StudyMaterial $studyMaterial)
    {
        return view('admin.study_materials.edit', compact('studyMaterial'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StudyMaterial $studyMaterial)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'department' => 'required|string|max:255',
            'semester' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:2048', // File validation
        ]);

        // Find the study material
        $studyMaterial->title = $request->title;
        $studyMaterial->department = $request->department;
        $studyMaterial->semester = $request->semester;
        $studyMaterial->description = $request->description;

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($studyMaterial->image_path) {
                Storage::delete('public/' . $studyMaterial->image_path);
            }

            // Upload the new image
            $imageName = time() . '_' . $request->image->getClientOriginalName();
            $request->image->storeAs('public/study_materials/images', $imageName); // Store in storage/app/public/study_materials
            $studyMaterial->image_path = 'study_materials/images/' . $imageName; // Save image path for public access
        }

        // Handle file upload
        if ($request->hasFile('file')) {
            // Delete the old file if it exists
            if ($studyMaterial->file_path) {
                Storage::delete('public/' . $studyMaterial->file_path);
            }

            // Upload the new file
            $fileName = time() . '_' . $request->file->getClientOriginalName();
            $request->file->storeAs('public/study_materials', $fileName); // Store in storage/app/public/study_materials
            $studyMaterial->file_path = 'study_materials/' . $fileName; // Save relative path for public access
        }

        $studyMaterial->save();

        return redirect()->route('admin.study_materials.index')->with('success', 'Study Material updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StudyMaterial $studyMaterial)
    {
        if ($studyMaterial->image_path) {
            Storage::delete('public/' . $studyMaterial->image_path);
        }

        if ($studyMaterial->file_path) {
            Storage::delete('public/' . $studyMaterial->file_path);
        }

        // Delete the study material from the database
        $studyMaterial->delete();

        return redirect()->route('admin.study_materials.index')->with('success', 'Study material deleted successfully.');
    }
}