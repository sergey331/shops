<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\service\CategoryService;
use App\service\FileService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoryController extends Controller
{

    public function __construct(
        private readonly CategoryService $categoryService,
        private readonly FileService $fileService
    ){}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = $this->categoryService->getCategories();
        $currentPage = request()->get('page', 1);
        return Inertia::render('Admin/Categories/Index', compact('categories','currentPage'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = $this->categoryService->getParentCategories();
        return Inertia::render('Admin/Categories/Create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $validated = $request->validated();
        if ($request->hasFile('image')) {
            $validated['image'] = $this->fileService->upload($request->file('image'), 'categories');
        }
        $this->categoryService->store($validated);
        return response()->json(['success' => true, 'message' => 'Category created successfully.']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $categories = Category::query()->whereNot('id',$category->id)->whereNull('parent_id')->get();
        return Inertia::render('Admin/Categories/Edit', compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $validated = $request->validated();
        if ($request->hasFile('image')) {
            $this->fileService->delete($category->image, 'categories');
            $validated['image'] = $this->fileService->upload($request->file('image'), 'categories');
        }

        $this->categoryService->update($category,$validated);
        return response()->json(['success' => true, 'message' => 'Category updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        $categories = $this->categoryService->getCategories();
        return response()->json(true);
    }
}
