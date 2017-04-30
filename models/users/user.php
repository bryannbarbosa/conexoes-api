<?php

function signup_student( $informations ) {

  // Fields for signup

  $fields = ['document', 'name',
  'password', 'email'];

  // Variables for inserting information from the form

  $document = '';
  $name = '';
  $password = '';
  $email = '';
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
        'response' => 'None of these values can be null'
      );

    } else {

      // Inserting information of form to variables

      $document = $informations['document'];
      $password = $informations['password'];
      $name = $informations['name'];
      $email = $informations['email'];

      // Encrypting password for security

      $hash = hash("sha512", $password);

      $password = $hash;

      // Request a Global Variable from Database

      global $DB;

      // Verify if already has an account in Database

      $record = $DB->select("students", "*", [
        "OR" => [
        "email" => $email,
        "document" => $document,
        ]
      ]);

      // If result is not empty array, then we already have an account

      if(count($record) > 0) {

        return array(
          'response' => 'This account is already registred'
        );

      } else {

        // Inserting data from form to Database

        $insert = $DB->insert("students", [
  	      "document" => $document,
  	      "email" => $email,
  	      "password" => $password,
          "name" => $name
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
