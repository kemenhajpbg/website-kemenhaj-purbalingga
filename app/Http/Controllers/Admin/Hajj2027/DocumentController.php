<?php

namespace App\Http\Controllers\Admin\Hajj2027;

use App\Http\Controllers\Controller;
use App\Models\Hajj2027Document;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DocumentController extends Controller
{
    public function index(): View
    {
        $documents = Hajj2027Document::query()
            ->orderBy('urutan')
            ->orderByDesc('tanggal')
            ->orderByDesc('id')
            ->get();

        return view('admin.hajj-2027.documents.index', compact('documents'));
    }

    public function create(): View
    {
        $document = new Hajj2027Document([
            'kategori' => 'Panduan',
            'tanggal' => now()->toDateString(),
            'status' => 'Aktif',
            'urutan' => (Hajj2027Document::query()->max('urutan') ?? 0) + 1,
        ]);

        return view('admin.hajj-2027.documents.form', compact('document'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request, true);

        if ($request->hasFile('document_file')) {
            $fileInfo = $this->uploadDocument($request->file('document_file'));
            $data['file'] = $fileInfo['path'];
            $data['file_name'] = $fileInfo['name'];
            $data['file_size'] = $fileInfo['size'];
        }

        Hajj2027Document::query()->create($data);

        return redirect()->route('admin.jemaah-2027.documents.index')->with('success', 'Dokumen panduan berhasil ditambahkan.');
    }

    public function edit(Hajj2027Document $document): View
    {
        return view('admin.hajj-2027.documents.form', ['document' => $document]);
    }

    public function update(Request $request, Hajj2027Document $document): RedirectResponse
    {
        $data = $this->validated($request, false);

        if ($request->hasFile('document_file')) {
            if ($document->file && file_exists(public_path($document->file))) {
                @unlink(public_path($document->file));
            }

            $fileInfo = $this->uploadDocument($request->file('document_file'));
            $data['file'] = $fileInfo['path'];
            $data['file_name'] = $fileInfo['name'];
            $data['file_size'] = $fileInfo['size'];
        }

        $document->update($data);

        return redirect()->route('admin.jemaah-2027.documents.index')->with('success', 'Dokumen panduan berhasil diperbarui.');
    }

    public function destroy(Hajj2027Document $document): RedirectResponse
    {
        if ($document->file && file_exists(public_path($document->file))) {
            @unlink(public_path($document->file));
        }

        $document->delete();

        return redirect()->route('admin.jemaah-2027.documents.index')->with('success', 'Dokumen panduan berhasil dihapus.');
    }

    private function validated(Request $request, bool $isNew = false): array
    {
        $rules = [
            'judul' => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string', 'max:1000'],
            'kategori' => ['required', 'string', 'max:100'],
            'tanggal' => ['nullable', 'date'],
            'status' => ['required', 'string', 'in:Aktif,Nonaktif'],
            'urutan' => ['required', 'integer'],
            'document_file' => [$isNew ? 'required' : 'nullable', 'file', 'mimes:pdf,doc,docx,xls,xlsx,zip,ppt,pptx', 'max:15360'],
        ];

        return $request->validate($rules);
    }

    private function uploadDocument($file): array
    {
        $dir = 'uploads/hajj_documents';
        $targetDir = public_path($dir);
        if (! is_dir($targetDir)) {
            mkdir($targetDir, 0755, true);
        }

        $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeName = preg_replace('/[^a-zA-Z0-9_-]/', '-', $originalName);
        $ext = strtolower($file->getClientOriginalExtension());
        $filename = $safeName . '-' . time() . '.' . $ext;

        $bytes = $file->getSize();
        $formattedSize = $this->formatBytes($bytes);

        $file->move($targetDir, $filename);

        return [
            'path' => $dir . '/' . $filename,
            'name' => $file->getClientOriginalName(),
            'size' => $formattedSize,
        ];
    }

    private function formatBytes(int $bytes, int $precision = 1): string
    {
        $units = ['B', 'KB', 'MB', 'GB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= pow(1024, $pow);

        return round($bytes, $precision) . ' ' . $units[$pow];
    }
}
