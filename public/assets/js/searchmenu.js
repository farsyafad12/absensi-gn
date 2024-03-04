function search() {
    var input, filter, table, tr, td, i, j, txtValue;
    input = document.getElementById("search");
    filter = input.value.toUpperCase();
    table = document.getElementById("table");
    tr = table.getElementsByTagName("tr");

    // Dapatkan nilai dari dropdown
    var tingkatElement = document.getElementById('tingkat');
    var kelasElement = document.getElementById('kelas');
    var tingkatValue = tingkatElement.value;
    var kelasValue = kelasElement.value;

    for (i = 0; i < tr.length; i++) {
        var matchFound = false;

        // Filter berdasarkan dropdown
        if ((tingkatValue === "" || tr[i].getAttribute('data-tingkat') === tingkatValue) &&
            (kelasValue === "" || tr[i].getAttribute('data-kelas') === kelasValue)) {

            // Cari data sesuai dengan input dari search bar
            for (j = 0; j < tr[i].getElementsByTagName("td").length; j++) {
                td = tr[i].getElementsByTagName("td")[j];
                if (td && td.tagName.toLowerCase() !== 'th') {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        matchFound = true;
                        break;
                    }
                }
            }
        }

        tr[i].style.display = matchFound ? "" : "none";
    }
}



// Dropdown Menu Area Search

document.addEventListener('DOMContentLoaded', function () {
    filterData();
});

function filterData() {
    var tingkatElement = document.getElementById('tingkat');
    var kelasElement = document.getElementById('kelas');
    var pesanElement = document.getElementById('pesan');
    var tingkatValue = tingkatElement.value;
    var kelasValue = kelasElement.value;
    var dataRows = document.getElementById('table').getElementsByTagName('tbody')[0].getElementsByTagName('tr');
    var dataDitemukan = false;

    pesanElement.innerHTML = ""; // Memastikan elemen pesan dikosongkan sebelum filter

    if (tingkatValue === "" && kelasValue === "") {
        // Jika keduanya tidak memiliki value, tampilkan semua data
        for (var i = 0; i < dataRows.length; i++) {
            dataRows[i].style.display = "";
        }
        return;
    }

    if (kelasValue !== "" && tingkatValue === "") {
        pesanElement.innerHTML = "Harap pilih tingkat terlebih dahulu.";
        // Jika kelas terpilih, tetapi tingkat belum dipilih, munculkan pesan kesalahan
        for (var i = 0; i < dataRows.length; i++) {
            dataRows[i].style.display = "none";
        }
        return;
    }

    for (var i = 0; i < dataRows.length; i++) {
        var rowDataTingkat = dataRows[i].getAttribute('data-tingkat');
        var rowDataKelas = dataRows[i].getAttribute('data-kelas');
        var isTingkatMatch = tingkatValue === "" || tingkatValue === rowDataTingkat;
        var isKelasMatch = kelasValue === "" || kelasValue === rowDataKelas;

        if (isTingkatMatch && isKelasMatch) {
            dataRows[i].style.display = "";
            dataDitemukan = true;
        } else {
            dataRows[i].style.display = "none";
        }
    }

    if (!dataDitemukan) {
        pesanElement.innerHTML = "Data tidak ditemukan.";
    }
}
