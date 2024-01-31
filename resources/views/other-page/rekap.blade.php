<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }} | SIT Gema Nurani</title>
</head>
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
</style>

<body>
    <table>
        <tbody>
            <tr>
                <td><img src="https://farsyafad.tech/images/logo-farsyafad-coding.jpg" width="100px" height="100px"></td>
                <td width="100%">
                    <h2 align="center">Laporan Kehadiran Siswa</h2>
                    <h4 align="center">SMPIT Gema Nurani</h4>
                    <h4 align="center">Absensi Siswa</h4>
                </td>
                <td>
                    <div style="width:100px"></div>
                </td>
            </tr>
        </tbody>
    </table>
    <span>Bulan : January 2024</span>
    <span style="position: absolute;right: 0;">Kelas : $kelas</span>
    <table class="data">
        <thead>
            <tr>
                <th colspan="2"></th>
                <th colspan="31">Tanggal Kehadiran</th>
            </tr>
            <tr>
                <th colspan="2"></th>
                @foreach ($dates as $date)
                    <th>{{ $date['day'] }}</th>
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
            <tr>
                <td>1</td>
                <td>Ahnaf Samih Al Farisi</td>
                <td style="background-color: red;">A</td>
            </tr>
        </tbody>
    </table>


</body>

</html>
