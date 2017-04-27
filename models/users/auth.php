<?php

require 'helpers.php';

function signup( $informations ) {

  $fields = ['cpf', 'email', 'password', 'auth_type'];

  $cpf = '';
  $email = '';
  $password = '';
  $count = 0;

  if( fields( $informations, $fields ) ) {

    foreach ( $informations as $information ) {

      if($information != null) {
        $count++;
      }

    }

    if( $count < count( $informations ) ) {

      return array(
        'response' => 'Any value can be null'
      );

    } else {

      return array(
        'response' => 'Ok!'
      );

    }

  } else {

    return array(
      'response' => 'All fields are required'
    );

  }
}
