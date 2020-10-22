<?php

namespace Ombimo\LarawebCore\Controller;

use App\Http\Controllers\Controller;
use Ombimo\LarawebCore\Models\Page;
use Illuminate\Support\Facades\View;
use Artesaos\SEOTools\Facades\SEOMeta as SEO;
use Ombimo\LarawebCore\Breadcrumb;
use Ombimo\LarawebCore\Helpers\Web;
use Ombimo\LarawebCore\Segment;

class PageController extends Controller
{
    public function index($slug)
    {
        $query = Page::where('slug', $slug);

        if (config('laraweb.multilang')) {
            $query = $query->with(['segments.locale', 'locale']);
        } else {
           $query = $query->with('segments');
        }

        $page = $query->first();
        if (is_null($page)) {
            abort(404);
        }

        if (config('laraweb.multilang')) {
            SEO::setTitle($page->locale_judul);
            SEO::setCanonical(url_page($page->slug));
            SEO::setDescription($page->locale_sinopsis);

            //breadcrumb
            Breadcrumb::add($page->judul, url_page($page->slug));

        } else {
           SEO::setTitle($page->judul);
            SEO::setCanonical(url_page($page->slug));
            SEO::setDescription($page->sinopsis);

            //breadcrumb
            Breadcrumb::add($page->judul, url_page($page->slug));
        }



        //set menu
        Web::setMenu('page.' . $page->slug);

        $segment = new Segment($page->segments);

        return View::first([
            'page.' . $slug,
            'page.index'
        ], [
            //'schemaBreadcrumb' => $schemaBreadcrumb,
            'menu' => 'page',
            'page' => $page,
            'segment' => $segment,
        ]);
    }
}
