<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tender;
use App\Models\TenderBanner;

use Yajra\DataTables\DataTables;
use DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class TenderController extends Controller
{
    //
    public function index()
    {
        return view('Tender.index');
    }
    public function store(Request $request)
    {
        
        // Start the transaction
        DB::beginTransaction();

        try {
            // Validate the request
            $request->validate([
                'date' => 'required|date',
                'description' => 'required|string',
                'image' => 'required|file|mimes:pdf|max:10048', // Allow PDF files
                'status' => 'required|in:active,inactive',
            ]);
            

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                
                // Ensure the file is valid
                if ($file->isValid()) {
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $destinationPath = 'tenders/tendersFile'; // Path within the storage directory
            
                    // Store the file in the specified directory
                    $filePath = $file->storeAs($destinationPath, $filename, 'public');
            
                    // If needed, you can retrieve the public URL to access the file
                    $publicUrl = Storage::url($filePath);
                }
            }
            // Create the record in the database
            $tenders = Tender::create([
                'date' => $request->date,
                'description' => $request->description,
                'image' => $filePath,
                'status' => $request->status,
            ]);

            // Commit the transaction
            DB::commit();

            return response()->json(['success' => 'Record added successfully', 'data' => $tenders], 201);

        } catch (\Exception $e) {
            // Rollback the transaction
            DB::rollBack();

            // Log the exception

            return response()->json(['error' => 'Failed to create public notice.'], 500);
        }
    }
    public function newFetch(Request $request)
{
    if ($request->ajax()) {
        $query = Tender::query();

        // Apply status filtering
        $query->when($request->filled('status'), function ($query) use ($request) {
            $status = $request->input('status');
            $query->where('status', $status);
        });

        // Apply search filtering
        $query->when($request->filled('search.value'), function ($query) use ($request) {
            $searchValue = $request->input('search.value');
            $query->where(function ($q) use ($searchValue) {
                $q->where('date', 'like', "%{$searchValue}%")
                  ->orWhere('description', 'like', "%{$searchValue}%")
                  ->orWhere('status', 'like', "%{$searchValue}%");
            });
        });

        // Apply ordering
        $query->when($request->filled('order.0.column'), function ($query) use ($request) {
            $orderColumnIndex = $request->input('order.0.column');
            $orderDirection = $request->input('order.0.dir', 'asc');
            $columns = $request->input('columns');
            $orderColumnName = $columns[$orderColumnIndex]['data'] ?? null;

            // Validate and apply ordering
            $validColumns = ['id', 'date', 'description', 'image', 'status', 'created_at', 'updated_at'];
            if (in_array($orderColumnName, $validColumns)) {
                $query->orderBy($orderColumnName, $orderDirection);
            }
        });

        // Use DataTables to handle pagination, filtering, and sorting
        return DataTables::of($query)
            ->addIndexColumn()
            ->make(true);
    }

    return response()->json(['error' => 'Bad Request'], 400);
}

    
    public function update(Request $request, $id)
{
    // Start the transaction
    DB::beginTransaction();

    try {
        // Validate the incoming request
        $request->validate([
            'editDate' => 'required|date',
            'editDescription' => 'required|string',
            'editImage' => 'nullable|file|mimes:pdf|max:10048',
            'editStatus' => 'required|in:active,inactive',
        ]);
       
        // Find the public notice by ID
        $tenders = Tender::findOrFail($id);

        // Update the fields
        $tenders->date = $request->input('editDate');
        $tenders->description = $request->input('editDescription');
        $tenders->status = $request->input('editStatus');

        // Handle the image uploads
        if ($request->hasFile('editImage')) {
            // Delete old image if it exists
            if ($tenders->image && Storage::disk('public')->exists($tenders->image)) {
                Storage::disk('public')->delete($tenders->image);
            }

            // Store the new image
            $file = $request->file('editImage');
            $filename = time() . '_' . $file->getClientOriginalName();
            $directory = 'tenders/tendersFile';
            
            // Ensure the directory exists
            if (!Storage::disk('public')->exists($directory)) {
                Storage::disk('public')->makeDirectory($directory);
            }

            // Store the file in the correct location
            $imagePath = $file->storeAs($directory, $filename, 'public');
            $tenders->image = $imagePath;
        } else {
            // If no new image is uploaded, retain the existing image
            $tenders->image = $request->input('editImageName');
        }

        // Save the updated public notice record
        $tenders->save();

        // Commit the transaction
        DB::commit();

        return response()->json(['message' => 'Public notice updated successfully.'], 200);

    } catch (Exception $e) {
        // Rollback the transaction
        DB::rollBack();

        // Log the exception for debugging
        // Log::error($e->getMessage());

        return response()->json(['error' => 'Failed to update public notice.'], 500);
    }
}
public function destroy($id)
{
    // Start the transaction
    DB::beginTransaction();

    try {
        // Find the public notice by ID
        $tenders = Tender::find($id);

        if ($tenders) {
            // Delete the image if it exists
            if ($tenders->image && Storage::disk('public')->exists($tenders->image)) {
                Storage::disk('public')->delete($tenders->image);
            }

            // Delete the record
            $tenders->delete();

            // Commit the transaction
            DB::commit();

            return response()->json(['success' => 'Record deleted successfully.'], 200);
        }

        return response()->json(['error' => 'Record not found.'], 404);

    } catch (Exception $e) {
        // Rollback the transaction
        DB::rollBack();

        // Log the exception for debugging

        return response()->json(['error' => 'Failed to delete record.'], 500);
    }
}

