
    <style>
        /* Global */
        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #0c2a57ff;
        }

        /* Layout */
        .container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 260px;
            background: #d6c1c7ff;
            color: #060607ff;
            padding-top: 20px;
            position: fixed;
            height: 100%;
        }

        .sidebar h2 {
            text-align: center;
            font-weight: bold;
            margin-bottom: 30px;
        }

        .sidebar a {
            display: block;
            padding: 15px 25px;
            text-decoration: none;
            font-size: 16px;
            color: #060607ff;
        }

        .sidebar a:hover {
            background: #0f172a;
            color: white;
        }

        /* Main content */
        .main-content {
            margin-left: 260px;
            padding: 25px;
            width: 100%;
        }

        /* Topbar */
        .topbar {
            background: white;
            padding: 18px 25px;
            border-radius: 8px;
            margin-bottom: 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0px 2px 5px rgba(0,0,0,0.1);
        }

        /* Stat Cards */
        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .card {
            padding: 20px;
            background: white;
            border-radius: 12px;
            box-shadow: 0px 3px 6px rgba(0,0,0,0.1);
        }

        .card h3 {
            margin: 0;
            font-size: 22px;
        }

        .card p {
            margin-top: 10px;
            color: gray;
            font-size: 16px;
        }

        /* Table */
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0px 3px 6px rgba(0,0,0,0.1);
        }

        th, td {
            padding: 15px;
            text-align: left;
            font-size: 15px;
        }

        th {
            background: #d6c1c7ff;
            color: #060607ff;
        }

        tr:nth-child(even) {
            background: #f5f5f5;
        }

        /* Action buttons */
        .btn {
            padding: 8px 15px;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            cursor: pointer;
        }

        .btn-edit { background: #0ea5e9; color: white; }
        .btn-delete { background: #ef4444; color: white; }
        .btn-add { background: #10b981; color: white; margin-bottom: 15px; }

        /* Mobile */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }
            .main-content {
                margin-left: 0;
            }








        }















        .status-pending { background:#fff3cd; color:#856404; }
.status-submitted { background:#cce5ff; color:#004085; }
.status-approved { background:#d4edda; color:#155724; }
.status-rejected { background:#f8d7da; color:#721c24; }

    </style>