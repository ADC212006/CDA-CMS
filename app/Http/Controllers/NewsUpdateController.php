<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewsUpdate;
use App\Models\NewsAndUpdateBanner;
use Yajra\DataTables\DataTables;
use DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
class NewsUpdateController extends Controller
{
    //
    public function index()
    {
        return view('NewsAndUpdate.index');
    }
    public function store(Request $request)
{
    // Start the transaction
    DB::beginTransaction();
    
    try {
     
        // Validate the request
        $request->validate([
            'date' => 'required',

            'title' => 'required|string|min:2',
            'slug' => 'required|string',
            'description' => 'required|string',
            // 'addMainHeading' => 'required|string',
            'text' => 'required|string',
            'status' => 'required|string',
            // 'addMainHeadingImage' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|max:10048',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|max:10048',
        ]);
        // dd($request->all());
        // Handle file uploads
        // $addMainHeadingImagePath = null;
        // if ($request->hasFile('addMainHeadingImage')) {
        //     $file = $request->file('addMainHeadingImage');
        //     $addMainHeadingImagePath = $file->store('MainHeadingImage', 'public');
        // }

        $imagePath = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imagePath = $file->store('NewsImage', 'public');
        }

        // Save data to the database
        $newsUpdate = NewsUpdate::create([
            'title' => $request->input('title'),
            'slug' => $request->input('slug'),
            'description' => $request->input('description'),
            // 'add_main_heading' => $request->input('addMainHeading'),
            'text' => $request->input('text'),
            'status' => $request->input('status'),
            // 'add_main_heading_image' => $addMainHeadingImagePath,
            'date' => $request->input('date'),
            'image' => $imagePath,
        ]);

        // Commit the transaction
        DB::commit();

        return response()->json(['success' => true, 'data' => $newsUpdate], 201);

    } catch (\Exception $e) {
        // Rollback the transaction
        DB::rollBack();

        // Log the exception for debugging
        \Log::error('Failed to create news update: ' . $e->getMessage());

        return response()->json(['error' => 'Failed to create news update.'], 500);
    }
}

public function newFetch(Request $request)
{
    if ($request->ajax()) {
        $query = NewsUpdate::query();

        // Apply status filtering
        $query->when($request->has('status') && !empty($request->status), function ($query) use ($request) {
            $status = $request->status;
            $query->where('status', $status);
        });

        // Apply search filtering
        $query->when($request->has('search') && !empty($request->search['value']), function ($query) use ($request) {
            $searchValue = $request->search['value'];
            $query->where(function ($q) use ($searchValue) {
                $q->where('title', 'like', "%{$searchValue}%")
                  ->orWhere('slug', 'like', "%{$searchValue}%")
                  ->orWhere('status', 'like', "%{$searchValue}%")
                  ->orWhere('description', 'like', "%{$searchValue}%")
                  ->orWhere('add_main_heading', 'like', "%{$searchValue}%")
                  ->orWhere('text', 'like', "%{$searchValue}%")
                  ->orWhere('date', 'like', "%{$searchValue}%");
            });
        });

        // Apply ordering
        $query->when($request->has('order'), function ($query) use ($request) {
            $orderColumnIndex = $request->order[0]['column'];
            $orderDirection = $request->order[0]['dir'];
            $columns = $request->columns;
            $orderColumnName = $columns[$orderColumnIndex]['data'];

            // Validate and apply ordering
            $validColumns = ['id', 'title', 'slug', 'description', 'add_main_heading', 'text', 'status', 'date'];
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
            'title' => 'required|min:2',
            'slug' => 'required|min:2',
            'description' => 'required',
            // 'editMainHeading' => 'required|min:2',
            'text' => 'required|min:2',
            'date' => 'required',
            // 'editMainHeadingImage' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|max:10048',
            'editImage' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|max:10048',
            'status' => 'required'
        ]);

        // Find the news update by ID
        $newsUpdate = NewsUpdate::findOrFail($id);

        // Update the fields
        $newsUpdate->title = $request->input('title');
        $newsUpdate->slug = $request->input('slug');
        $newsUpdate->description = $request->input('description');
        // $newsUpdate->add_main_heading = $request->input('editMainHeading');
        $newsUpdate->text = $request->input('text');
        $newsUpdate->status = $request->input('status');
        $newsUpdate->date = $request->input('date');

        // Handle the image uploads for Main Heading Image
        // if ($request->hasFile('editMainHeadingImage')) {
        //     if ($newsUpdate->add_main_heading_image && Storage::disk('public')->exists($newsUpdate->add_main_heading_image)) {
        //         Storage::disk('public')->delete($newsUpdate->add_main_heading_image);
        //     }
        //     $mainHeadingImagePath = $request->file('editMainHeadingImage')->store('MainHeadingImage', 'public');
        //     $newsUpdate->add_main_heading_image = $mainHeadingImagePath;
        // }

        // Handle the image uploads for other image
        if ($request->hasFile('image')) {
            if ($newsUpdate->image && Storage::disk('public')->exists($newsUpdate->image)) {
                Storage::disk('public')->delete($newsUpdate->image);
            }
            $imagePath = $request->file('image')->store('NewsImage', 'public');
            $newsUpdate->image = $imagePath;
        }

        // Save the updated news update record
        $newsUpdate->save();

        // Commit the transaction
        DB::commit();

        return response()->json(['message' => 'News update successfully.'], 200);

    } catch (Exception $e) {
        // Rollback the transaction
        DB::rollBack();

        return response()->json(['error' => 'Failed to update news update.'], 500);
    }
}

    public function destroy($id)
    {
        // Start the transaction
        DB::beginTransaction();

        try {
            $link = NewsUpdate::find($id);

            if ($link) {
                if ($link->image) {
                    Storage::disk('public')->delete($link->image);
                 
                }
                // if ($link->add_main_heading_image) {
                //     Storage::disk('public')->delete($link->add_main_heading_image);
                // }
                $link->delete();

                // Commit the transaction
                DB::commit();

                return response()->json(['success' => 'Record deleted successfully.'], 200);
            }

            return response()->json(['error' => 'Record not found.'], 404);

        } catch (Exception $e) {
            // Rollback the transaction
            DB::rollBack();

            return response()->json(['error' => 'Failed to delete slider.'], 500);
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
            'image' => 'required|file|mimes:jpg,jpeg,png|max:10048', // Allow specific image formats and size limit
            'status' => 'nullable|in:active,inactive',
        ]);

        $filePath = null; // Initialize file path variable
        $destinationPath = 'public_news_and_update_banners/news_and_update_banners'; // Path within the storage directory

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
        $newAndUpdateBanner = NewsAndUpdateBanner::first();

        if ($newAndUpdateBanner) {
            $newAndUpdateBanner->delete();
        }
        
        // Create the record in the database
        $newAndUpdateBanner = NewsAndUpdateBanner::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'image' => $filePath,
            'status' => 'active',
        ]);

        // Commit the transaction
        DB::commit();

        return response()->json(['success' => 'Banner added successfully', 'data' => $newAndUpdateBanner], 200);

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
        // Fetch all records from the newAndUpdateBanner model
        $banners = NewsAndUpdateBanner::all();

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
