<?php
const VALID_SOURCE_IP = "192.168.0.10";
$FLAG = $_ENV["FLAG"];
?>

<html>
<head>
    <title>internal-only</title>
</head>
<body>
<?php
$valid = false;

if (array_key_exists("HTTP_X_FORWARDED_FOR", $_SERVER)) {
    $source_ips = explode(",", $_SERVER["HTTP_X_FORWARDED_FOR"]);
    $trimmed = array_map(fn($x) => trim($x), $source_ips);
    $client_ip = $trimmed[0];

    if ($client_ip === VALID_SOURCE_IP) {
        $valid = true;
    }
}

if ($valid) {
    echo "flag:$FLAG", PHP_EOL;
} else {
    echo "Forbidden", PHP_EOL;
}
?>
</body>
</html>
