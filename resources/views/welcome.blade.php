<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Todo-app</title>
    {{--  css  --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body class="bg-dark">
    <header class="bg-primary border border-end-0 border-start-0 border-top-0 mx-5 p-3 rounded-bottom text-white">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                    <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap">
                        {{--  <use xlink:href="#bootstrap"></use>  --}}
                    </svg>
                </a>

                <div class="nav col-12 col-lg-auto me-lg-auto "></div>

                <div class="text-end">
                    <button type="button" class="btn btn-outline-light me-2">Login</button>
                    <button type="button" class="btn btn-warning">Sign-up</button>
                </div>
            </div>
        </div>
    </header>
    <main>
          <div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-dark">
            <div class="col-md-5 p-lg-5 mx-auto my-5 text-white">
                <h1 class="display-4 fw-normal">Todo List</h1>
                <p class="lead fw-normal">Are you tired of feeling overwhelmed by your daily tasks and to-dos? Do you struggle to keep track of important deadlines and appointments? TaskTracker Pro is here to simplify your life and supercharge your productivity. TodoList is your sulution .</p>
                <a href="#" class="btn btn-lg btn-secondary fw-bold border-white bg-white text-black-50">Register</a>
              </div>
          </div>
    </main>


    <footer>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>
    </footer>
</body>

</html>
