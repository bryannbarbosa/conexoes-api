<?php

require 'helpers.php';

function signup( $informations ) {

  // Fields for signup

  $fields = ['cpf', 'email', 'password', 'auth_type'];

  // Variables for inserting information from the form

  $cpf = '';
  $email = '';
  $password = '';
  $auth_type = '';
  $count = 0;

  // Verify if all required fields are present

  if( fields( $informations, $fields ) ) {

    foreach ( $informations as $information ) {

      if( $information != null ) {

        $count++;

      }

    }

    if( $count < count( $informations ) ) {

      return array(
        'response' => "None of these values can be null"
      );

    } else {

      // Inserting information of form to variables

      $cpf = $informations['cpf'];
      $email = $informations['email'];
      $password = $informations['password'];
      $auth_type = $informations['auth_type'];

      // Encrypting password for security

      $hash = hash("sha256", $password);

      $password = $hash;

      // Request a Global Variable from Database

      global $DB;

      // Verify if already has an account in Database

      $record = $DB->select("users", "*", [
        "OR" => [
        "email" => $email,
        "cpf" => $cpf
        ]
      ]);

      // If result is not empty array, then we already have an account

      if(count($record) > 0) {

        return array(
          'response' => 'This account is already registred'
        );

      } else {

        // Inserting data from form to Database

        $insert = $DB->insert("users", [
  	      "cpf" => $cpf,
  	      "email" => $email,
  	      "password" => $password,
          "auth_type" => $auth_type
          ]);

      }

      if(count($insert) == 0) {

        return array(
          'response' => 'Error in register account'
        );

      } else {

        $id = $DB->id();

        return array(
          'id of register' => $id
        );

      }

    }

  } else {

    return array(
      'response' => 'All fields are required'
    );

  }

}
