<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Link;
use Yajra\DataTables\DataTables;
use DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class LinksController extends Controller
{
    //
    public function index()
    {
        return view('Quick_Links.index');
    }

    public function store(Request $request)
    {
        // Start the transaction
        DB::beginTransaction();

        try {
            $request->validate([
                'url' => 'required|min:2',
                'title' => 'required|min:2',
                'image' => 'required|image|mimes:jpg,jpeg,png|max:10048',
                'status' => 'required'
            ]);
       
            // Handle file upload
            $imagePath = null;
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $imagePath = $file->store('links', 'public');
            }

            // Save data to the database
            Link::create([
                'url' => $request->input('url'),
                'title' => $request->input('title'),
                
                'image' => $imagePath,
                'status' => $request->input('status')
            ]);

            // Commit the transaction
            DB::commit();

            return response()->json(['success' => true], 201);

        } catch (Exception $e) {
            // Rollback the transaction
            DB::rollBack();

            return response()->json(['error' => 'Failed to create slider.'], 500);
        }
    }
    public function linkFetch(Request $request)
    {
        if ($request->ajax()) {
            $query = Link::query();
    
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
                      ->orWhere('status', 'like', "%{$searchValue}%")
                      ->orWhere('url', 'like', "%{$searchValue}%"); // Include 'url' in the search
                });
            });
    
            // Apply ordering
            $query->when($request->has('order'), function ($query) use ($request) {
                $orderColumnIndex = $request->order[0]['column'];
                $orderDirection = $request->order[0]['dir'];
                $columns = $request->columns;
                $orderColumnName = $columns[$orderColumnIndex]['data'];
    
                // Validate and apply ordering
                $validColumns = ['id', 'title', 'image', 'url', 'status'];
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
                'editUrl' => 'required|min:2',
                'editTitle' => 'required|min:2',
                'editImage' => 'nullable|image|mimes:jpg,jpeg,png|max:10048',
                'editStatus' => 'required'
            ]);

            // Find the slider by ID
            $link = Link::findOrFail($id);

            // Update the fields
            $link->url = $request->input('editUrl');
            $link->title = $request->input('editTitle');
           
            $link->status = $request->input('editStatus');

            // Handle the image upload
            if ($request->hasFile('editImage')) {
                if ($link->image && Storage::disk('public')->exists($link->image)) {
                    Storage::disk('public')->delete($link->image);
                }

                $imagePath = $request->file('editImage')->store('links', 'public');
                $link->image = $imagePath;
            }

            // Save the updated slider record
            $link->save();

            // Commit the transaction
            DB::commit();

            return response()->json(['message' => 'Slider updated successfully.'], 200);

        } catch (Exception $e) {
            // Rollback the transaction
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
            $link = Link::find($id);

            if ($link) {
                if ($link->image) {
                    Storage::disk('public')->delete($link->image);
                }

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


}
