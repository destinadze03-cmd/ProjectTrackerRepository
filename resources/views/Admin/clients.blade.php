<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>


    @include('admin.admincss')
</head>
<body>

<!--<div class="container">-->

   

@include('admin.adminnavbar')


    <!-- Main -->
    <div class="main-content">

        <!-- Top Bar -->
        <div class="topbar">
            <h2>You Are Creating, client</h2>
            <span>Today: <strong>{{ date('M d, Y') }}</strong></span>
        </div>

        
    </div>
</div>

</body>
</html>
