<?php
require_once 'vendor/autoload.php';

use App\Classes\KeywordSearch;
use App\Factories\GoogleClientFactory;
use App\Classes\Layout;
use App\Service\GoogleSearchService;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

$loader = new FilesystemLoader(__DIR__ . '/templates');
$twig = new Environment($loader);

echo $twig->render('header.html.twig');
echo $twig->render('form.html.twig', 
	['keywords' => $_POST['keywords'] ?? '', 'website' => $_POST['website'] ?? '' ]
);

if (isset($_POST['keywords']) && isset($_POST['website'])) {

    /** @var App\Service\GoogleSearchService $service */
    $service = new App\Service\GoogleSearchService(GoogleClientFactory::getCustomSearch());

    $parser = new KeywordSearch($service);
    $position = $parser->parseResultsForWebsite($_POST['keywords'], $_POST['website']);

    $positionString = '0';
    if (count($position)) {
        $positionString = join(', ', $position);
    }

	echo $twig->render('result.html.twig', ['position' => $positionString] );
}

echo $twig->render('footer.html.twig');
?>

