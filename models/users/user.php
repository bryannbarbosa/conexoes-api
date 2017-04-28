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

      if( $information != null ) {

        $count++;

      }

    }

    if( $count < count( $informations ) ) {

      return array(
        'response' => 'Any value can be null'
      );

    } else {

      $hash = hash("sha256", $informations['password']);

      $informations['password'] = $hash;

      global $DB;

      $DB->insert("users", [
	       "cpf" => $informations['cpf'],
	       "email" => $informations['email'],
	       "password" => $informations['password']
      ]);

      $id = $DB->id();

      return array(
        "id" => $id,
        "cpf" => $informations['cpf'],
        "email" => $informations['email'],
        "password" => $informations['password'],
        "auth_type" => $informations['auth_type'],
        'response' => 'Account registered with sucess'
      );

    }

  } else {

    return array(
      'response' => 'All fields are required'
    );

  }
}
