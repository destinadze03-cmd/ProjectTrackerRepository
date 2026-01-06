<!DOCTYPE html>
<html>
<head>
    <title>Staff Dashboard</title>

    <style>
        body {
            font-family: Arial;
            background: #eef2ff;
            padding: 20px;
        }
        .container {
            max-width: 1100px;
            margin: auto;
        }
        .header {
            background: #1e40af;
            padding: 20px;
            color: #fff;
            border-radius: 8px;
        }
        .cards {
            display: flex;
            gap: 20px;
            margin-top: 20px;
        }
        .card {
            flex: 1;
            background: #fff;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
            text-align: center;
        }
        a.logout {
            color: red;
            float: right;
            margin-top: -20px;
        }
    </style>

</head>
<body>

<div class="container">

    <div class="header">
        <h2>Staff Dashboard</h2>
        <form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit">Logout</button>
</form>

    </div>

    <div class="cards">
        <div class="card">
            <h3>My Assigned Tasks</h3>
            <p>7</p>
        </div>
        <div class="card">
            <h3>Completed Tasks</h3>
            <p>3</p>
        </div>
        <div class="card">
            <h3>Pending Tasks</h3>
            <p>4</p>
        </div>
    </div>

</div>

</body>
</html>
