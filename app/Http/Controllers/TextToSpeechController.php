<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TextToSpeechController extends Controller
{
    public function saveAudio(Request $request)
    {
        if ($request->hasFile('audio')) {
            $file = $request->file('audio');
            $fileName = 'speech_' . time() . '.mp3';
            $file->move(public_path('files/audio'), $fileName);
    
            return response()->json([
                'message' => 'Audio saved successfully',
                'audio_url' => asset('files/audio/' . $fileName),
            ]);
        }
    
        return response()->json(['error' => 'No audio file received'], 400);
    }
    
}
