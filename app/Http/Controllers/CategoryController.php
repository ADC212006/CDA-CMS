<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use DB;
class CategoryController extends Controller
{
    public function index(){
        $category = new Category();
        return view('Category.index',compact('category'));
    }

    public function categoryFetch(Request $request)
    {
        if ($request->ajax()) {
            $query = Category::query(); // Start a query for the Category model
    
            // Apply filtering
            $query->when($request->has('search') && !empty($request->search['value']), function ($query) use ($request) {
                $searchValue = $request->search['value'];
                $query->where(function ($q) use ($searchValue) {
                    $q->where('category_name', 'like', "%{$searchValue}%")
                      ->orWhere('description', 'like', "%{$searchValue}%");
                });
            });
    
            // Apply ordering
            $query->when($request->has('order'), function ($query) use ($request) {
                $orderColumnIndex = $request->order[0]['column'];
                $orderDirection = $request->order[0]['dir'];
                $columns = $request->columns;
                $orderColumnName = $columns[$orderColumnIndex]['data'];
    
                // Validate and apply ordering
                $validColumns = ['id', 'category_name', 'description', 'file']; // Valid columns for ordering
                if (in_array($orderColumnName, $validColumns)) {
                    $query->orderBy($orderColumnName, $orderDirection);
                }
            });
    
            // Use DataTables to handle pagination, filtering, and sorting
            return DataTables::of($query)
                ->addIndexColumn()
                ->make(true); // Return JSON response for DataTables
        }
    }


    public function addCategory(Request $request)
    {
        // Validate the request
        $request->validate([
            'addCategoryName' => 'required|string|min:2',
            'addDescription' => 'required|string',
            'addFile' => 'required|file|mimes:jpeg,png,jpg|max:10048',
        ]);

        // Start a database transaction
        DB::beginTransaction();

        try {
            $category = new Category();
            
            // Handle file upload
            if ($request->hasFile('addFile')) {
                $file = $request->file('addFile');
                $fileName = time() . '.' . $file->getClientOriginalExtension();
                $filePath = $file->move(public_path($category->imagePath()), $fileName);
                $fileUrl = $category->imagePath() . $fileName;

                // Save record to database
                Category::create([
                    'category_name' => $request->input('addCategoryName'),
                    'description' => $request->input('addDescription'),
                    'file' => $fileName, // Save the file name in the database
                ]);
            } else {
                // Save record to database without file
                Category::create([
                    'category_name' => $request->input('addCategoryName'),
                    'description' => $request->input('addDescription'),
                ]);
            }

            // Commit the transaction
            DB::commit();

            return response()->json(['message' => 'Record added successfully!']);
        } catch (\Exception $e) {
            // Rollback the transaction if something goes wrong
            DB::rollBack();

            return response()->json(['error' => 'Failed to save record.'], 500);
        }
    }


    
    public function editCategory (Request $request)
    {
        
        // Validate the request
        $request->validate([
            'editCategoryName' => 'required|string|min:2',
            'editDescription' => 'required|string',
            'editFile' => 'nullable|file|mimes:jpeg,png,jpg|max:10048', // Make file optional
        ]);

        // Start a database transaction
        DB::beginTransaction();

        try {
            // Find the category to update
            $category = Category::findOrFail($request->editId);
        
            // Prepare data for update
            $data = [
                'category_name' => $request->input('editCategoryName'),
                'description' => $request->input('editDescription'),
            ];

            // Handle file upload
            if ($request->hasFile('editFile')) {
                $file = $request->file('editFile');
                $fileName = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path($category->imagePath()), $fileName);
                $data['file'] = $fileName;
                
                // Optionally, delete the old file if it exists
                if ($category->file) {
                    $oldFilePath = public_path($category->imagePath() . $category->file);
                    if (file_exists($oldFilePath)) {
                        unlink($oldFilePath);
                    }
                }
            }

            // Update the category
            $category->update($data);

            // Commit the transaction
            DB::commit();

            return response()->json(['message' => 'Category updated successfully!']);
        } catch (\Exception $e) {
            // Rollback the transaction if something goes wrong
            DB::rollBack();

            // Log the error for debugging
            \Log::error($e->getMessage());

            return response()->json(['error' => 'Failed to update category.'], 500);
        }
    }
    
}