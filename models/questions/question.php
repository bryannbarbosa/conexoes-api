<?php

function getQuestions($type) {

  global $DB;

  $record = $DB->select("questions", "*", [
    "AND" => [
		"OR" => [
			"type" => $type
		],
		"active" => "true"
	]
  ]);

  return $record;

}
