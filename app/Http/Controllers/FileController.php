<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class FileController extends Controller
{
    public function index()
    {
        $files = File::all();
        return Inertia::render('Graduation/StudentFiles', [
            'files' => $files,
        ]);
    }

    public function show(File $file)
    {
        if (!$file->is_folder) {
            abort(404, 'No es una carpeta válida');
        }

        $files = File::where('parent_id', $file->id)->get();

        return inertia('Items/Show', [
            'parent' => $file,
            'items' => $files
        ]);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'is_folder' => 'required|boolean',
            'parent_id' => 'nullable|integer|exists:files,id',
        ]);

        try {
            $file = new File();
            $file->name = $validated['name'];
            $file->is_folder = $validated['is_folder'];
            $file->parent_id = $validated['parent_id'] ?? null;
            $file->created_by = Auth::id();

            if (!$file->is_folder && $request->hasFile('file')) {
                $this->storeFile($request, $file);
            } else {
                $file->path = $this->createPath($file);
            }

            $file->save();

            Log::info("Archivo o carpeta guardado exitosamente: {$file->name}");
            return redirect()->route('files.index')->with('success', 'Archivo o carpeta creada exitosamente.');
        } catch (\Exception $e) {
            Log::error("Error al guardar el archivo o carpeta: {$e->getMessage()}");
            return redirect()->back()->withErrors(['error' => 'No se pudo guardar el archivo o carpeta.']);
        }
    }

    public function storeFile(Request $request, File $file)
    {
        try {
            if ($request->hasFile('file')) {
                $fileToUpload = $request->file('file');
                $filePath = "uploads/" . $this->createPath($file);

                Storage::disk('local')->putFileAs(
                    $filePath,
                    $fileToUpload,
                    $fileToUpload->getClientOriginalName()
                );

                $file->path = $filePath . '/' . $fileToUpload->getClientOriginalName();

                Log::info("Archivo subido exitosamente: {$file->path}");
            } else {
                Log::warning("El archivo no se recibió en la solicitud.");
            }
        } catch (\Exception $e) {
            Log::error("Error al subir el archivo: {$e->getMessage()}");
        }
    }

    public function createPath(File $file)
    {
        //TODO: file path should be stored by ids
        if ($file->parent_id) {
            // Obtener la carpeta padre
            $parentItem = File::find($file->parent_id);
            return $parentItem ? $parentItem->path . '/' . $file->id : (string) $file->id;
        }

        return (string) $file->id;
    }

    public function update(Request $request, File $file)
    {
        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'file' => 'nullable|file',
        ]);

        if ($request->hasFile('file')) {

            $this->deleteFileFromStorage($file);

            $this->storeFile($request, $file);
        }
        if (isset($validated['name'])) {
            $file->name = $validated['name'];
        }

        $file->save();

        return redirect()->route('files.index');
    }

    public function move(Request $request, File $file)
    {
        $validated = $request->validate([
            'parent_id' => 'required|integer|exists:files,id',
        ]);

        $newParent = File::find($validated['parent_id']);

        if (!$file->is_folder) {
            $this->deleteFileFromStorage($file);

            $newFilePath = "uploads/{$this->createPath($newParent)}";

            $this->moveFileInStorage($file, $newFilePath);

            $file->path = $newFilePath . '/' . basename($file->path);
            $file->parent_id = $newParent->id;
            $file->save();

            return redirect()->route('files.index');
        }
        return back()->withErrors('El item seleccionado no es un archivo válido.');
    }

    public function deleteFileFromStorage(File $file)
    {
        $oldPath = storage_path('app/' . $file->path);
        if (file_exists($oldPath)) {
            unlink($oldPath);
        }
    }

    public function moveFileInStorage(File $file, $newFilePath)
    {
        $oldPath = storage_path('app/' . $file->path);
        $newPath = storage_path('app/' . $newFilePath . '/' . basename($file->path));

        if (file_exists($oldPath)) {
            rename($oldPath, $newPath);
        }
    }
}
