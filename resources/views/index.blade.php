<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Klasemen Sepak Bola - @yield('title')</title>
        <link rel="stylesheet" href="/css/style.css">
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
        <script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="container">

            <!-- navbar -->
            <div class="row shadow-lg p-3 mb-2 rounded d-flex navbar bg-white">
                <ul class="nav d-flex justify-content-between">
                    <div class="d-flex">

                    {{-- link home --}}
                    <li class="nav-item">
                        <a
                            class="nav-link active fs-4 border rounded"
                            aria-current="page"
                            href="/"
                            >Bola</a
                        >
                    </li>

                    {{-- klub --}}
                    <li class="nav-item">
                        <a
                            class="nav-link active"
                            aria-current="page"
                            href="{{ url('/klub') }}"
                            >Klub</a
                        >
                    </li>

                    {{-- skor --}}
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/skor') }}"
                            >Skor</a
                        >
                    </li>

                </div>
                <div>
                    {{-- search --}}
                    <li class="nav-item ">
                        <form
                            class="d-flex "
                            role="search"
                            method="GET"
                            action="{{ url('/') }}"
                        >
                            {{-- search --}}
                            <input
                                class="form-control me-2"
                                type="search"
                                placeholder="Search "
                                aria-label="Search"
                                name="katakunci"
                                value="{{Request::get('katakunci')}}"
                            />

                            <button
                                class="btn btn-outline-primary"
                                type="submit"
                            >
                                Search
                            </button>
                        </form>
                    </li> 
                </div>
                </ul>
            </div>
            <!-- akhir navbar -->

            @yield('content')
        </div>

        {{-- bootstra --}}
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous">
        </script>

        {{-- sweet Allert --}}
        @include('sweetalert::alert')
    
     </body>
</html>