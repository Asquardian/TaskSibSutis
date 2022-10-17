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

function sortTable(n) {
    var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
    table = document.getElementById("userRequestsTable");
    switching = true;
    // Узнаем в какую сторону сортировать
    dir = "asc";
    while (switching) {
      switching = false;
      rows = table.rows;
      /* Начинаем сортировать с 1, потому что 1 это хэдер */
      for (i = 1; i < (rows.length - 1); i++) {
        shouldSwitch = false;
        x = rows[i].getElementsByTagName("TD")[n];
        y = rows[i + 1].getElementsByTagName("TD")[n];
        if (dir == "asc") {
          if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
            shouldSwitch = true; //меняем элементы местами
            break;
          }
        } else if (dir == "desc") {
          if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
            shouldSwitch = true;
            break;
          }
        }
      }
      if (shouldSwitch) {
        rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
        switching = true;
        switchcount ++;
      } else {
        if (switchcount == 0 && dir == "asc") { //меняем порядок сортировки для повторного клика
          dir = "desc";
          switching = true;
        }
      }
    }
  }