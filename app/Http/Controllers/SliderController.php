<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use Yajra\DataTables\DataTables;
use DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Exception;

class SliderController extends Controller
{
    // Display the slider index view
    public function index()
    {
        return view('Slider.index');
    }

    // Fetch the slider data for DataTables
    public function sliderFetch(Request $request)
    {
        if ($request->ajax()) {
            $query = Slider::query();
    
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
                      ->orWhere('description', 'like', "%{$searchValue}%")
                      ->orWhere('text', 'like', "%{$searchValue}%")
                      ->orWhere('status', 'like', "%{$searchValue}%")
                      ->orWhere('url', 'like', "%{$searchValue}%")
                      ->orWhere('mobile_image', 'like', "%{$searchValue}%"); // Include 'mobile_image' in the search
                });
            });
    
            // Apply ordering
            $query->when($request->has('order'), function ($query) use ($request) {
                $orderColumnIndex = $request->order[0]['column'];
                $orderDirection = $request->order[0]['dir'];
                $columns = $request->columns;
                $orderColumnName = $columns[$orderColumnIndex]['data'];
    
                // Validate and apply ordering
                $validColumns = ['id', 'title', 'description', 'text', 'image', 'url', 'status', 'mobile_image', 'is_same_as_laptop_view'];
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
     

    // Store a new slider record
    public function store(Request $request)
    {
        // Start the transaction
        DB::beginTransaction();
       
        try {
            // Transform the request data to replace null values with empty strings
            $data = collect($request->all())->map(function ($value) {
                return $value === null ? '' : $value;
            })->toArray();
    
            // Validate the transformed data
            $validatedData = Validator::make($data, [
                // 'url' => 'nullable|min:1|starts_with:/',
                'title' => 'nullable|min:2',
                'description' => 'nullable',
                'text' => 'nullable',
                'image' => 'required|image|mimes:jpg,jpeg,png,gif,svg|max:10048',
                'addMobileViewImage' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|max:10048',
                'status' => 'required|in:active,inactive',
                'enableMobileViewImage' => 'nullable'
            ])->validate();
       
            // Handle file uploads with random number in filename
            $imagePath = null;
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $randomNumber = rand(1000, 9999);
                $newFilename = "{$filename}_{$randomNumber}.{$extension}";
                $imagePath = $file->storeAs('slider', $newFilename, 'public');
            }
    
            $mobileImagePath = null;
            if ($request->hasFile('addMobileViewImage')) {
                $file = $request->file('addMobileViewImage');
                $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $randomNumber = rand(1000, 9999);
                $newFilename = "{$filename}_{$randomNumber}.{$extension}";
                $mobileImagePath = $file->storeAs('slider', $newFilename, 'public');
            }
            $isSameAsLaptopView = !empty($validatedData['enableMobileViewImage']) ? true : false;
            
            // Save data to the database
         
            Slider::create([
                'url' => '',
                'title' => $validatedData['title'],
                'description' => $validatedData['description'],
                'text' => $validatedData['text'],
                'image' => $imagePath,
                'mobile_image' => $mobileImagePath,
                'status' => $validatedData['status'],
                'is_same_as_laptop_view' => $isSameAsLaptopView
            ]);
    
            // Commit the transaction
            DB::commit();
    
            return response()->json(['success' => true], 201);
    
        } catch (\Exception $e) {
            // Rollback the transaction
            DB::rollBack();
    
            // Log the exception message for debugging
    
            return response()->json(['error' => 'Failed to create slider.'], 500);
        }
    }
    

      


    // Update an existing slider record
    public function update(Request $request, $id)
    {
        // Start the transaction
        DB::beginTransaction();
        
        try {
            // Find the slider record by ID
            $slider = Slider::findOrFail($id);
            
            // Validate the request data
            $validatedData = $request->validate([
                // 'editUrl' => 'nullable|starts_with:/',
                'editTitle' => 'nullable|min:1',
                'editDescription' => 'nullable',
                'editText' => 'nullable',
                'editImage' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|max:10240',
                'editStatus' => 'required',
                'editMobileViewImage' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|max:10240',
                'editEnableMobileViewImage' => 'nullable'
            ]);
    
            // Update slider fields
            // $slider->url = $validatedData['editUrl'] ?? $slider->url;
            $slider->url = '';

            $slider->title = $validatedData['editTitle'] ?? $slider->title;
            $slider->description = $validatedData['editDescription'] ?? $slider->description;
            $slider->text = $validatedData['editText'] ?? $slider->text;
            $slider->status = $validatedData['editStatus'];
            // Set is_same_as_laptop_view to true if editEnableMobileViewImage is present, otherwise false
            $slider->is_same_as_laptop_view = isset($validatedData['editEnableMobileViewImage']);
            
            // Handle the image upload
            if ($request->hasFile('editImage')) {
                // Delete old image if it exists
                if ($slider->image && Storage::disk('public')->exists($slider->image)) {
                    Storage::disk('public')->delete($slider->image);
                }
    
                // Store new image and update the path
                $slider->image = $request->file('editImage')->store('slider', 'public');
            }
    
            // Handle the mobile view image upload
            if ($request->hasFile('editMobileViewImage')) {
                // If the checkbox is checked, delete old mobile view image
                if ($slider->is_same_as_laptop_view && $slider->mobile_image && Storage::disk('public')->exists($slider->mobile_image)) {
                    Storage::disk('public')->delete($slider->mobile_image);
                }
    
                // Store new mobile view image and update the path
                $slider->mobile_image = $request->file('editMobileViewImage')->store('slider', 'public');
            } elseif ($request->input('editEnableMobileViewImage') === '0') {
                // Clear mobile view image if checkbox is unchecked
                $slider->mobile_image = null;
            }
            if($slider->is_same_as_laptop_view)
            {
                $slider->mobile_image='';
            }
            // Save the updated slider record
            $slider->save();
            
            // Commit the transaction
            DB::commit();
    
            return response()->json(['message' => 'Slider updated successfully.'], 200);
    
        } catch (Exception $e) {
            // Rollback the transaction in case of error
            DB::rollBack();
            return response()->json(['error' => 'Failed to update slider.'], 500);
        }
    }
    
    
    

    // Delete a slider record
    public function destroy($id)
{
    // Start the transaction
    DB::beginTransaction();

    try {
        $slider = Slider::find($id);

        if ($slider) {
            // Delete the laptop view image if it exists
            if ($slider->image) {
                Storage::disk('public')->delete($slider->image);
            }

            // Delete the mobile view image if it exists
            if ($slider->mobile_image) {
                Storage::disk('public')->delete($slider->mobile_image);
            }

            // Delete the slider record
            $slider->delete();

            // Commit the transaction
            DB::commit();

            return response()->json(['success' => 'Record deleted successfully.'], 200);
        }

        return response()->json(['error' => 'Record not found.'], 404);

    } catch (\Exception $e) {
        // Rollback the transaction
        DB::rollBack();

        // Log the exception message for debugging
        \Log::error($e->getMessage());

        return response()->json(['error' => 'Failed to delete slider.'], 500);
    }
}
}
