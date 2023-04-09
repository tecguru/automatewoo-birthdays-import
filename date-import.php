<?php

// Load WordPress.
echo"Loading WP \n";
require_once 'wp-load.php';

echo"Loading AUTOMATEWOO \n";
// Load the AutomateWoo Birthdays Add-on class.
require_once './wp-content/plugins/automatewoo-birthdays/includes/birthdays-addon.php';

echo"Define Dates File \n";
// Define the path to the CSV file.
$file_path = './dates.csv';

echo"Open Dates File \n";
// Open the CSV file.
$file = fopen( $file_path, 'r' );

echo"Create an instance of the AW_Birthdays_Addon class. \n";
// Create an instance of the AW_Birthdays_Addon class.
$addon = AW_Birthdays();

echo"Starting date loop. \n";
// Loop through each line of the CSV file.
while ( ( $line = fgetcsv( $file ) ) !== false ) {
    
    // Get the user ID and birthday from the CSV line.
    $user_id = (int) $line[0];
    $birthday = $line[1];
    echo"found following data \n";
    echo"UserID: ";
    echo($user_id);
    echo"\n";
    echo"Birthday: ";
    echo($birthday);
    echo"\n";

    // Parse the birthday into a DateTime object.
    $date = DateTime::createFromFormat( 'Y-m-d', $birthday );
    if ($date === false) {
        // Invalid date format.
        continue;
    }

    // Set the user's birthday.
    $addon->set_user_birthday( $user_id, $date->format( 'd' ), $date->format( 'm' ), $date->format( 'Y' ) );

}

// Close the CSV file.
fclose( $file );
