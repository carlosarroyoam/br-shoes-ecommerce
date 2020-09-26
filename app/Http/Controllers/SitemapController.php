<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class SitemapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sitemap = App::make("sitemap");
        // $sitemap->setCache('br-shoes.sitemap-index', 3600);

        $sitemap->addSitemap(URL::to('/sitemap.xml/pages'));
        $sitemap->addSitemap(URL::to('/sitemap.xml/product'));
        $sitemap->addSitemap(URL::to('/sitemap.xml/category'));
        $sitemap->addSitemap(URL::to('/sitemap.xml/collection'));

        return $sitemap->render('sitemapindex');
    }

    /**
     * Display the static pages sitemap xml.
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function pages()
    {
        $pagesSitemap = App::make("sitemap");
        $pagesSitemap->setCache('br-shoes.sitemap-pages', 1);

        $pagesSitemap->add(URL::to(route('home')), '2020-09-24T14:30:00+02:00', '0.7', 'weekly');
        $pagesSitemap->add(URL::to(route('products.index')), '2020-09-24T14:30:00+02:00', '1.0', 'weekly');
        $pagesSitemap->add(URL::to(route('sizes-guide')), '2020-09-24T14:30:00+02:00', '0.7', 'yearly');
        $pagesSitemap->add(URL::to(route('how-to-buy')), '2020-09-24T14:30:00+02:00', '0.7', 'yearly');
        $pagesSitemap->add(URL::to(route('faq')), '2020-09-24T14:30:00+02:00', '0.7', 'yearly');
        $pagesSitemap->add(URL::to(route('login')), '2020-09-24T14:30:00+02:00', '0.7', 'yearly');
        $pagesSitemap->add(URL::to(route('register')), '2020-09-24T14:30:00+02:00', '0.7', 'yearly');

        return $pagesSitemap->render('xml');
    }

    /**
     * Display the products sitemap xml.
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function products()
    {
        $productsSitemap = App::make("sitemap");
        $productsSitemap->setCache('br-shoes.sitemap-products', 3600);

        $products = DB::table('products')->orderBy('created_at', 'desc')->get();
        foreach ($products as $product) {
            $productsSitemap->add($product->slug, $product->updated_at);
        }

        return $productsSitemap->render('xml');
    }

    /**
     * Display the categories sitemap xml.
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function categories()
    {
        $categoriesSitemap = App::make("sitemap");
        $categoriesSitemap->setCache('br-shoes.sitemap-categories', 3600);

        $categories = DB::table('categories')->orderBy('created_at', 'desc')->get();
        foreach ($categories as $category) {
            $categoriesSitemap->add($category->slug, $category->updated_at);
        }

        return $categoriesSitemap->render('xml');
    }


    /**
     * Display the collections sitemap xml.
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function collections()
    {
        $collectionsSitemap = App::make("sitemap");
        $collectionsSitemap->setCache('br-shoes.sitemap-collections', 3600);

        $collections = DB::table('collections')->orderBy('created_at', 'desc')->get();
        foreach ($collections as $collection) {
            $collectionsSitemap->add($collection->slug, $collection->updated_at);
        }

        return $collectionsSitemap->render('xml');
    }
}
