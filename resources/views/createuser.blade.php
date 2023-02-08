<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script></script>
    <title>StudentWebApp | Create User</title>
</head>

<body>
    <div class="row">

        <form action='{{route("createuserpost")}}' method="GET" style="margin-left:auto;margin-right:auto; width: 50%;" >
            @csrf
            <div class="form-row">
                <div class="col-md-4 mb-3">
                    <label > name </label>
                    <input type="text" required="" class="form-control" name="name" placeholder="tam adinizi giriniz" value="">
                </div>
                <div class="col-md-4 mb-3">
                    <label >email no need @ </label>
                    <input type="text" required="" class="form-control" name="email" placeholder="kullanıcı adi giriniz" value="">
                </div>
                <div class="col-md-4 mb-3">
                    <label > password </label>
                    <input type="text" required="" class="form-control" name="password" placeholder="şifre giriniz" value="">
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-12 mb-3">
                    <button class="btn btn-primary" type="submit" >create user</button>
                </div>
            </div>
        </form>

    </div>
</body>

</html>