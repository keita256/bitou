<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>

<body>
    <table class="table text-center">
        <tr>
            <th class="text-center">日付</th>
            <th class="text-center">費目</th>
            <th class="text-center">内容</th>
            <th class="text-center">価格</th>
        </tr>
        
        @foreach($spends as $spend)
        <tr>
            <td>{{ $spend->date }}</td>
            <td>{{ $spend->name }}</td>
            <td>{{ $spend->content }}</td>
            <td>{{ $spend->amount }}</td>
        </tr>
        @endforeach
    </table>
</body>

</html>