public function storeBanner(Request $request)
    {
        // Start the transaction
        DB::beginTransaction();

        try {
            // Validate the request
            $request->validate([
                'title' => 'nullable|string|min:2',
                'description' => 'nullable|string',
                'firstLayer'=> 'nullable|string',
                'image' => 'required|file|mimes:jpg,jpeg,png|max:10048', // Allow specific image formats and size limit
                'status' => 'nullable|in:active,inactive',
            ]);

            $filePath = null; // Initialize file path variable
            $destinationPath = 'public_tender_banners/public_tenders'; // Path within the storage directory

            // Check and empty the directory
            $disk = Storage::disk('public'); // Ensure using the 'public' disk

            if ($disk->exists($destinationPath)) {
                $files = $disk->files($destinationPath);

                // Delete all files in the directory
                foreach ($files as $file) {
                    $disk->delete($file);
                }
            }

            if ($request->hasFile('image')) {
                $file = $request->file('image');

                // Ensure the file is valid
                if ($file->isValid()) {
                    $filename = time() . '_' . $file->getClientOriginalName();

                    // Store the file in the specified directory
                    $filePath = $file->storeAs($destinationPath, $filename, 'public');
                }
            }

            // Remove the existing record if it exists
            $tenderBanner = TenderBanner::first();

            if ($tenderBanner) {
                $tenderBanner->delete();
            }
            // This will delete all existing records

            // Create the record in the database
            $tenderBanner =TenderBanner::create([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'firstLayer' => $request->input('firstLayer'),
                'image' => $filePath,
                'status' => 'active',
            ]);

            // Commit the transaction
            DB::commit();

            return response()->json(['success' => 'Banner added successfully', 'data' => $tenderBanner], 200);

        } catch (\Exception $e) {
            // Rollback the transaction
            DB::rollBack();

            // Optionally, log the exception if needed
            // Log::error($e->getMessage());

            return response()->json(['error' => 'Failed to create public notice banner.'], 500);
        }
    }
    public function getAllBanners()
    {
        try {
            // Fetch all records from the tenderBanner model
            $banners =TenderBanner::all();

            // Return the results as a JSON response
            return response()->json(['success' => true, 'data' => $banners], 200);
        } catch (\Exception $e) {
            // Log the exception if needed
            // Log::error($e->getMessage());

            // Return an error response
            return response()->json(['success' => false, 'message' => 'Failed to retrieve banners.'], 500);
        }
    }
}