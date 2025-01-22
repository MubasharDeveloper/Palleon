<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $data = [];
$files = scandir(public_path('files/templates'));

foreach ($files as $file) {
    // Only consider .png files
    if (pathinfo($file, PATHINFO_EXTENSION) === 'png') {
        // Check if corresponding .json file exists
        $jsonFile = pathinfo($file, PATHINFO_FILENAME) . '.json';
        if (file_exists(public_path('files/templates/' . $jsonFile))) {
            $data[] = [
                'name' => pathinfo($file, PATHINFO_FILENAME), // Template name
                'image' => asset('files/templates/' . $file), // Image URL
                'json' => 'files/templates/' . $jsonFile, // JSON file URL
            ];
        }
    }
}
        $categories = Category::all();
        return view('index',compact('categories','data'));
    }

    public function GetTemplateLinks(){
$data = [];
$files = scandir(public_path('files/templates'));
foreach ($files as $file) {
    if (pathinfo($file, PATHINFO_EXTENSION) == 'png') {
        $fileNameWithoutExtension = pathinfo($file, PATHINFO_FILENAME); // Get the file name without extension
        
        // Handle text file for template name
        $textFilePath = public_path('files/templates/' . $fileNameWithoutExtension . '.txt');
        $templateName = '';
        
        if (file_exists($textFilePath)) {
            $templateName = file_get_contents($textFilePath);
        } else {
            $templateName = 'Template #' . $fileNameWithoutExtension;
            file_put_contents($textFilePath, $templateName);
        }
        
        $data[] = [
            'name' => $fileNameWithoutExtension,
            'display_name' => $templateName,
            'image' => asset('files/templates/' . $file),
            'gif' => file_exists(public_path('files/templates/' . $fileNameWithoutExtension . '.gif')) ? asset('files/templates/' . $fileNameWithoutExtension . '.gif') : null,
            'link' => url('template/' . $fileNameWithoutExtension), // Exclude extension
        ];
    }
}

    return response()->json($data);
    }

    public function GetTemplateLink($name){
        $data = [];
$files = scandir(public_path('files/templates'));
foreach ($files as $file) {
    if (pathinfo($file, PATHINFO_EXTENSION) == 'png') {
        $fileNameWithoutExtension = pathinfo($file, PATHINFO_FILENAME); // Get the file name without extension
        $data[] = [
            'name' => $file,
            'image' => asset('files/templates/' . $file),
            'link' => url('template/' . $fileNameWithoutExtension), // Exclude extension
        ];
    }
}

    return response()->json($data);
    }

    public function uploadTemplate(Request $request)
    {
        $request->validate([
            'display_name' => 'required|string',
            'template_name' => 'required|string',
            'gif_file' => 'nullable|string'  // base64
        ]);

        try {
            $templateName = $request->template_name;
            $templatesPath = public_path('files/templates');
            
            // Check if template exists
            if (!file_exists($templatesPath . '/' . $templateName . '.png')) {
                return response()->json([
                    'success' => false,
                    'message' => 'Template not found'
                ], 404);
            }

            // Update display name in text file
            $textFilePath = $templatesPath . '/' . $templateName . '.txt';
            file_put_contents($textFilePath, $request->display_name);

            // Handle GIF file if provided
            if ($request->gif_file && !empty($request->gif_file)) {
                $gifData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $request->gif_file));
                if ($gifData) {
                    $gifFileName = $templateName . '.gif';
                    file_put_contents($templatesPath . '/' . $gifFileName, $gifData);
                }
            }

            // Prepare response data
            $responseData = [
                'name' => $templateName,
                'display_name' => $request->display_name,
                'image' => asset('files/templates/' . $templateName . '.png'),
                'gif' => file_exists($templatesPath . '/' . $templateName . '.gif') ? 
                    asset('files/templates/' . $templateName . '.gif') : null,
                'link' => url('template/' . $templateName)
            ];

            return response()->json([
                'success' => true,
                'message' => 'Template display name updated successfully',
                'data' => $responseData
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating template: ' . $e->getMessage()
            ], 500);
        }
    }

    public function deleteTemplate(Request $request)
    {
        $request->validate([
            'template_name' => 'required|string'
        ]);

        try {
            $templateName = $request->template_name;
            $templatesPath = public_path('files/templates');
            $filesDeleted = false;

            // List of possible files to delete
            $files = [
                $templatesPath . '/' . $templateName . '.png',
                $templatesPath . '/' . $templateName . '.gif',
                $templatesPath . '/' . $templateName . '.json',
                $templatesPath . '/' . $templateName . '.txt'
            ];

            // Delete each file if it exists
            foreach ($files as $file) {
                if (file_exists($file)) {
                    unlink($file);
                    $filesDeleted = true;
                }
            }

            if ($filesDeleted) {
                return response()->json([
                    'success' => true,
                    'message' => 'Template files deleted successfully'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'No files found for the specified template'
                ], 404);
            }

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting template files: ' . $e->getMessage()
            ], 500);
        }
    }
}
