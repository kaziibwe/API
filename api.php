<?php
// Database connection parameters
$host = "sql9.freesqldatabase.com"; // Your database host
$username = "sql9649425"; // Your database username
$password = "KYslTI3NHj"; // Your database password
$database = "sql9649425"; // Your database name

try {

    // Create a database connection
    $conn = new mysqli($host, $username, $password, $database);
    // Check the connection
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }

    // Check if a savers_id is provided in the request
    if (isset($_GET['savers_id'])) {
        $savers_id = $_GET['savers_id'];

        // Prepare and execute a SQL query to fetch user data and attendance details
        $sql = "SELECT 
                    `groups`.id AS group_id, 
                    `groups`.group_name, 
                    `members`.id AS member_id, 
                    `members`.name, 
                    `members`.tel, 
                    `members`.NIN, 
                    `members`.email, 
                    `members`.Location, 
                    `attendances`.attending_time, 
                    `attendances`.attendance_fee 
                FROM 
                    `groups` 
                JOIN `members` ON `groups`.id = `members`.group_id 
                JOIN `attendances` ON `members`.id = `attendances`.member_id 
                WHERE `members`.id = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $savers_id);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if a user with the given savers_id exists
        if ($result->num_rows > 0) {
            $user_data = array();

            while ($row = $result->fetch_assoc()) {

                $group_data = array(
                    'GroupID' => $row['group_id'],
                    'GroupName' => $row['group_name'],
                    

                );
                $user_data['Full tname'] = $row['name'];
                $user_data['E-mail'] = $row['email'];
                $user_data['NIN-Number'] = $row['NIN']; 
                $user_data['Phone'] = $row['tel'];
                $user_data['Location'] = $row['Location'];
                $user_data['Attendances'][] = array(
                   
                    'AttendingTime' => $row['attending_time'],
                    'AttendanceFee' => $row['attendance_fee'],
                );
            }
            $all_user_data = array_merge($group_data, $user_data);


            // Return the user data as JSON with proper formatting
            header('Content-Type: application/json');
            echo json_encode($all_user_data, JSON_PRETTY_PRINT);
        } else {
            // User not found
            header('HTTP/1.0 404 Not Found');
            echo json_encode(array('message' => 'User not found'));
        }

        // Close the statement
        $stmt->close();
    } else {
        // savers_id not provided in the request
        header('HTTP/1.0 400 Bad Request');
        echo json_encode(array('message' => 'savers_id is required'));
    }
    // Close the database connection
    $conn->close();
} catch (Exception $e) {
    // Handle exceptions gracefully
    header('HTTP/1.0 500 Internal Server Error');
    echo json_encode(array('error' => $e->getMessage()));
}
    ?>
