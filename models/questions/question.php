<?php

function getQuestions($type) {

  global $DB;

  $record = $DB->select("questions", "*", [
    "OR" => [
    "type" => $type,
    "active" => 'true'
    ]
  ]);

  return $record;

}
