<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Generate XML File</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
<form action="./main.php" method="post" class="row g-3 mt-5 ms-5">
    <div class="col-auto">
        <label class="align-middle" for="url"><strong>Enter URL-address</strong></label>
        <input type="text" readonly class="form-control-plaintext" id="url">
    </div>
    <div class="col-auto">
        <label for="text" class="visually-hidden">URL</label>
        <input type="text" name="address" class="form-control" id="text" placeholder="http://example.com">
    </div>
    <div class="col-auto">
        <button type="submit" class="btn btn-primary mb-3">Generate XML File</button>
    </div>
</form>
</body>
</html>