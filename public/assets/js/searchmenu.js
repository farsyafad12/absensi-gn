    function search() {
    var input, filter, table, tr, td, i, j, txtValue;
    input = document.getElementById("search");
    filter = input.value.toUpperCase();
    table = document.getElementById("table");
    tr = table.getElementsByTagName("tr");
    if (filter === "") {
        for (i = 0; i < tr.length; i++) {
            tr[i].style.display = "";
        }
        return;
    }
    for (i = 0; i < tr.length; i++) {
        var matchFound = false;
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
        tr[i].style.display = matchFound || i === 0 ? "" : "none";
    }
}


// Dropdown Menu Area Search

document.addEventListener('DOMContentLoaded', function() {
    filterData();
});

function filterData() {
    var tingkatElement = document.getElementById('tingkat');
    var kelasElement = document.getElementById('kelas');
    var pesanElement = document.getElementById('pesan');
    var tingkatValue = tingkatElement.value;
    var kelasValue = kelasElement.value;
    var dataRows = document.getElementsByClassName('data');
    var dataDitemukan = false;
    if (tingkatValue === "" && kelasValue === "") {
        pesanElement.innerHTML = "";
        for (var i = 0; i < dataRows.length; i++) {
            dataRows[i].classList.add('block');
        }
        return;
    }
    if (tingkatValue !== "" && kelasValue === "") {
        pesanElement.innerHTML = "";
    }

    if (tingkatValue === "" && kelasValue !== "") {
        pesanElement.innerHTML = "Harap pilih tingkat terlebih dahulu.";
        for (var i = 0; i < dataRows.length; i++) {
            dataRows[i].classList.remove('block');
        }
        return;
    }

    pesanElement.innerHTML = "";

    for (var i = 0; i < dataRows.length; i++) {
        var rowDataTingkat = dataRows[i].getAttribute('data-tingkat');
        var rowDataKelas = dataRows[i].getAttribute('data-kelas');

        if (tingkatValue === rowDataTingkat && (kelasValue === "" || kelasValue === rowDataKelas)) {
            dataRows[i].classList.add('block');
            dataDitemukan = true;
        } else {
            dataRows[i].classList.remove('block');
        }
    }

    if (!dataDitemukan) {
        pesanElement.innerHTML = "Data tidak ditemukan.";
    }
}
