<?php

namespace App\Http\Controllers;

use App\Models\FaqCategory;
use App\Models\FaqQuestion;
use Illuminate\Http\Request;

class AdminFaqQuestionController extends Controller
{
    public function index()
    {
        $questions = FaqQuestion::with('category')->orderByDesc('id')->get();

        return view('admin.faq.questions.index', [
            'questions' => $questions,
        ]);
    }

    public function create()
    {
        $categories = FaqCategory::orderBy('name')->get();

        return view('admin.faq.questions.create', [
            'categories' => $categories,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'faq_category_id' => ['required', 'exists:faq_categories,id'],
            'question' => ['required', 'string', 'max:255'],
            'answer' => ['required', 'string'],
        ]);

        FaqQuestion::create($validated);

        return redirect()->route('admin.faq-questions.index')->with('success', 'question created');
    }

    public function edit(FaqQuestion $faq_question)
    {
        $categories = FaqCategory::orderBy('name')->get();

        return view('admin.faq.questions.edit', [
            'question' => $faq_question,
            'categories' => $categories,
        ]);
    }

    public function update(Request $request, FaqQuestion $faq_question)
    {
        $validated = $request->validate([
            'faq_category_id' => ['required', 'exists:faq_categories,id'],
            'question' => ['required', 'string', 'max:255'],
            'answer' => ['required', 'string'],
        ]);

        $faq_question->update($validated);

        return redirect()->route('admin.faq-questions.index')->with('success', 'question updated');
    }

    public function destroy(FaqQuestion $faq_question)
    {
        $faq_question->delete();

        return back()->with('success', 'question deleted');
    }
}
