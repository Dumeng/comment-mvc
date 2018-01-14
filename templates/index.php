<!DOCTPYE html>
<html>
<head>
    <title>{{ $title }}</title>
</head>
<body>
    <form action="index.php" method="post" style="width: 640px; margin: 100px auto;">
        <input type="text" name="title" placeholder="Title" style="width: 320px; margin-bottom: 20px; font-size: 24px;">
        <textarea name="text" placeholder="Text" style="width: 640px; height:320; margin-bottom: 20px; font-size: 24px;" ></textarea>
        <input type="submit" value="Submit" style="font-size: 24px;">
    </form>
</body>
</html>