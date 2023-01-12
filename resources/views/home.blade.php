<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite('resources/js/app.js')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script>
        $(function() {
            $("#startDate").datepicker();
            $("#startDate").datepicker("option", "dateFormat", "yy-mm-dd");
            $("#endDate").datepicker();
            $("#endDate").datepicker("option", "dateFormat", "yy-mm-dd");
        });
    </script>
</head>



<body class="antialiased">
    <main class="flex flex-col items-center justify-center h-screen">
        <h1 class="text-4xl font-bold mb-6">Get Historial Data On Companies</h1>
        <div class="block p-6 rounded-lg shadow-lg bg-white max-w-md">
            <form action="{{ route('view-history') }}" method="POST">
                @csrf
                <div class="form-group mb-6">
                    <select class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="company_code" placeholder="Company Code">
                        <option value="">Select a Company</option>
                        @foreach ($companies as $item)
                            <option value="{{ $item->Symbol }}">{{ $item->{'Company Name'} }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="form-group mb-6">
                        <input autocomplete="off" name="start_date" type="text" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="startDate" aria-describedby="start_date" placeholder="Start Date" required />
                    </div>
                    <div class="form-group mb-6">
                        <input autocomplete="off" name="end_date" type="text" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="endDate" aria-describedby="end_date" placeholder="End Date" required />
                    </div>
                </div>

                <div class="form-group mb-6">
                    <input type="email" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="email" placeholder="Email" required />
                </div>

                <button type="submit" class="w-full px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                    Sumbit
                </button>
            </form>
        </div>
    </main>

</body>

</html>