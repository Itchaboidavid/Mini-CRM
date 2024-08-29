<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>New Company Entered</title>
</head>

<body>
    <h1>New Company Entered</h1>
    <p>A new company named {{ $company->name }} has entered</p>
    <p>Email: {{ $company->email }}</p>
    <p>Webiste: {{ $company->website }}</p>
</body>

</html>
