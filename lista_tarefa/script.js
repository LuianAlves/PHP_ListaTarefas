// ----- Editar
function editar(id, txt_tarefa) { // id recebido do form | txt_tarefa recuperar a tarefa dentro do novo input
    // Criar form de edição
    let form = document.createElement('form')
    form.action = 'index.php?pag=index&acao=atualizar'
    form.method = 'post'
    form.className = 'row'

    // Criar input para entrada do Texto
    let inputTarefa = document.createElement('input')
    inputTarefa.type = 'text'
    inputTarefa.name = 'tarefa'
    inputTarefa.className = 'col-9 form-control'
    inputTarefa.value = txt_tarefa // Recebe o parametro que contém toda a tarefa a ser corrigida

    // Criar um input hidden para guardar o id da tarefa
    let inputId = document.createElement('input')
    inputId.type = 'hidden' // Será invisivel
    inputId.name = 'id' // name do input invisivel sera id
    inputId.value = id // o valor desse input será o id recebido via parametro

    // Criar button para envio do form
    let button = document.createElement('button')
    button.type = 'submit'
    button.className = 'col-2 ml-2 btn btn-info btn-sm'
    button.innerHTML = 'Atualizar'

    // Incluindo o inputTarefa no forml
    form.appendChild(inputTarefa) // Transformando o form em [Pai] e inputTarefa em [Filho]

    // Incluindo o inputID invisivel no forml
    form.appendChild(inputId)

    // Incluindo o button no forml
    form.appendChild(button) // Transformando o form em [Pai] e button em [Filho]

    //teste
    // console.log(form)

    // Selecionar a div tarefa que corresponde a tarefa clicada
    let tarefa = document.getElementById('tarefa_' + id) // Selecionando a tarefa clicada e concatenando com o id recebido via parametro no editar(')

    // Limpar o texto da tarefa para inclusão do novo form
    tarefa.innerHTML = ''

    // Incluir form na Página || tarefa[0] significa que o form será o primeiro elemento filho dentro de tarefa
    tarefa.insertBefore(form, tarefa[0]) // Permite inserir um novo html em cima do html ja rederenizado, só será utilizado quando o elemento for selecionado
}

// ----- Remover
function remover(id) {
    location.href = 'index.php?pag=index&acao=remover&id=' + id;
}

// ----- MarcandoTarefa como  Realizada
function tarefaRealizada(id) {
    location.href = 'index.php?pag=index&acao=tarefaRealizada&id=' + id;
}