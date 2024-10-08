<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = [
        'name' => $_POST['name'],
        'gender' => $_POST['gender'],
        'marital_status' => $_POST['marital_status'],
        'phone' => $_POST['phone'],
        'email' => $_POST['email'],
        'address' => $_POST['address'],
        'dob' => $_POST['dob'],
        'nationality' => $_POST['nationality'],
        'hire_date' => $_POST['hire_date'],
        'department' => $_POST['department']
    ];

    $url = 'http://localhost:81/restApi/public/api/save';

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

    $response = curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    curl_close($ch);

    if ($httpcode == 200) {
        echo "Employee data submitted successfully!";
		header("Refresh:5; url=index.html");
    } else {
        echo $httpcode;
    }
}
?>
