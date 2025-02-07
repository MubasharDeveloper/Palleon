<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BackgroundRemoverController extends Controller
{
    protected $key;

    public function __construct()
    {
        $this->key = env('SENTISIGHT_API_KEY');
    }

    public function index(Request $request)
    {
        try {
            $request->validate([
                'image' => 'required|image|max:10240' // max 10MB
            ]);

            $image = $request->file('image');
            $imageContents = file_get_contents($image->getRealPath());

            // Initialize cURL
            $curl = curl_init();
            curl_setopt_array($curl, [
                CURLOPT_URL => 'https://platform.sentisight.ai/api/pm-predict/Background-removal',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POST => true,
                CURLOPT_HTTPHEADER => [
                    'X-Auth-token: ' . $this->key,
                    'Content-Type: application/octet-stream'
                ],
                CURLOPT_POSTFIELDS => $imageContents
            ]);

            $response = curl_exec($curl);
            $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);

            if ($httpCode !== 200) {
                throw new \Exception('API request failed');
            }

            $result = json_decode($response, true);
            
            if (!isset($result[0]['image'])) {
                throw new \Exception('Invalid API response');
            }

            // Decode base64 image
            $imageData = base64_decode($result[0]['image']);
            
            // Generate unique filename
            $filename = 'bg-removed-' . Str::random(10) . '.png';
            
            // Create temporary directory if it doesn't exist
            $tempDir = public_path('temporary');
            if (!file_exists($tempDir)) {
                mkdir($tempDir, 0777, true);
            }
            
            // Store the file in public/temporary
            $filePath = $tempDir . '/' . $filename;
            file_put_contents($filePath, $imageData);

            return response()->json([
                'success' => true,
                'image_url' => asset('temporary/' . $filename),
                'filename' => $filename,
                'download_url' => route('download.image', ['filename' => $filename])
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function download($filename)
    {
        $path = public_path('temporary/' . $filename);
        
        if (!file_exists($path)) {
            abort(404);
        }

        return response()->download($path);
    }
}
