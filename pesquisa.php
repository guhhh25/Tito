<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesquisar Pessoas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container">
    <h2>Pesquisar Pessoas</h2>

    <form id="formPesquisa" method="GET">
        <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" class="form-control" id="nome" name="nome">
        </div>
        <div class="form-group">
            <label for="data">Data de Nascimento:</label>
            <input type="date" class="form-control" id="data" name="data">
        </div>
        <div class="form-group">
            <label for="cidade">Cidade:</label>
            <select class="form-control" id="cidade" name="cidade">
            <?php include 'buscar_cidades.php'; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Pesquisar</button>
    </form>



    <div class="mt-4">
        <h3>Resultados da Pesquisa</h3>
        <table id="tabelaResultados" class="table">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Idade</th>
                    <th>Data de Nascimento</th>
                    <th>Cidade</th>
                </tr>
            </thead>
            <tbody>
    
            </tbody>
        </table>


        <button type="button" class="btn btn-success" id="btnGerarExcel">Baixar Excel</button>
        <button type="button" class="btn btn-secondary" id="btnGerarTxt">Baixar txt</button>
        <button type="button" class="btn btn-danger" id="btnGerarPdf">Baixar Pdf</button>
    </div>
    </div>

</div>

</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="/fazerPesquisa.js"></script>
<script src="/gerarExcel.js"></script>
<script src="/gerarTxt.js"></script>
<script src="/gerarPdf.js"></script>
</body>
</html>