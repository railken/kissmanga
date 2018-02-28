<?php

namespace Railken\Kissmanga\API\Scan;

use \Wa72\HtmlPageDom\HtmlPageCrawler;
use Illuminate\Support\Collection;
use Railken\Bag;
use Railken\Kissmanga\Kissmanga;

class Parser
{
    
    /*
     * @var Kissmanga
     */
    protected $manager;

    /**
     * Constructor
     *
     * @param Kissmanga $manager
     */
    public function __construct(Kissmanga $manager)
    {
        $this->manager = $manager;
    }

    /**
     * Parse the response
     *
     * @return string $html
     *
     * @return KissmangaSearchResponse
     */
    public function parse($html)
    {
        $node = HtmlPageCrawler::create($html);


        $chko = strpos($html, "chko") 
            ? "72nnasdasd9asdn123nasdbasd612basd"
            : "mshsdf832nsdbash20asdm";


        $key = pack("H*", hash("sha256", $chko));
        $iv =  pack("H*", "a5e8e2e9c2721be0a84ad660c472c1f3");

        preg_match_all('/\(wrapKA\("([^\"]*)"\)/', $html, $results);

        return (new Collection($results[1]))->map(function ($result) use ($key, $iv) { 
            $bag = new Bag(); 


            $bag->set('scan', mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, base64_decode($result), MCRYPT_MODE_CBC, $iv)); 
            return $bag; 
        }); 
 

    }
}
