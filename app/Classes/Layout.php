<?php
/**
 *  * Created by PhpStorm.
 * User: Krishna Rao
 * Date: 2020-09-08
 * Time: 14:09
 */

namespace App\Classes;


class Layout
{
    public static function header()
    {
        print "<!DOCTYPE HTML> <html> <body>";
    }

    public static function form()
    {
        print "<h2 style='text-align: center'>Search Keywords Count</h2>";
        print "<div style='width: 60%;margin: auto; border: 1px solid #ccc; padding: 5px'>";
        print "\n";

        $keywords = $_POST['keywords'] ?? '';
        $website = $_POST['website'] ?? '';

        print <<<EOT
<form action="{$_SERVER['PHP_SELF']}" method="post">
Key Words: <input type="text" name="keywords" value="{$keywords}"><br>
Website: <input type="text" name="website" value="{$website}"><br>
<input type="submit">
</form>
EOT;

        print "\n";
        print "</div>";

        print '<br/>';
        print "<hr style='width: 80%'/>";
    }

    public static function footer()
    {
        print "</body> </html>";
    }
}