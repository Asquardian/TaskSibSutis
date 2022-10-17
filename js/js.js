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
    var table, rows, x, y, dir, switchcount = false;
    table = document.getElementById("userRequestsTable");
    switching = true;
    // Узнаем в какую сторону сортировать
    dir = "asc";
    rows = table.rows;
    for (let j = 1; j < (rows.length); j++) {
      minMax = j;
      x = rows[j].getElementsByTagName("TD")[n];
      /* Начинаем сортировать с 1, потому что 1 это хэдер */
      for (let i = j; i < (rows.length); i++) {
        y = rows[i].getElementsByTagName("TD")[n];

        if (dir == "asc") {
          if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
            minMax = i; //меняем элементы местами
            x = y;
            switchcount = true;
          }
        } else if (dir == "desc") {
          if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
            minMax = i; //меняем элементы местами
            x = y;
            switchcount = true;
          }
        }
      }
      if(switchcount){
        rows[j].parentNode.insertBefore(rows[minMax], rows[j]);
      }else{
        if (!switchcount && dir == "asc") { //меняем порядок сортировки для повторного клика
          dir = "desc";
        }
        else { //меняем порядок сортировки для повторного клика
          dir = "asc";
        }
        j = 0;
      }
    }
  }
