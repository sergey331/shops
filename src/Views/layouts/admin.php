<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/assets/css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    
    <title>Admin</title>
</head>
<body>
    <div class="content">
        
   
        <div class="menu wide">
            <div class="toggle-menu-block">
                <button class="toggle-menu">
                    <span class="arrowleft">
                        <i class="fa-solid fa-arrow-right "></i>
                    </span>
                    <span class="arrowright d-none">
                        <i class="fa-solid fa-arrow-left" ></i>
                    </span>
                </button>
            </div>
            <?php include __DIR__ . "/component/adminNavBar.php" ?>
        </div>
        <main>
            <?= $content ?>
        </main>
    </div> 

    <footer>
   
    </footer>

    <script src="/assets/js/admin/admin.js"></script>
</body>
</html>