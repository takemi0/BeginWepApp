<html>
    <head>
        <title>はろ～</title>
    </head>
    <body>
        <div> <?php echo $data['message']; ?> </div>

        <?php $data = ['message' => '変数の内容です' ]; ?>

        <p><?php echo "Hello World."; ?></p>

        <div> <?php echo $data['message']; ?> </div>
    </body>
</html>