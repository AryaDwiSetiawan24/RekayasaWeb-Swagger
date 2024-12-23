<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// swagger documentation

/**
 * @OA\Info(title="My API", version="1.0.0")
 */

class MahasiswaController extends Controller
{
    /**

     * @OA\Get(

     * path="/api/mahasiswa",

     * summary="Dapatkan daftar semua mahasiswa",

     * description="Mengembalikan daftar semua mahasiswa",

     * operationId="getMahasiswa",

     * tags={"Mahasiswa"},

     * @OA\Response(

     * response=200,

     * description="Daftar mahasiswa",

     * @OA\JsonContent(

     * type="array",

     * @OA\Items(ref="#/components/schemas/Mahasiswa")

     * )

     * )

     * )

     */

    public function index()
    {
        $mahasiswa = Mahasiswa::all();
        return response()->json($mahasiswa);
    }

    /**
     * @OA\Post(
     *     path="/api/mahasiswa",
     *     summary="Simpan data mahasiswa baru",
     *     description="Menyimpan data mahasiswa baru dan mengembalikan data mahasiswa yang disimpan",
     *     operationId="storeMahasiswa",
     *     tags={"Mahasiswa"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nama", "nim", "email", "jurusan"},
     *             @OA\Property(property="nama", type="string", example="John Doe"),
     *             @OA\Property(property="nim", type="string", example="123456789"),
     *             @OA\Property(property="email", type="string", example="johndoe@example.com"),
     *             @OA\Property(property="jurusan", type="string", example="Teknik Informatika")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Mahasiswa berhasil disimpan",
     *         @OA\JsonContent(ref="#/components/schemas/Mahasiswa")
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validasi gagal",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="The given data was invalid.")
     *         )
     *     )
     * )
     */

    // Menyimpan data mahasiswa baru
    public function store(Request $request)
    {
        // Validasi data sebelum menyimpan
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|unique:mahasiswas|max:255',
            'email' => 'required|string|max:255',
            'jurusan' => 'required|string|max:255',
        ]);

        $mahasiswa = Mahasiswa::create($validatedData);
        return response()->json($mahasiswa, 201);
    }

    /**
     * @OA\Delete(
     *     path="/api/mahasiswa/{id}",
     *     summary="Hapus data mahasiswa",
     *     description="Menghapus data mahasiswa berdasarkan ID",
     *     operationId="destroyMahasiswa",
     *     tags={"Mahasiswa"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         description="ID mahasiswa yang akan dihapus"
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Mahasiswa berhasil dihapus"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Mahasiswa tidak ditemukan",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Mahasiswa not found")
     *         )
     *     )
     * )
     */

    // Menghapus data mahasiswa
    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::find($id);
        if (!$mahasiswa) {
            return response()->json(['message' => 'Mahasiswa not found'], 404);
        }
        Mahasiswa::destroy($id);
        return response()->json(null, 204);
    }
}
