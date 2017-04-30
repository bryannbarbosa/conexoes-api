<?php

require($_SERVER['DOCUMENT_ROOT']."/models/helpers.php");

function giveAnswer($informations, $id) {

  // $fields = ['answer_1, answer_2, answer_3'];
  //
  // $answer_1 = '';
  // $answer_2 = '';
  // $answer_3 = '';
  // $type = '';
  // $count = 0;
  //
  // if( fields ( $informations, $fields ) ) {
  //
  //   foreach( $informations as $information ) {
  //
  //     if( $information != null ) {
  //
  //       $count++;
  //
  //     }
  //
  //   }
  //
  //   if( $count < count( $informations ) ) {
  //
  //     return array(
  //       'response' => 'None of these values can be null'
  //     );
  //
  //   } else {
  //
  //     $answer_1 = $informations['answer_1'];
  //     $answer_2 = $informations['answer_2'];
  //     $answer_3 = $informations['answer_3'];
  //
  //     global $DB;
  //
  //     $insert = $DB->insert("answers_students", [
  // 	    "id_student" => $document,
  // 	    "id_question" => $id_question,
  // 	    "type" => $type
  //         ]);
  //
  //     if($insert == 0) {
  //
  //       return array(
  //         'response' => 'Error in register account'
  //       );
  //
  //     } else {
  //
  //       $id = $DB->id();
  //
  //       return array(
  //         'id of register' => $id
  //       );
  //
  //     }
  //
  //   }
  //
  // }

}
