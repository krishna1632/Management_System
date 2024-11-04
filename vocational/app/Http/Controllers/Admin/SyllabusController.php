<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Syllabus;
use Illuminate\Support\Facades\Storage;

class SyllabusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $syllabus = Syllabus::all();
        return view('admin.syllabus.index', compact('syllabus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $subjectTypes = [
            'Core' => ['BMS', 'B.Voc Software Development', 'B.com Hons'],
            'SEC' => ['Frontend', 'Analytics with Python', 'Blockchain'],
            'VAC' => ['Vedic Maths 1', 'Vedic Maths 2', 'Digital Empowerment'],
            'GE' => ['Maths', 'CS', 'Management'],
            'AEC' => ['EVS 1', 'Hindi-C', 'EVS 2'],
            'DSE' => ['DIP', 'Big Data'],
        ];

        return view('admin.syllabus.create', compact('subjectTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'subject_type' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf,doc,docx|max:5120', // File validation
        ]);

        $file = $request->file('file')->store('syllabus', 'public'); // Store file

        // Create a new syllabus entry
        Syllabus::create([
            'subject_type' => $request->subject_type,
            'name' => $request->name,
            'file' => $file, // Save file path
            'is_visible' => true, // For visibility, set it true by default
        ]);

        return redirect()->route('admin.syllabus.index')->with('success', 'Syllabus uploaded successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Syllabus $syllabus)
    {
        return view('admin.syllabus.show', compact('syllabus'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Syllabus $syllabus)
    {
        return view('admin.syllabus.edit', compact('syllabus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Syllabus $syllabus)
    {
        $request->validate([
            'subject_type' => 'nullable|string|max:255',
            'name' => 'nullable|string|max:255',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:2048', // File validation
        ]);

        // Find the syllabus
        $syllabus->subject_type = $request->subject_type;
        $syllabus->name = $request->name;

        // Handle file upload
        if ($request->hasFile('file')) {
            // Delete the old file if it exists
            if ($syllabus->file) {
                Storage::delete('public/' . $syllabus->file);
            }

            // Upload the new file
            $file = time() . '_' . $request->file->getClientOriginalName();
            $request->file->storeAs('public/syllabus', $file); // Store in storage/app/public/yllabus
            $syllabus->file = 'syllabus/' . $file; // Save relative path for public access
        }

        $syllabus->save();

        return redirect()->route('admin.syllabus.index')->with('success', 'Syllabus updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Syllabus $syllabus)
    {
        if ($syllabus->file) {
            Storage::delete('public/' . $syllabus->file);
        }

        // Delete the study material from the database
        $syllabus->delete();

        return redirect()->route('admin.upload_pyq.index')->with('success', 'Syllabus deleted successfully.');
    }
}