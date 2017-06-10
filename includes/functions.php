<!--Validator Functions-->


<?php

    // Validator function

    // clean the form data
    
/*  
    built in functions used
    trip();
    stripslashes();
    htmlspecialchars();
    strip_tags();
    str_replace();
*/

function validateFormData($formData) {

    $strippedFormData = strip_tags( str_replace( array( '(', ')' ), '', $formData ) );
    $formData = trim( stripslashes( htmlspecialchars( $strippedFormData, ENT_QUOTES ) ) );

    return $formData;
}

?>