<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Inertia\Inertia;

class FileController extends Controller
{
    public function index()
    {
        $items = File::all();
        return Inertia::render('Graduation/StudentFiles', [
            'items' => $items,
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
            $parentItem = File::find($file->parent_id);
            return $parentItem ? $parentItem->path . '/' . $file->id : (string) $file->id;
        }

        return (string) $file->id;
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
    
        $file = File::findOrFail($id);
        $file->name = $request->input('name');
        $file->updated_by = Auth::id();
        $file->save();
    
        return redirect()->back()->with('success', 'Archivo actualizado exitosamente.');
    }
    
    public function destroy($id)
    {
        $file = File::findOrFail($id);
    
        if ($file->path && Storage::exists($file->path)) {
            Storage::delete($file->path);
        }
    
        $file->delete();
    
        return redirect()->back()->with('success', 'Archivo eliminado exitosamente.');
    }
    
    public function download($id)
    {
        $file = File::findOrFail($id);
        $path = storage_path('app/' . $file->path);
    
        if (file_exists($path)) {
            return Response::download($path, basename($path));
        }
    
        return abort(404, 'Archivo no encontrado');
    }
    
    public function open($id)
    {
        $file = File::findOrFail($id);
        $path = storage_path('app/' . $file->path);
    
        if (file_exists($path)) {
            return response()->file($path);
        }
    
        return abort(404, 'Archivo no encontrado');
    }
}