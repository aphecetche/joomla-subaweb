<?php
defined('_JEXEC') or die('Restricted access');

function getObjectToDisplay2($data) {
    return (object)array(
        'title'=>$data->title2,
        'author' => $data->author2,
        'author_url' => $data->author_url2,
        'author_filiation' => $data->author_filiation2,
        'author_filiation_url' => $data->author_filiation_url2,
        'summary' => $data->summary2,
        'showdate' => false);
}

function getObjectToDisplay($data) {
    return  (object) array('title' => $data->title,
        'author' => $data->author,
        'author_url' => $data->author_url,
        'author_filiation' => $data->author_filiation,
        'author_filiation_url' => $data->author_filiation_url,
        'date' => $data->date,
        'summary' => $data->summary,
        'showdate' => false,
        'showlocation' => false
    );
}

echo JLayoutHelper::render('seminar-date-and-location',(object)array( 'date'=> $displayData->date, 'location' => $displayData->location));

$oneSeminarLayout = new JLayoutFile('one-seminar',null,array('debug'=>false));

echo "<section class=\"seminar-main\">";
echo $oneSeminarLayout->render(getObjectToDisplay2($displayData));
echo "</section>";

if ($displayData->secondPart) {

    if ($displayData->smallerSecondPart) {
        echo "<p class=\"seminar-separator\">$displayData->separator</p>";
        echo "<section class=\"seminar-prelude\">";
    }
    else {
        echo "<section class=\"seminar-main\">";

    }
    echo $oneSeminarLayout->render(getObjectToDisplay($displayData));
    echo "</section>";
}
?>
