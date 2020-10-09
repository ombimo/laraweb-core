<?php

namespace Ombimo\LarawebCore\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Ombimo\LarawebCore\Helpers\Sitemap as SitemapHelper;

class SitemapIndex extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'core-sitemap:index {--p|ping}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'create sitemap index';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Create Sitemap Index Start');
        $ping = $queueName = $this->option('ping');
        $baseSitemapDir = public_path() . DIRECTORY_SEPARATOR . 'sitemap';

        if (file_exists($baseSitemapDir)) {
            $sitemap = $this->scanSitemap(
                $baseSitemapDir,
                'sitemap'
            );

            SitemapHelper::createFromArray(
                public_path() . DIRECTORY_SEPARATOR . 'sitemap.xml',
                $sitemap,
                'sitemapindex'
            );

            if ($ping) {
                file_get_contents('https://www.google.com/ping?sitemap='. config('app.url') . '/sitemap.xml');
            }
        } else {
            $this->info('folder sitemap tidak ditemukan');
        }

        $this->info('Create Sitemap Index Start');
    }

    private function scanSitemap($dir, $curDir = '')
    {
        $result = [];
        $tempResult = scandir($dir);
        foreach ($tempResult as $value) {
            if (!in_array($value,array(".",".."))) {
                $file = $dir . DIRECTORY_SEPARATOR . $value;
                $url = url($curDir.'/'.$value);
                if (is_dir($file)) {
                    $tempResult = $this->scanSitemap($file, $curDir.'/'.$value);
                    $result = array_merge($result, $tempResult);
                } else {
                    $this->info($url);
                    $result[] = [
                        "loc" => $url,
                        "lastmod" => date('Y-m-d', filemtime($file))
                    ];
                }
            }
        }
        return $result;
    }
}
