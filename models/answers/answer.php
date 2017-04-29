<?php

require($_SERVER['DOCUMENT_ROOT']."/models/helpers.php");

function giveAnswer($informations) {

  $fields = ['answer_1, answer_2, answer_3'];

  $answer_1 = '';
  $answer_2 = '';
  $answer_3 = '';
  $count = 0;

  if( fields ( $informations, $fields ) ) {

    foreach( $informations as $information ) {

      if( $information != null ) {

        $count++;

      }

    }

    if( $count < count( $informations ) ) {

      return array(
        'response' => 'None of these values can be null'
      );

    } else {

      $answer_1 = $informations['answer_1'];
      $answer_2 = $informations['answer_2'];
      $answer_3 = $informations['answer_3'];

      global $DB;

      

    }

  }

}
