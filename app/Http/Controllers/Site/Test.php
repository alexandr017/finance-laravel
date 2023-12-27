<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use DB;

class Test extends Controller
{
    public function index()
    {
        $cards = DB::select("select * from cards");

        echo '<table border="3">';
        echo '<tr><td>ID</td>	<td>title</td>	<td>logo</td>	<td>status</td>	<td>link_1</td>	<td>link_2</td>	<td>link_type</td>	<td>link_to_entity</td>	<td>link_to_reviews_page</td>	<td>link_to_account</td>	<td>link_to_support</td></tr>';


        foreach ($cards as $card)
        {
            echo "<tr>";
            echo "<td>$card->id</td>";
            echo "<td>$card->title</td>";
            echo "<td>$card->logo</td>";
            echo "<td>$card->status</td>";
            echo "<td>$card->link_1</td>";
            echo "<td>$card->link_2</td>";
            echo "<td>$card->link_type</td>";
            echo "<td>$card->link_to_entity</td>";
            echo "<td>$card->link_to_reviews_page</td>";
            echo "<td>$card->account_link</td>";
            echo "<td>$card->support_link</td>";
            echo "</tr>";
        }

        echo '</table>';

    }
}