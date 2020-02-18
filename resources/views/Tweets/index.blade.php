<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Micro Service blog</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>

    <div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h1>Users table</h1>
        </div>

        <div class="body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <td>id</td>
                        <td>name</td>
                        <td>Tweet</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tweets as $tweet)
                    <tr>
                        <td>{{$tweet->id}}</td>
                        <td>{{$tweet->user_id}}</td>
                        <td>{{$tweet->tweet}}</td>
                        <td>
                            <form action="/tweets/{{$tweet->id}}" method="POST" style="display:inline-block">
                            @csrf 
                            @method('DELETE') 
                            <button class="btn btn-inverse-danger btn-fw" type=submit onclick="return confirm('Are You Sure You Want To Delete This Record ?')" >
                                Delete <i class="mdi mdi-delete"></i>
                            </button> 
                            </form>
                        </td>
                        </tr>
                    @endforeach
                
                </tbody>
            </table>
        </div>
    </div>
    


    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>