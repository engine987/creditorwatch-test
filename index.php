<?php
require_once 'vendor/autoload.php';

use App\Classes\KeywordSearch;
use App\Factories\GoogleClientFactory;
use App\Classes\Layout;
use App\Service\GoogleSearchService;


Layout::header();
Layout::form($_POST);

if (isset($_POST['keywords']) && isset($_POST['website'])) {

    /** @var App\Service\GoogleSearchService $service */
    $service = new App\Service\GoogleSearchService(GoogleClientFactory::getCustomSearch());

    $parser = new KeywordSearch($service);
    $count = $parser->parseResultsForWebsite($_POST['keywords'], $_POST['website']);

    print "<div style='text-align: center; font-weight: bold'>Website appears $count times</div>";
}

Layout::footer();

?>

