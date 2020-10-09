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
        $query = Page::where('slug', $slug)->with('segments.locale');
        if (config('laraweb.multilang')) {
            $query = $query->with('locale');
        }

        $page = $query->first();
        if (is_null($page)) {
            abort(404);
        }

        SEO::setTitle($page->locale_judul);
        SEO::setCanonical(url_page($page->slug));
        SEO::setDescription($page->locale_sinopsis);

        //breadcrumb
        Breadcrumb::add($page->locale_judul, url_page($page->slug));
        //$page->addView();

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
