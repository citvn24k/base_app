<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class FileUploadHelper
{
    /**
     * Upload file lên local hoặc S3.
     *
     * @param UploadedFile $file      File cần upload.
     * @param string $directory       Thư mục lưu trữ (ví dụ: 'images').
     * @param string|null $disk       Disk sử dụng (local, s3). Nếu null, lấy mặc định từ config.
     * @return string|null            Đường dẫn file được lưu, hoặc null nếu thất bại.
     */
    public static function upload(UploadedFile $file, string $directory, string $disk = null): ?string
    {
        try {
            $disk = $disk ?: config('filesystems.default'); // Sử dụng disk mặc định nếu không truyền.
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            // Lưu file vào disk
            $filePath = $file->storeAs($directory, $fileName, $disk);

            return $filePath; // Trả về đường dẫn của file được lưu.
        } catch (\Exception $e) {
            // Log lỗi nếu cần thiết
            logger()->error('File upload failed', ['error' => $e->getMessage()]);
            return null;
        }
    }

    /**
     * Xóa file từ local hoặc S3.
     *
     * @param string $filePath    Đường dẫn file cần xóa.
     * @param string|null $disk   Disk sử dụng (local, s3). Nếu null, lấy mặc định từ config.
     * @return bool               Trả về true nếu xóa thành công, ngược lại false.
     */
    public static function delete(string $filePath, string $disk = null): bool
    {
        try {
            $disk = $disk ?: config('filesystems.default');
            return Storage::disk($disk)->delete($filePath);
        } catch (\Exception $e) {
            // Log lỗi nếu cần thiết
            logger()->error('File deletion failed', ['error' => $e->getMessage()]);
            return false;
        }
    }
}
