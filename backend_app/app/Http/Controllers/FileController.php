<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\FileUploadHelper;

class FileController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);
        $file = $request->file('file');
        $directory = 'uploads'; // Thư mục lưu file.

        // Upload file
        $filePath = FileUploadHelper::upload($file, $directory);

        if ($filePath) {
            return response()->json(['message' => 'File uploaded successfully', 'path' => $filePath]);
        }

        return response()->json(['message' => 'Failed to upload file'], 500);
    }

    public function delete(Request $request)
    {
        $request->validate([
            'path' => 'required|string',
        ]);

        $filePath = $request->input('path');

        // Xóa file
        if (FileUploadHelper::delete($filePath)) {
            return response()->json(['message' => 'File deleted successfully']);
        }

        return response()->json(['message' => 'Failed to delete file'], 500);
    }
}
