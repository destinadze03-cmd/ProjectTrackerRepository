 <style>
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
        .sidebarr {
            width: 250px;
            background: #d6c1c7ff;
            color: white;
            padding-top: 20px;
            position: fixed;
            height: 100%;
        }

        .sidebarr h2 {
            text-align: center;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .sidebarr a {
            display: block;
            padding: 15px 20px;
            color: #060607ff;
            text-decoration: none;
            font-size: 16px;
        }

        .sidebarr a:hover {
            background: #0f172a;
            color: white;
        }

        /* Content area */
        .main-content {
            margin-left: 250px;
            padding: 20px;
            width: 100%;
        }

        /* Top bar */
        .topbar {
            background: white;
            padding: 15px 20px;
            border-radius: 8px;
            box-shadow: 0px 2px 4px rgba(0,0,0,0.08);
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* Task Cards */
        .task-card {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0px 3px 6px rgba(0,0,0,0.1);
            margin-bottom: 15px;
        }

        .task-card h3 {
            margin-top: 0;
        }

        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            color: white;
            margin-bottom: 10px;
        }

        .pending { background: #f59e0b; }
        .done { background: #10b981; }

        .btn {
            padding: 10px 15px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            margin-right: 5px;
            font-size: 14px;
        }

        .btn-done { background: #10b981; color: white; }
        .btn-pending { background: #f59e0b; color: white; }
        .btn-logout { background: #ef4444; color: white; }

        /* Mobile */
        @media (max-width: 768px) {
            .sidebarr {
                width: 100%;
                height: auto;
                position: relative;
            }
            .main-content {
                margin-left: 0;
            }
        }
    </style>