
<!-- Incluindo o Header -->
<?php require('includes/header.php'); ?>

	<body>
		<?php
			// Testando se recebeu o parametro ?inclusao=1
			if( isset($_GET['inclusao']) && $_GET['inclusao'] == 1 ) {
			// Caso o retorno seja true, ou seja recebeu o parametro ?inclusao=1, entrará na condição e mostrará a div
		?>

		<!-- Cairá nessa div soment quando receber o parametro ?inclusao=1 após inserir uma nova tarefa -->
		<div class="bg-success pt-2 text-white d-flex justify-content-center">
			<h5>Tarefa inserida com sucesso!</h5>
		</div>

		<?php } // Fechamento da div para receber o codigo html ?>

		<div class="container app">
			<div class="row">
				<div class="col-md-3 menu">
					<ul class="list-group">
						<li class="list-group-item"><a href="index.php">Tarefas pendentes</a></li>
						<li class="list-group-item active"><a href="#">Nova tarefa</a></li>
						<li class="list-group-item"><a href="todas_tarefas.php">Todas tarefas</a></li>
					</ul>
				</div>

				<div class="col-md-9">
					<div class="container pagina">
						<div class="row">
							<div class="col">
								<h4>Nova tarefa</h4>
								<hr />

								<form method="post" action="tarefa_controller.php?acao=inserir"> <!-- Inserir o parametro ?acao=inserir para recebe-lo com o $_GET em tarefa_controller.php -->
									<div class="form-group">
										<label>Descrição da tarefa:</label>
										<input type="text" class="form-control" name="tarefa" placeholder="Exemplo: Lavar o carro">
									</div>

									<button class="btn btn-success">Cadastrar</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
