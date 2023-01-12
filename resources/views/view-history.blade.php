<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    @vite('resources/js/app.js')
    <title>{{ $companyName }} History Data</title>
</head>

<body class="text-blueGray-700 antialiased">
    <div class="flex flex-col mx-10 mt-4 w-full">
        <noscript>You need to enable JavaScript to run this app.</noscript>
        <div class="shadow-md overflow-hidden max-w-4xl">
            <div class="py-3 px-5 bg-gray-50">{{ $companyName }} History Data Chart</div>
            <canvas class="p-10" id="chartLine"></canvas>
        </div>
    </div>
    <div class="flex flex-col w-full">
        <div class="flex flex-col">
            <div class="overflow-x-auto sm:mx-0.5 lg:mx-0.5">
                <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="overflow-hidden">
                        <table class="min-w-fit">
                            <thead class="bg-white border-b">
                                <tr>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        #
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Date
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Open
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        High
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Low
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Close
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Volume
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($companyData as $data)
                                    <tr class="bg-gray-100 border-b">
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            {{ $data->newDate }}
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            {{ $data->open }}
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            {{ $data->high }}
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            {{ $data->low }}
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            {{ $data->close }}
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            {{ $data->volume }}
                                        </td>

                                    </tr>
                                @empty
                                    <tr class="bg-gray-100 border-b">
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            No data in this time period
                                        </td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Required chart.js -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <!-- Chart line -->
        <script>
            const labels = [
                @foreach ($companyData as $item)
                    new Date({{ $item->date }} * 1000).toLocaleDateString(),
                @endforeach
            ];
            console.log(labels);
            const openPrices = [
                @foreach ($companyData as $item)
                    {{ $item->open }},
                @endforeach
            ];

            const closePrices = [
                @foreach ($companyData as $item)
                    {{ $item->close }},
                @endforeach
            ];
            const data = {
                labels: labels,
                datasets: [{
                        label: "{{ $companyName }} Open Prices",
                        backgroundColor: "hsl(252, 82.9%, 67.8%)",
                        borderColor: "hsl(252, 82.9%, 67.8%)",
                        data: openPrices,
                    },
                    {
                        label: "{{ $companyName }} Close Prices",
                        backgroundColor: "hsl(242, 82.9%, 27.8%)",
                        borderColor: "hsl(242, 82.9%, 27.8%)",
                        data: closePrices,
                    },
                ],
            };

            const configLineChart = {
                type: "line",
                data,
                options: {},
            };

            var chartLine = new Chart(
                document.getElementById("chartLine"),
                configLineChart
            );
        </script>
    </div>

</body>

</html>
