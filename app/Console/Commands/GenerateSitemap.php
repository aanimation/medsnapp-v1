<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

use Stephenjude\FilamentBlog\Models\Category as PostCategoryModel;
use Stephenjude\FilamentBlog\Models\Post as PostModel;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatically Generate an XML Sitemap';
    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $sitemap = Sitemap::create();

        PostCategoryModel::all()->each(function ($cat) use ($sitemap) {
            $sitemap->add(
                Url::create("{$cat->slug}")
                    ->setPriority(0.1)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_NEVER)
            );
        });

        PostModel::whereNotNull('published_at')->get()->each(function ($post) use ($sitemap) {
            $sitemap->add(
                Url::create("/post/detail/{$post->category->slug}/{$post->slug}")
                    ->setPriority(0.9)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
            );
        });

        $sitemap->writeToFile(public_path('sitemap.xml'));
    }
}