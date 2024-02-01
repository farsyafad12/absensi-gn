<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }} | SIT Gema Nurani</title>
    <style>
        .data {
            border: 1px solid #b3adad;
            border-collapse: collapse;
            padding: 5px;
        }

        .data th {
            border: 1px solid #b3adad;
            padding: 5px;
            background: #ffffff;
            color: #313030;
        }

        .data td {
            border: 1px solid #b3adad;
            text-align: center;
            padding: 5px;
            background: #ffffff;
            color: #313030;
        }

        @media print {
            body {
                margin: 0;
            }

            table.data {
                page-break-inside: auto;
                font-size: 10pt;
            }

            th,
            td {
                padding: 5px;
            }

            span {
                display: block;
            }

            @page {
                size: landscape;
                margin: 0;
            }
        }
    </style>
</head>

<body>
    <table>
        <tbody>
            <tr>
                <td><img src="/assets/images/logos/gema-small.png" width="100px" height="100px"></td>
                <td width="100%">
                    <h2 align="center">Laporan Kehadiran Siswa</h2>
                    <h4 align="center">SMPIT Gema Nurani</h4>
                    <h4 align="center">Absensi Siswa</h4>
                </td>
                <td>
                    <img src="/assets/images/profile/user-1.jpg" width="100px" height="100px" style="border-radius: 8px">
                </td>
            </tr>
        </tbody>
    </table>
    <div style="display: flex;justify-content: space-between;width: 100%;"><span>Bulan : {{ $bulan }} {{ $tahun }}</span><span>Kelas : {{ $kelasInfo->kelas }}</span></div>
    <table class="data">
        <thead>
            <tr>
                <th colspan="2"></th>
                <th colspan="31">Tanggal Kehadiran</th>
            </tr>
            <tr>
                <th colspan="2"></th>
                @foreach ($dates as $date)
                    <th>{{ substr($date['day'], 0, 3) }}</th>
                @endforeach
            </tr>
            <tr>
                <th>No</th>
                <th>Nama Lengkap Siswa</th>
                @foreach ($dates as $date)
                    <th>{{ $date['date'] }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($siswa as $key => $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nama_siswa }}</td>
                    @foreach ($dates as $date)
                        @php
                            $absensi = $absensiData[$date['date']]->where('id_siswa', $item->id_siswa)->first();
                            $idKehadiran = $absensi ? $absensi->id_kehadiran : null;
                        @endphp
                        <td style="background-color: {{ $getBackgroundColor($idKehadiran) }}">
                            {{ $getAttendanceText($idKehadiran) }}
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        // Function to trigger print or download PDF
        function printOrDownloadPDF() {
            // You can customize this part based on your PDF generation method
            window.print();
        }

        // Automatically trigger print or download PDF when the page loads
        window.onload = function () {
            printOrDownloadPDF();
        };
    </script>
</body>

</html>
