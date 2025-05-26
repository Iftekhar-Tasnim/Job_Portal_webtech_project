<?php
require_once 'db.php';

function setupDatabase() {
    $con = getConnection();
    
    // Read the SQL file
    $sql = file_get_contents('create_tables.sql');
    
    // Execute the SQL
    if (mysqli_multi_query($con, $sql)) {
        do {
            // Store first result set
            if ($result = mysqli_store_result($con)) {
                mysqli_free_result($result);
            }
        } while (mysqli_next_result($con));
        
        echo "All tables created successfully!";
    } else {
        echo "Error creating tables: " . mysqli_error($con);
    }
    
    mysqli_close($con);
}

// Run the setup
setupDatabase();
?> 