
<!DOCTYPE html>
<html>
<head>
    <title>PHP Error Handling</title>
</head>
<body>

    <h2>PHP Error Handling and Debugging</h2>

    <?php

    try {

        $a = 10;
        $b = 0;

        echo "Program Started<br>";

        if ($b == 0) {

            throw new Exception(
                "Division by zero is not allowed!"
            );

        }

        $result = $a / $b;

        echo "Result: " . $result;

    }

    catch (Exception $e) {

        echo "Error: " . $e->getMessage() . "<br>";

    }

    finally {

        echo "Program Execution Completed.";

    }

    // Debugging example
    $name = "Rahul";

    echo "<br><br>";

    var_dump($name);

    ?>

</body>
</html>
