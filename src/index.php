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
    $split = explode(".", $client_ip);
    $client_ip_prefix = join(".", array_slice($split, 0, 3));

    if ($client_ip_prefix === "192.168.0") {
        $valid = true;
    }
}

if ($valid) {
    echo "flag:this_is_flag", PHP_EOL;
} else {
    echo "Forbidden", PHP_EOL;
}
?>
</body>
</html>
