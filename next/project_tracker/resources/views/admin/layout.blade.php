<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .header {
            background: #333;
            color: #fff;
            padding: 15px;
            font-size: 20px;
        }
        .container {
            padding: 20px;
        }
        .card {
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .input, select, textarea {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .btn {
            padding: 10px 20px;
            background: #333;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
        }
        .btn:hover {
            background: #555;
        }
    </style>
</head>

<body>

    <div class="header">
        @yield('header')
    </div>

    <div class="container">
        @yield('content')
    </div>

</body>
</html>
