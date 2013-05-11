<!DOCTYPE html>
<html>
    <head>
        <title>Guest Book</title>
        <link type="text/css" rel="stylesheet" href="/www/style.css">
        <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
        <script src="/www/script.js"></script>
    </head>
    <body>
        <header>
            <p>Welcome to our guest book!</p>
        </header>
        <div id="wrapper">
            <div id="menu">
                <ul type="none">
                    <li>
                        <a href="/">View comments</a>
                    </li>
                    <li>
                        <a href="/index/add">Add your comment</a>
                     </li>
                </ul>
            </div>
            <div id="content">
                <?php echo $content;?>
            </div>
        </div>
    </body>
</html>
