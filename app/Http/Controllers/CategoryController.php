<?php
namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('priority')->get();
        return view('category.index', compact('categories'));
    }

    public function create()
    {
        // Get the next available priority
        $nextPriority = Category::max('priority') + 1 ?? 1; // Default to 1 if no categories exist
        return view('category.create', compact('nextPriority'));
    }

    public function store(Request $request)
    {
        // Validate input data with custom messages
        $data = $request->validate([
            'priority' => 'required|integer|unique:categories,priority',
            'name' => 'required|string|max:255|unique:categories,name',
        ], [
            'priority.unique' => 'This priority number is already assigned. Please choose another.',
            'name.unique' => 'The category name has already been taken. Please choose another name.',
        ]);

        // Create a new category
        Category::create($data);
        return redirect()->route('category.index')->with('success', 'Category Created Successfully');
    }

    public function edit(Category $category)
    {
        return view('category.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        // Validate input data with custom messages
        $data = $request->validate([
            'priority' => 'required|integer|min:1|unique:categories,priority,' . $category->id,
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
        ], [
            'priority.unique' => 'This priority number is already assigned. Please choose another.',
            'name.unique' => 'The category name has already been taken. Please choose another name.',
        ]);

        // Update category
        $category->update($data);
        return redirect()->route('category.index')->with('success', 'Category Updated Successfully');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('category.index')->with('success', 'Category Deleted Successfully.');
    }
}
