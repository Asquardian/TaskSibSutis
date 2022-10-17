function filterTable() {
    var input, filter, table, tr, td, i;
    input = document.getElementById("selector");
    filter = input.value.toUpperCase();
    table = document.getElementById("userRequestsTable");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[3];
        if (td) {
            tr[i].classList.toggle("hide", filter && td.innerHTML.toUpperCase() !== filter)
        }
    }
}