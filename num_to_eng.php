<?php

/**
 * Convert a numeric value to its English word representation with additional formatting.
 *
 * @param int $num The numeric value to convert.
 * @return string The formatted English word representation of the numeric value.
 */
function numberToWords($num) {
    if ($num < 0 || $num > 9999) {
        echo "Error: The argument should be equal or greater than 0, and less than 10,000.\n";
        exit(1);
    }
    // create array for read form engilsh check with number  
    $ones  = ['', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine'];
    $units = ['', 'thousand', 'million', 'billion', 'trillion', 'quadrillion'];
    $teens = ['eleven', 'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'];
    $tens  = ['', '', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety'];
    $num = (int)$num;
    if ($num == 0) {
        return 'zero';
    }

    $result = '';
    $unitIndex = 0;

    do {
        $chunk = $num % 1000;//The processes the input number in chunks of three digits.
        $num = floor($num / 1000);//conver to int 1.2 to 1 1.5 to 2

        echo $chunk;
        die();

        if ($chunk != 0) {
            $chunkResult = '';

            if ($chunk >= 100) {//use ones---------------------------------
                $chunkResult .= $ones[floor($chunk / 100)] . ' hundred';

                if ($chunk % 100 !== 0 && $num == 0) {
                    $chunkResult .= 's';
                }

                if ($num > 0) {
                    $chunkResult .= ' and';
                }

                $chunk %= 100;
            }

            if ($chunk >= 20) {//use tens--------------------------------------------------
                $chunkResult .= ' ' . $tens[floor($chunk / 10)];
                $chunk %= 10;
            }

            if ($chunk >= 11 && $chunk <= 19) {//use teens---------------------------------
                $chunkResult .= ' ' . $teens[$chunk - 11];
                $chunk = 0;
            }

            if ($chunk > 0) {//use ones----------------------------------------------------
                if ($chunkResult != '') {
                    $chunkResult .= '-';
                }
                $chunkResult .= ' ' . $ones[$chunk];
            }

            if ($unitIndex == 1 && $num > 0) {
                $chunkResult .= ',';
            }

            if ($unitIndex > 0) {//use units-----------------------------------------------
                $result = $chunkResult . ' ' . $units[$unitIndex] . ' ' . $result;
            } else {
                $result = $chunkResult . ' ' . $result;
            }
        }

        $unitIndex++;
    } while ($num > 0);

    return trim($result);//remove space
}

// Check if the script is executed with the correct number of arguments
if ($argc < 2) {
    echo "Usage: php num_to_eng.php <number>\n";
    exit(1);
}

// Get the numeric value from the command-line argument
$number = $argv[1];

// Convert the numeric value to English words with additional formatting
$englishWords = numberToWords($number);

// Display the result on terminal or powersal 
echo "$number: $englishWords\n";

?>