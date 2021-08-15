<?php 
	$acao = 'recuperarTarefasPendentes'; // Criando essa variavel em cima do require fará com que ela esteja disponivel no require
	require 'tarefa_controller.php';
?>

<!-- Incluindo o Header -->
<?php require('includes/header.php'); ?>

	<body>
		<div class="container app">
			<div class="row">
				<div class="col-md-3 menu">
					<ul class="list-group">
						<li class="list-group-item active"><a href="#">Tarefas pendentes</a></li>
						<li class="list-group-item"><a href="nova_tarefa.php">Nova tarefa</a></li>
						<li class="list-group-item"><a href="todas_tarefas.php">Todas tarefas</a></li>
					</ul>
				</div>

				<div class="col-md-9">
					<div class="container pagina">
						<div class="row">
							<div class="col">
								<h4>Tarefas pendentes</h4>
								<hr />

								<?php foreach ($tarefas as $indices => $tarefa) { ?>

										<div class="row mb-3 d-flex align-items-center tarefa">

											<div class="col-sm-9" id="tarefa_<?= $tarefa->id ?>"> <!-- Adicionar um ID concatenado com o id da tarefa para acessar essa div pelo script JS -->
													<?= $tarefa->tarefa ?> 
											</div> 
											<div class="col-sm-3 mt-2 d-flex justify-content-between">
												<!-- Remover Utilizando o JS || Utilizar como parametro o id da tarefa [ou id da div] -->
												<a href="#"><i class="fas fa-trash-alt fa-lg text-danger" onclick="remover(<?= $tarefa->id ?>)"></i></a>
												<!-- Edição Utilizando o JS || Utilizar como parametro o id da tarefa [ou id da div] -->
												<a href="#"><i class="fas fa-edit fa-lg text-info" onclick="editar(<?= $tarefa->id ?>, '<?= $tarefa->tarefa ?>')"></i></a>  <!-- Primeiro parametro o id da tarefa, Segundo parametro entra a propria tarefa para correção -->
												<!-- Marcando as Tarefas como Realizadas || Utilizar como parametro o id da tarefa [ou id da div] -->
												<a href="#"><i class="fas fa-check-square fa-lg text-success" onclick="tarefaRealizada(<?= $tarefa->id ?>)"></i></a>										
											</div>
										</div>										

								<?php } ?>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
