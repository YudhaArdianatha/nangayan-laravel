<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service PDF Export</title>
</head>
<body>
    <h1>List of Services</h1>
    <table width="100%" border="1" cellspacing="0" cellpadding="5">
        <thead>
            <tr>
                <th>ID</th>
                <th>Service Name</th>
                <th>Description</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($services as $service)
            <tr>
                <td>{{ $service->id }}</td>
                <td>{{ $service->service_name }}</td>
                <td>{{ $service->service_description }}</td>
                <td>Rp {{ number_format($service->service_price, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
