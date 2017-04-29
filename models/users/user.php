<?php

function signup( $informations ) {

  // Fields for signup

  $fields = ['document', 'document_type', 'name',
  'password', 'email', 'user_type'];

  // Variables for inserting information from the form

  $document = '';
  $document_type = '';
  $name = '';
  $password = '';
  $email = '';
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
        'response' => 'None of these values can be null'
      );

    } else {

      // Inserting information of form to variables

      $document = $informations['document'];
      $document_type = $informations['document_type'];
      $password = $informations['password'];
      $name = $informations['name'];
      $email = $informations['email'];
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
        "document" => $document,
        "document_type" => $document_type
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
  	      "document" => $document,
          "document_type" => $document_type,
  	      "email" => $email,
  	      "password" => $password,
          "name" => $name,
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
