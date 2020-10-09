<?php

namespace Ombimo\LarawebCore\Helpers;

class Sitemap
{
    public static function createFromArray($filename, $sitemapArray, $type = 'urlset')
    {
        $process = true;
        if ($type === 'urlset') {
            $config = [
                'baseElement' => "urlset",
                'element' => "url"
            ];
        } elseif ($type === 'sitemapindex') {
            $config = [
                'baseElement' => "sitemapindex",
                'element' => "sitemap"
            ];
        } else {
            $process = false;
        }
        if ($process) {
            $doc = new \DOMDocument("1.0","UTF-8");
            $doc->formatOutput = true;
            $r = $doc->createElement($config['baseElement']);
            $doc->appendChild( $r );

            $domAttribute = $doc->createAttribute('xmlns');
            $domAttribute->value = 'http://www.sitemaps.org/schemas/sitemap/0.9';
            $r->appendChild($domAttribute);

            if ($type === 'urlset') {
                $domAttribute = $doc->createAttribute('xmlns:xsi');
                $domAttribute->value = 'http://www.w3.org/2001/XMLSchema-instance';
                $r->appendChild($domAttribute);

                $domAttribute = $doc->createAttribute('xsi:schemaLocation');
                $domAttribute->value = 'http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd';
                $r->appendChild($domAttribute);
            }

            foreach ($sitemapArray as $value) {
                $b = $doc->createElement( $config['element'] );
                foreach ($value as $elementName => $elementValue) {
                    $element = $doc->createElement( $elementName );
                    $element->appendChild( $doc->createTextNode( $elementValue ) );
                    $b->appendChild( $element );
                }
                $r->appendChild( $b );
            }

            $doc->saveXML();
            $doc->save($filename);
        }
    } //END createFromArray()

}
