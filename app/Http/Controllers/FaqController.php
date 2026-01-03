<?php

namespace App\Http\Controllers;

use App\Models\FaqCategory;

class FaqController extends Controller
{
    public function index()
    {
        $categories = FaqCategory::with('questions')->orderBy('name')->get();

        return view('faq.index', [
            'categories' => $categories,
        ]);
    }
}
