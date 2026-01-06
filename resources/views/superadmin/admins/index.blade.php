<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Admins</title>

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #f4f4f4;
            display: flex;
        }

        /* SIDEBAR */
        .sidebar {
            width: 240px;
            height: 100vh;
            background: #1A237E;
            color: #fff;
            padding: 20px;
            position: fixed;
            left: 0;
            top: 0;
        }

        .sidebar h2 {
            margin-top: 0;
            font-size: 22px;
            margin-bottom: 25px;
            text-align: center;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
            margin-top: 20px;
        }

        .sidebar ul li {
            padding: 12px 10px;
            margin-bottom: 10px;
            background: rgba(255,255,255,0.1);
            border-radius: 6px;
            cursor: pointer;
            transition: 0.3s;
        }

        .sidebar ul li:hover {
            background: rgba(255,255,255,0.3);
        }

        /* MAIN CONTENT */
        .main-conten {
            margin-left: 260px;
            padding: 20px;
            width: calc(100% - 260px);
        }

        h2 {
            margin-bottom: 20px;
        }

        .card {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.15);
        }

        .card h3 {
            margin-top: 0;
        }

        .input {
            width: 100%;
            padding: 10px;
            margin: 8px 0 15px 0;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        .btn {
            padding: 10px 18px;
            border: none;
            background: #1A237E;
            color: white;
            cursor: pointer;
            border-radius: 6px;
            font-weight: bold;
            transition: 0.3s;
        }

        .btn:hover {
            background: #000e6b;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table th, table td {
            padding: 10px;
            border: 1px solid #ddd;
        }

        table th {
            background: #1A237E;
            color: white;
        }

        @media(max-width: 900px) {
            .sidebar {
                width: 200px;
            }
            .main-conten {
                margin-left: 210px;
            }
        }

        @media(max-width: 600px) {
            .sidebar {
                display: none;
            }
            .main-conten {
                margin-left: 0;
                width: 100%;
            }
        }
    </style>
</head>
<body>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <h2>Super Admin</h2>

        <ul>
            <li><a href="{{ route('superadmin.dashboard') }}" style="text-decoration: none; color: inherit;">
        Dashboard
    </a></li>
             <li>
    <a href="{{ route('superadmin.admins.index') }}" style="text-decoration: none; color: inherit;">
        Manage Admins
    </a>
</li>
            
    <li><a href="{{ route('superadmin.projects.index') }}" style="text-decoration: none; color: inherit;">Projects </a></li>
     <li><a href="{{ route('superadmin.task.index') }}" style="text-decoration: none; color: inherit;">Task</a></li>

            <li>Settings</li>
            <li><form action="{{ route('logout') }}" method="POST" style="padding:2px;">
            @csrf
            <button class="btn btn-delete">Logout</button>
        </form></li>
        </ul>
    </div>

    <!-- MAIN CONTENT -->
    <div class="main-conten">

        <h2>Manage Admins</h2>

        <!-- SUCCESS MESSAGE -->
        @if(session('success'))
            <div style="background: #c8e6c9; padding: 10px; border-radius: 6px; margin-bottom:10px;">
                {{ session('success') }}
            </div>
        @endif

        <!-- ERROR MESSAGE -->
        @if(session('error'))
            <div style="background: #ffcdd2; padding: 10px; border-radius: 6px; margin-bottom:10px;">
                {{ session('error') }}
            </div>
        @endif


        <!-- CREATE NEW ADMIN -->
        <div class="card">
            <h3>Create New Admin</h3>

            <form action="{{ route('superadmin.admins.create') }}" method="POST">
                @csrf

                <label>Name:</label>
                <input type="text" name="name" required class="input">

                <label>Email:</label>
                <input type="email" name="email" required class="input">

                <label>Password:</label>
                <input type="password" name="password" required class="input">

                <button class="btn">Create Admin</button>
            </form>
        </div>


        <!-- CURRENT ADMINS -->
        <div class="card">
            <h3>Current Admins</h3>

            <table>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                </tr>

                @foreach($admins as $admin)
                <tr>
                    <td>{{ $admin->name }}</td>
                    <td>{{ $admin->email }}</td>
                </tr>
                @endforeach
            </table>
        </div>


        <!-- CONVERT STAFF TO ADMIN -->
        <div class="card">
            <h3>Convert Staff to Admin</h3>

            <table>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>

                @foreach($staff as $s)
                <tr>
                    <td>{{ $s->name }}</td>
                    <td>{{ $s->email }}</td>
                    <td>
                        <form action="{{ route('superadmin.admins.convert', $s->id) }}" method="POST">
                            @csrf
                            <button class="btn">Convert to Admin</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>

    </div>

</body>
</html>
