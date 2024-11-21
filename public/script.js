async function registrarJogo() {
    const jogo = {
        nome: document.getElementById('nome').value,
        descricao: document.getElementById('descricao').value,
        preco: document.getElementById('preco').value,
        id_jogo: document.getElementById('id_jogo').value,
        ano: document.getElementById('ano').value,
    };

    let data = await fetch("http://localhost:8080/src/api/jogos", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(jogo)
    }).then(resp => resp.text());
}

async function fetchJogos() {
    let jogos = await fetch(`http://localhost:8080/src/api/jogos`, {
        method: "GET",
    }).then(response => response);
    return jogos.json();
}

async function fetchJogo(id) {
    let jogo = await fetch(`http://localhost:8080/src/api/jogos?id=${id}`, {
        method: "GET",
    }).then(response => response);
    return jogo.json();
}

async function removeJogo(idJogo) {
    let data = await fetch("http://localhost:8080/src/api/jogos", {
        method: "DELETE",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({
            id_jogo: idJogo
        })
    }).then(resp => resp.text());
    window.location.reload();
}

async function carregarJogos() {
    const tabela = document.querySelector('#jogosTable tbody');
    tabela.innerHTML = '';
    let dados = await fetchJogos();
    dados.forEach((jogo) => {
        const linha = `<tr>
            <td>${jogo.id_jogo}</td>
            <td>${jogo.nome}</td>
            <td>${jogo.descricao}</td>
            <td>${jogo.preco}</td>
            <td>${jogo.ano}</td>
            <td><button onclick="removeJogo('${jogo.id_jogo}')">Deletar</button></td>
            <td><button onclick="window.location.href='/src/public/cadastrojogo.html?id=${jogo.id_jogo}'">Editar</button></td>
            <td><button onclick="window.location.href='/src/public/viewjogo.html?id=${jogo.id_jogo}'">Visualizar</button></td>
        </tr>`;
        tabela.innerHTML += linha;
    });
}

carregarJogos();

async function onUpdate() {
    let fromGet = new URLSearchParams(window.location.search);
    if (fromGet.size != 0) {
        let idJogo = fromGet.get("id");
        let jogoData = await fetchJogo(idJogo);
        document.getElementById('nome').value = jogoData["nome"];
        document.getElementById('descricao').value = jogoData["descricao"];
        document.getElementById('preco').value = jogoData["preco"];
        document.getElementById('id_jogo').value = jogoData["id_jogo"];
        document.getElementById('ano').value = jogoData["ano"];
    }
}

async function editarJogo(idJogo) {
    const jogo = {
        id_jogo: idJogo,
        nome: document.getElementById('nome').value,
        descricao: document.getElementById('descricao').value,
        preco: document.getElementById('preco').value,
        ano: document.getElementById('ano').value,
    };

    let data = await fetch("http://localhost:8080/src/api/jogos", {
        method: "PUT",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(jogo)
    }).then(resp => resp.text());
}

function detectarAcao() {
    let fromGet = new URLSearchParams(window.location.search);
    if (fromGet.size != 0) {
        editarJogo(fromGet.get("id"));
    } else {
        registrarJogo();
    }
}

onUpdate();
