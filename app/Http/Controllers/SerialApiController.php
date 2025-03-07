<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SerialApiController extends Controller
{
    public function showSerialPaso(Request $request)
    {
        $request->validate([
            'file' => 'required|string|max:128',
            'app_env' => 'required|integer|in:0,1,2',
            'contract_server' => 'required|integer|in:0,1',
        ]);

        $file = $request->file;
        $appEnv = $request->app_env;
        $contractServer = $request->contract_server;

        $envMap = ['0' => 'AWS', '1' => 'K5', '2' => 'T2'];
        $serverMap = ['0' => 'app1', '1' => 'app2'];

        $path = "{$envMap[$appEnv]}/{$serverMap[$contractServer]}/{$file}.html";

        if (Storage::disk('imprints')->exists($path)) {
            $content = base64_encode(Storage::disk('imprints')->get($path));
            return response()->json([
                'success' => true,
                'filename' => $file . '.html',
                'content' => $content,
                'message' => 'Seal Info response successfully',
            ]);
        }

        return response()->json([
            'success' => false,
            'filename' => '',
            'message' => 'Seal Info response false',
        ]);
    }
}
