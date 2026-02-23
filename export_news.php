<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$news = App\Models\News::all();

echo "===========================================\n";
echo "METTACITY NEWS DATA EXPORT\n";
echo "Total News: " . $news->count() . "\n";
echo "===========================================\n\n";

foreach ($news as $item) {
    echo "===========================================\n";
    echo "ID: " . $item->id . "\n";
    echo "-------------------------------------------\n";
    echo "TITLE: " . $item->title . "\n";
    echo "-------------------------------------------\n";
    echo "EXCERPT:\n" . $item->excerpt . "\n";
    echo "-------------------------------------------\n";
    echo "CONTENT:\n" . $item->content . "\n";
    echo "-------------------------------------------\n";
    echo "IMAGE: " . ($item->image ?? 'None') . "\n";
    echo "FACEBOOK LINK: " . ($item->facebook_link ?? 'None') . "\n";
    echo "PUBLISHED DATE: " . $item->published_date . "\n";
    echo "ACTIVE: " . ($item->is_active ? 'Yes' : 'No') . "\n";
    echo "CREATED: " . $item->created_at . "\n";
    echo "UPDATED: " . $item->updated_at . "\n";
    echo "===========================================\n\n";
}
