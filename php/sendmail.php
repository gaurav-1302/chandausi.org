<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $to_email = "chdpravasi@gmail.com"; // Change this to your email address

    // Sanitize user input to prevent email injection
    $first_name = filter_var($_POST["first_name"], FILTER_SANITIZE_STRING);
    $last_name = filter_var($_POST["last_name"], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $phone = filter_var($_POST["phone"], FILTER_SANITIZE_STRING);
    $profession = filter_var($_POST["profession"], FILTER_SANITIZE_STRING);
    $city = filter_var($_POST["city"], FILTER_SANITIZE_STRING);
    $country = filter_var($_POST["country"], FILTER_SANITIZE_STRING);
    $year_from = filter_var($_POST["year_from"], FILTER_SANITIZE_NUMBER_INT);
    $year_to = filter_var($_POST["year_to"], FILTER_SANITIZE_NUMBER_INT);
    $message = filter_var($_POST["form_message"], FILTER_SANITIZE_STRING);

    // Email subject
    $subject = "Volunteer Application";

    // Email content
    $email_content = "First Name: $first_name\n";
    $email_content .= "Last Name: $last_name\n";
    $email_content .= "Email: $email\n";
    $email_content .= "Phone: $phone\n";
    $email_content .= "Profession: $profession\n";
    $email_content .= "Current City: $city\n";
    $email_content .= "Country: $country\n";
    $email_content .= "Period Lived in Chandausi: From $year_from to $year_to\n\n";
    $email_content .= "Message:\n$message\n";

    // Email headers
    $headers = "From: $first_name $last_name <$email>\r\n";
    $headers .= "Reply-To: $email\r\n";

    // Send email
    if (mail($to_email, $subject, $email_content, $headers)) {
        $response = array("result" => "success");

        // Return JSON response
        echo json_encode($response);
    } else {
        $response = array("result" => "failed");

        // Return JSON response
        echo json_encode($response);
    }
} else {
    $response = array("result" => "failed");

    // Return JSON response
    echo json_encode($response);
}

?>