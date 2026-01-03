<?php

namespace Database\Seeders;

use App\Models\FaqCategory;
use App\Models\FaqQuestion;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $general = FaqCategory::updateOrCreate(['name' => 'general']);
        $account = FaqCategory::updateOrCreate(['name' => 'accounts']);

        FaqQuestion::updateOrCreate(
            ['faq_category_id' => $general->id, 'question' => 'what is sports club hub?'],
            ['answer' => 'it is a small laravel app with accounts, profiles, news, faq and contact.']
        );

        FaqQuestion::updateOrCreate(
            ['faq_category_id' => $account->id, 'question' => 'how do i change my profile photo?'],
            ['answer' => 'login, go to edit profile, choose a file and save changes.']
        );
    }
}
