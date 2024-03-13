document.getElementById('btnGerarPdf').addEventListener('click', function() {
    var tableData = [];
    var tableRows = document.querySelectorAll('#tabelaResultados tr');
    tableRows.forEach(function(row) {
        var rowData = [];
        row.querySelectorAll('td').forEach(function(cell) {
            rowData.push(cell.textContent);
        });
        tableData.push(rowData);
    });

 
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'gerar_pdf.php', true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.responseType = 'blob'; 
    xhr.onload = function() {
        if (xhr.status === 200) {
            var blob = new Blob([xhr.response], { type: 'application/pdf' });
            var link = document.createElement('a');
            link.href = window.URL.createObjectURL(blob);
            link.download = 'dados.pdf';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        } else {
            console.error('Erro ao gerar o arquivo PDF.');
        }
    };
  
    xhr.send(JSON.stringify(tableData));
});