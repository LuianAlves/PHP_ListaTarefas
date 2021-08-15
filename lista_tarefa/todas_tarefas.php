
<?php 
	$acao = 'recuperar'; // Criando essa variavel em cima do require fará com que ela esteja disponivel no require
	require 'tarefa_controller.php';
	
	// echo '<pre>'; print_r($tarefas); echo '</pre>'; // Este trecho mostra a variavel $tarefas que só pertece ao bloco recuperar
?>

<!-- Incluindo o Header -->
<?php require('includes/header.php'); ?>

	<body>
		<div class="container app">
			<div class="row">
				<div class="col-sm-3 menu">
					<ul class="list-group">
						<li class="list-group-item"><a href="index.php">Tarefas pendentes</a></li>
						<li class="list-group-item"><a href="nova_tarefa.php">Nova tarefa</a></li>
						<li class="list-group-item active"><a href="#">Todas tarefas</a></li>
					</ul>
				</div>

				<div class="col-sm-9">
					<div class="container pagina">
						<div class="row">
							<div class="col">
								<h4>Todas tarefas</h4>
								<hr />
								<!-- Tornando as informações dinamicas -->
								<?php 
									// Irá percorrer a variavel $tarefas recuperando os $indices e em seguida acessar cada uma das tarefas [$tarefa]
									foreach($tarefas as $indices => $tarefa) {	?>		
										
										<!-- Após acessar o objeto [$tarefa] irá acessar todos os atributos [tarefa, id_status {Após o left join o id_status agora é s.status mas aqui podemos colocar apenas status} ...] -->
										<div class="row mb-3 d-flex align-items-center tarefa">
											<div class="col-sm-9" id="tarefa_<?= $tarefa->id ?>"> <!-- Adicionar um ID concatenado com o id da tarefa para acessar essa div pelo script JS -->
												<?= $tarefa->tarefa ?> 

													<!-- Atribuindo Cores caso seja Pendente ou Realizada -->
													<?php if ($tarefa->status == 'Tarefa Pendente') { ?>
														<p class="text-danger font-weight-bold"> <?= $tarefa->status ?></p>
													<?php } else { ?> 
														<p class="text-success font-weight-bold"> <?= $tarefa->status ?></p>
													<?php } ?>

											</div> 
											<div class="col-sm-3 mt-2 d-flex justify-content-between">
												<!-- Remover Utilizando o JS || Utilizar como parametro o id da tarefa [ou id da div] -->
												<a href="#"><i class="fas fa-trash-alt fa-lg text-danger" onclick="remover(<?= $tarefa->id ?>)"></i></a>
												
												<!-- Adicionando codição para MOstrar só se a tarefa for pendente -->
												<?php if ($tarefa->status == 'Tarefa Pendente') { ?>
													<!-- Edição Utilizando o JS || Utilizar como parametro o id da tarefa [ou id da div] -->
													<a href="#"><i class="fas fa-edit fa-lg text-info" onclick="editar(<?= $tarefa->id ?>, '<?= $tarefa->tarefa ?>')"></i></a>  <!-- Primeiro parametro o id da tarefa, Segundo parametro entra a propria tarefa para correção -->
													<!-- Marcando as Tarefas como Realizadas || Utilizar como parametro o id da tarefa [ou id da div] -->
													<a href="#"><i class="fas fa-check-square fa-lg text-success" onclick="tarefaRealizada(<?= $tarefa->id ?>)"></i></a>										
												<?php } ?>

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
