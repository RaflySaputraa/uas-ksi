<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class EncryptionController extends Controller
{
    /**
     * Enkripsi data dari request.
     */
    public function encrypt(Request $request)
    {
        $request->validate([
            'data' => 'required|string',
        ]);

        $encrypted = Crypt::encryptString($request->input('data'));

        return response()->json([
            'original'  => $request->input('data'),
            'encrypted' => $encrypted,
        ]);
    }

    /**
     * Dekripsi data dari request.
     */
    public function decrypt(Request $request)
    {
        $request->validate([
            'encrypted' => 'required|string',
        ]);

        try {
            $decrypted = Crypt::decryptString($request->input('encrypted'));

            return response()->json([
                'encrypted' => $request->input('encrypted'),
                'decrypted' => $decrypted,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Dekripsi gagal. Pastikan data terenkripsi valid.',
            ], 422);
        }
    }
}
