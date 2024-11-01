<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pyq;
use Illuminate\Support\Facades\Storage;


class PyqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pyq = Pyq::all();
        return view('admin.upload_pyq.index', compact('pyq'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.upload_pyq.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'department' => 'required|string|max:255',
            'semester' => 'required|string|max:255',
            'subject_type' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'year' => 'nullable|string|max:255',
            'file' => 'required|file|mimes:pdf,doc,docx|max:5120', // File validation
        ]);

        $file = $request->file('file')->store('upload_pyq', 'public'); // Store file

        // Create a new study material entry
        Pyq::create([
            'department' => $request->department,
            'semester' => $request->semester,
            'subject_type' => $request->subject_type,
            'title' => $request->title,
            'year' => $request->year, // Store year
            'file' => $file, // Save file path
            'is_visible' => true, // For visibility, set it true by default
        ]);

        return redirect()->route('admin.upload_pyq.index')->with('success', 'PYQ uploaded successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pyq $pyq)
    {
        return view('admin.upload_pyq.show', compact('pyq'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pyq $pyq)
    {
        // dd($pyq->all());
        return view('admin.upload_pyq.edit', compact('pyq'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pyq $pyq)
    {
        $request->validate([
            'department' => 'nullable|string|max:255',
            'semester' => 'nullable|string|max:255',
            'subject_type' => 'nullable|string|max:255',
            'title' => 'nullable|string|max:255',
            'year' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:2048', // File validation
        ]);

        // Find the pyq
        $pyq->department = $request->department;
        $pyq->semester = $request->semester;
        $pyq->subject_type = $request->subject_type;
        $pyq->title = $request->title;
        $pyq->year = $request->year;

        // Handle file upload
        if ($request->hasFile('file')) {
            // Delete the old file if it exists
            if ($pyq->file) {
                Storage::delete('public/' . $pyq->file);
            }

            // Upload the new file
            $fileName = time() . '_' . $request->file->getClientOriginalName();
            $request->file->storeAs('public/upload_pyq', $fileName); // Store in storage/app/public/upload_pyq
            $pyq->file = 'study_materials/' . $fileName; // Save relative path for public access
        }

        $pyq->save();

        return redirect()->route('admin.upload_pyq.index')->with('success', 'PYQ updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pyq $pyq)
    {
        if ($pyq->file) {
            Storage::delete('public/' . $pyq->file);
        }

        // Delete the study material from the database
        $pyq->delete();

        return redirect()->route('admin.upload_pyq.index')->with('success', 'PYQ deleted successfully.');
    }
}