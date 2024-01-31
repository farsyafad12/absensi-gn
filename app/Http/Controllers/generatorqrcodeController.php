<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Storage;
//use Illuminate\Support\Facades\Response;
//use Illuminate\Support\Facades\Session;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\Log;
use App\Models\data_siswa;
use Endroid\QrCode\QrCode;
use ZipArchive;


class generatorqrcodeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function generate_qr()
    {
        $judul = 'Generate QR Code Siswa';
        $siswa = data_siswa::count();
        return view('other-page/generate-qr', ['title' => $judul], compact('siswa'));
    }

    public function generate()
    {
        $siswaCollection = data_siswa::all();
        $zipFileName = 'qrcode_gn.zip';
        $zipFilePath = storage_path($zipFileName);
        $tempDir = storage_path('qrcode_gn');

        if (!file_exists($tempDir)) {
            mkdir($tempDir, 0777, true);
        }

        foreach ($siswaCollection as $siswa) {
            $kelasDir = $tempDir . '/' . $siswa->kelas->kelas;

            if (!file_exists($kelasDir)) {
                mkdir($kelasDir, 0777, true);
            }

            $this->generateQRCode($siswa->nisn, $siswa->nama_siswa, $siswa->kelas->kelas, $kelasDir);
        }

        $zip = new ZipArchive();

        if ($zip->open($zipFilePath, ZipArchive::CREATE) === true) {
            $this->addFilesToZip($tempDir, $zip);
            $zip->close();

            $this->cleanUpTempDir($tempDir);

            return response()->download($zipFilePath, $zipFileName);
        } else {
            Log::error("Gagal membuat file zip: $zipFilePath");
            return response()->json(['error' => 'Gagal membuat file zip.']);
            return redirect()->route('qr_siswa')->with('message-failed', 'Gagal Generate QR Code Siswa, Mohon Coba Lagi Nanti');
        }
    }

    protected function generateQRCode($text, $namaSiswa, $kelas, $tempDir)
    {
        $qrCode = new QrCode($text);
        $qrCode->setSize(400);
        $writer = new PngWriter();
        $pngResult = $writer->write($qrCode);
        $imageData = $pngResult->getString();
        $fileName = $this->generateFileName($namaSiswa, $kelas) . '.png';
        $path = $tempDir . '/' . $fileName;

        file_put_contents($path, $imageData);
    }

    protected function generateFileName($namaSiswa, $text)
    {
        $cleanedNamaSiswa = preg_replace('/[^a-zA-Z0-9]/', '_', $namaSiswa);
        $cleanedText = preg_replace('/[^a-zA-Z0-9]/', '_', $text);
        $combinedText = $cleanedNamaSiswa . '_' . substr($cleanedText, 0, 50);
        return $combinedText;
    }

    protected function addFilesToZip($source, $zip)
    {
        $files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($source), \RecursiveIteratorIterator::SELF_FIRST);

        foreach ($files as $file) {
            if (!$file->isDir()) {
                $filePath = $file->getRealPath();
                $relativePath = substr($filePath, strlen($source) + 1);

                $zip->addFile($filePath, $relativePath);
            }
        }
    }


    protected function cleanUpTempDir($tempDir)
{
    $files = new \RecursiveIteratorIterator(
        new \RecursiveDirectoryIterator($tempDir, \RecursiveDirectoryIterator::SKIP_DOTS),
        \RecursiveIteratorIterator::CHILD_FIRST
    );

    foreach ($files as $file) {
        if ($file->isDir()) {
            rmdir($file->getRealPath());
        } else {
            unlink($file->getRealPath());
        }
    }

    rmdir($tempDir);
}

}
