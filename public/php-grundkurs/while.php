<?php
$secret = "magic";
$attempts = 0;
$maxAttemps = 5;
while ($attempts < $maxAttemps) {
    echo "Guess the password: ";
    $guess = trim(fgets(STDIN));
    $attempts++;
    if ($guess === $secret) {
        echo "Access granted!\n";
        break;
    } else if ($attempts === $maxAttemps) {
        echo "Access denied! Too many attempts.\n";
        break;
    } else {
        echo "Wrong password. Try again.\n Attempts left: " . ($maxAttemps - $attempts) . "\n";
    }
}
