<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU"
            crossorigin="anonymous">

        <title>Hello, world!</title>
    </head>
    <body>
        <form action ='uploads/upload-file-and-image.php' method='POST' enctype = 'multipart/form-data'>
            <input type="file" name="file">
            <button type='submit' name='submit'>Upload image</button>
        </form>
    </body>
</html>
