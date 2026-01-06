<!DOCTYPE html>
<html>
<head>
    <title>Simple PHP Calculator</title>
    <style>
        body {
            font-family: Arial;
            background: #f4f4f4;
        }
        .container {
            width: 350px;
            margin: 60px auto;
            padding: 20px;
            background: white;
            border-radius: 5px;
            box-shadow: 0px 0px 10px #ccc;
        }
        input, select {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
        }
        button {
            width: 100%;
            padding: 10px;
            background: black;
            color: white;
            border: none;
        }
        h2 {
            text-align: center;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>PHP Calculator</h2>

    <form method="post">
        <input type="number" step="any" name="num1" placeholder="Enter first number" required>
        <input type="number" step="any" name="num2" placeholder="Enter second number" required>

        <select name="operation">
            <option value="add">Add (+)</option>
            <option value="subtract">Subtract (-)</option>
            <option value="multiply">Multiply (*)</option>
            <option value="divide">Divide (/)</option>
        </select>

        <button type="submit">Calculate</button>
    </form>

    <h3>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $num1 = $_POST['num1'];
        $num2 = $_POST['num2'];
        $operation = $_POST['operation'];

        switch ($operation) {
            case "add":
                echo "Result: " . ($num1 + $num2);
                break;

            case "subtract":
                echo "Result: " . ($num1 - $num2);
                break;

            case "multiply":
                echo "Result: " . ($num1 * $num2);
                break;

            case "divide":
                if ($num2 == 0) {
                    echo "Error: Cannot divide by zero";
                } else {
                    echo "Result: " . ($num1 / $num2);
                }
                break;

            default:
                echo "Invalid operation";
        }
    }
    ?>
    </h3>
</div>

</body>
</html>
