<?php

//if(!r::ajax()) go(url('error'));

header('Content-type: application/json; charset=utf-8');

$data = $site->homePage()->globalorder()->toStructure()->paginate(10);
$json = array();

foreach($data as $article) {

	$project = $article->project();

  $json[] = array(
    'url'   => (string)$project->url(),
    'title' => (string)$project->title(),
    'text'  => (string)$project->text(),
    'date'  => (string)$project->date()
  );

}

echo json_encode($json);

?>