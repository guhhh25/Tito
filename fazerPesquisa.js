document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('formPesquisa').addEventListener('submit', function(event) {
        event.preventDefault();
        var formulario = new FormData(this);

        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'pesquisar_items.php');
        xhr.onload = function() {
            if (xhr.status === 200) {
                var filtro = extrairFiltroFormulario();
                console.log(filtro)
                renderizarTabela(xhr.responseText, filtro);
                console.log(xhr.responseText)
            } else {
                console.log("erro")
            }
        };
        xhr.onerror = function() {
            console.error('Erro de rede ao enviar requisição.');
        };
        xhr.send(formulario);
    });

    function extrairFiltroFormulario() {
        let nome = document.getElementById('nome').value;
        let data = document.getElementById('data').value;
        let cidadeSelect = document.getElementById('cidade');
        let cidadeSelecionada = cidadeSelect.options[cidadeSelect.selectedIndex].textContent; 
        let cidadePadrao = "Selecione a cidade";
        return { nome: nome, data: data, cidade: cidadeSelecionada != cidadePadrao ? cidadeSelecionada : "" };
    }

    function renderizarTabela(response, filtro) {
 
        let tabelaResultados = document.getElementById('tabelaResultados');
        tabelaResultados.innerHTML = '';

      
        let pessoas = JSON.parse(response);

        console.log(pessoas)

   
        let thead = tabelaResultados.createTHead();
        let row = thead.insertRow();
        let headers = ["Nome", "Idade", "Data de Nascimento", "Cidade"];


        for (var i = 0; i < headers.length; i++) {
            var th = document.createElement("th");
            var text = document.createTextNode(headers[i]);
            th.appendChild(text);
            row.appendChild(th);
        }

        let mostrarBtn = false;

        pessoas.forEach(function(pessoa) {

            if (filtro.nome && !pessoa.Nome.toLowerCase().includes(filtro.nome.toLowerCase())) {
                return;
            }
            if (filtro.data && pessoa.DataNascimento.toLowerCase() !== filtro.data.toLowerCase()) {
                return;
            }
            if (filtro.cidade && pessoa.NomeCidade.toLowerCase() !== filtro.cidade.toLowerCase()) {
                return;
            }

            mostrarBtn = true;
            

            let newRow = tabelaResultados.insertRow();

            let dataNascimento = new Date(pessoa.DataNascimento);
            let dataFormatada = dataNascimento.toLocaleDateString('pt-BR');

            newRow.insertCell(0).appendChild(document.createTextNode(pessoa.Nome));
            newRow.insertCell(1).appendChild(document.createTextNode(pessoa.Idade));
            newRow.insertCell(2).appendChild(document.createTextNode(dataFormatada));
            newRow.insertCell(3).appendChild(document.createTextNode(pessoa.NomeCidade));
        });

        if(mostrarBtn){
            document.getElementById('btnGerarExcel').removeAttribute('hidden');
        }
        
        console.log(pessoas)
    }
});