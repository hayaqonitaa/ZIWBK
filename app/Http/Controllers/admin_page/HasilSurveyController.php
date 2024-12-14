<?php

namespace App\Http\Controllers\admin_page;

use App\Http\Controllers\Controller;
use App\Models\Admin\HasilSurvey;
use App\Models\Admin\Mahasiswa;
use App\Models\Admin\Kuesioner;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Admin\HasilSurveyImport;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class HasilSurveyController extends Controller
{
    public function index()
    {
        // Ambil semua hasil survey dan relasi dengan mahasiswa dan kuesioner
        $hasil_survey = HasilSurvey::with(['mahasiswa', 'kuesioner'])->get();

        // Kirim data hasil survey ke view
        return view('admin-page.hasil_survey.hasil_survey', compact('hasil_survey'));
    }

    public function uploadExcel(Request $request)
    {
        // Validasi file upload
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:xlsx,xls',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'File tidak valid'], 400);
        }

        try {
            // Impor data dan mendapatkan instance dari HasilSurveyImport
            $import = new HasilSurveyImport();
            Excel::import($import, $request->file('file'));

            // Ambil statistik impor
            $successCount = $import->getSuccessCount();
            $errorCount = $import->getErrorCount();
            $detailedErrors = $import->getDetailedErrors();

            // Log detailed errors
            Log::info('Import Errors:', $detailedErrors);

            // Jika ada error tetapi ada data yang berhasil diimpor
            if ($errorCount > 0) {
                if ($successCount > 0) {
                    return response()->json([
                        'message' => 'Data berhasil diimpor dengan beberapa kesalahan.',
                        'success_count' => $successCount,
                        'error_count' => $errorCount,
                        'errors' => $detailedErrors
                    ], 206); // Partial Content
                } else {
                    return response()->json([
                        'message' => 'Tidak ada data yang diimpor karena kesalahan.',
                        'errors' => $detailedErrors
                    ], 422); // Unprocessable Entity
                }
            }

            // Jika impor berhasil sempurna
            return response()->json([
                'message' => 'Data berhasil diimpor',
                'success_count' => $successCount
            ], 200);

        } catch (\Exception $e) {
            // Tangani kesalahan yang tidak terduga
            Log::error('Import error: ' . $e->getMessage());

            return response()->json([
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }
    public function checkTableStructure()
{
    // Cek struktur tabel Kuesioner
    $kuesionerColumns = DB::getSchemaBuilder()->getColumnListing('kuesioner');
    dd($kuesionerColumns);

    // Cek struktur tabel Mahasiswa
    $mahasiswaColumns = DB::getSchemaBuilder()->getColumnListing('mahasiswa');
    dd($mahasiswaColumns);
}
public function checkDataImport()
{
    // Cek data Mahasiswa
    $mahasiswas = Mahasiswa::select('nim', 'nama')->get();
    Log::info('Mahasiswa data:', $mahasiswas->toArray());

    // Cek data Kuesioner
    $kuesioners = Kuesioner::select('id', 'judul')->get();
    Log::info('Kuesioner data:', $kuesioners->toArray());

    return response()->json([
        'mahasiswas' => $mahasiswas,
        'kuesioners' => $kuesioners
    ]);
}

    // Method untuk download template (opsional)
    public function downloadTemplate()
    {
        $filePath = storage_path('app/templates/template_hasil_survey.xlsx');

        if (!file_exists($filePath)) {
            abort(404, 'Template file not found.');
        }

        return response()->download($filePath, 'template_hasil_survey.xlsx');
    }

    // Method lainnya tetap sama seperti sebelumnya
    public function getMahasiswa()
    {
        $mahasiswa = Mahasiswa::all();
        return response()->json($mahasiswa);
    }

    public function getKuesioner()
    {
        $kuesioner = Kuesioner::all();
        return response()->json($kuesioner);
    }
}