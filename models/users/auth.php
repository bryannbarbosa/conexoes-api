<?php

function fields( array $array, $keys ) {

  $count = 0;

  if ( ! is_array( $keys ) ) {
        $keys = func_get_args();
        array_shift( $keys );
  }

  foreach ( $keys as $key ) {
        if ( array_key_exists( $key, $array ) ) {
            $count++;
      }
  }

  return count( $keys ) === $count;

}

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
