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

  if( fields( $informations, $fields ) ) {

    if( !array_filter ( $informations ) ) {
      return array(
        'response' => 'All values cannot be empty'
      );
    } else {
      return array(
        'response' => 'All values are ok!'
      );
    }

  } else {
    return array(
      'response' => 'All fields are required'
    );
  }
}
