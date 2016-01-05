function addRow() {

    var myName = document.getElementById("name");
    var age = document.getElementById("age");
    var table = document.getElementById("myTableData");

    var rowCount = table.rows.length;
    var row = table.insertRow(rowCount);

    row.insertCell(0).innerHTML = '<input type="button" value = "Delete" onClick="Javacsript:deleteRow(this)">';
    row.insertCell(1).innerHTML = myName.value;
    row.insertCell(2).innerHTML = age.value;

}

function deleteRow(obj) {

    var index = obj.parentNode.parentNode.rowIndex;
    var table = document.getElementById("myTableData");
    table.deleteRow(index);
}

function addTable(dimension, filas, columnas) {

    var myTableDiv = document.getElementById("myDynamicTable");

    var table = document.createElement('TABLE');
    //table.border = '1';

    var tableBody = document.createElement('TBODY');
    table.appendChild(tableBody);
    // Filas
    for (var i = 0; i < filas; i++) {
        var tr = document.createElement('TR');
        tableBody.appendChild(tr);
        // Columnas
        for (var j = 0; j < columnas; j++) {
            var td = document.createElement('TD');
            td.width = '75';
            //td.appendChild(document.createTextNode("(" + j + "," + (i + 1) + ") (" + (j + 1) + "," + i + ")" + " imagen: " + dimension / filas + " " + dimension / columnas));
            var img = document.createElement('IMG');
            img.src = "imagen.php?x=" + (dimension / filas) + "&y=" + (dimension / columnas) + "&x1=" + j + "&y1=" + (i + 1) + "&x2=" + (j + 1) + "&y2=" + i;
            td.appendChild(img);
            tr.appendChild(td);
        }
    }
    myTableDiv.appendChild(table);
}

function load() {

    console.log("Page load finished");

}

function setColor() {
    var div = document.getElementById("inicio");
    var color = "#" + ((1 << 24) * Math.random() | 0).toString(16);
    div.setAttribute("style", "background-color: " + color + ";");
}