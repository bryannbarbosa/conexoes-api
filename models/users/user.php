<?php

require($_SERVER['DOCUMENT_ROOT']."/models/helpers.php");

function signup( $informations ) {

  // Fields for signup

  $fields = ['cpf', 'name', 'email', 'password', 'user_type'];

  // Variables for inserting information from the form

  $cpf = '';
  $name = '';
  $email = '';
  $password = '';
  $user_type = '';
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
      $name = $informations['name'];
      $user_type = $informations['user_type'];

      // Encrypting password for security

      $hash = hash("sha512", $password);

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
          "full_name" => $name,
          "user_type" => $user_type
          ]);

      }

      if($insert == 0) {

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
