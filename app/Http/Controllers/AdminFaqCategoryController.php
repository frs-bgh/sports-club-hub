<?php

namespace App\Http\Controllers;

use App\Models\FaqCategory;
use Illuminate\Http\Request;

class AdminFaqCategoryController extends Controller
{
    public function index()
    {
        $categories = FaqCategory::orderBy('name')->get();

        return view('admin.faq.categories.index', [
            'categories' => $categories,
        ]);
    }

    public function create()
    {
        return view('admin.faq.categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100', 'unique:faq_categories,name'],
        ]);

        FaqCategory::create($validated);

        return redirect()->route('admin.faq-categories.index')->with('success', 'category created');
    }

    public function edit(FaqCategory $faq_category)
    {
        return view('admin.faq.categories.edit', [
            'category' => $faq_category,
        ]);
    }

    public function update(Request $request, FaqCategory $faq_category)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100', 'unique:faq_categories,name,' . $faq_category->id],
        ]);

        $faq_category->update($validated);

        return redirect()->route('admin.faq-categories.index')->with('success', 'category updated');
    }

    public function destroy(FaqCategory $faq_category)
    {
        $faq_category->delete();

        return back()->with('success', 'category deleted');
    }
}
