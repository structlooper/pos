<?php

class Database
{
    // Function to create the tables and fill them with the default data
    public function create_tables($data, $user = null, $code = null)
    {
        // Connect to the database
        $mysqli = new mysqli($data['hostname'], $data['username'], $data['password'], $data['database']);

        // Check for errors
        if (mysqli_connect_errno()) {
            return false;
        }

        // Open the default SQL file
        $query = $data['dbtables'];

        //update username and code
        $query .= " UPDATE `sma_settings` SET `envato_username`= '" . $user . "',`purchase_code`= '" . $code . "' WHERE setting_id = 1;";

        // Execute a multi query
        $mysqli->multi_query($query);

        // Close the connection
        $mysqli->close();

        return true;
    }
}
