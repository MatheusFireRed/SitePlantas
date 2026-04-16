let indexSubtitulo = 0;

function adicionarSubtitulo() {

    let container = document.getElementById("conteudo");

    let html = `
        <div class="subtitulo-bloco">

            <input type="text" name="subtitulos[${indexSubtitulo}][titulo]" placeholder="Subtítulo">

            <div class="textos"></div>

            <button type="button" onclick="adicionarTexto(this, ${indexSubtitulo})">
                + Texto
            </button>

            <button type="button" onclick="adicionarImagem(this, ${indexSubtitulo})">
                + Imagem
            </button>

            <hr>
        </div>
    `;

    container.insertAdjacentHTML("beforeend", html);

    indexSubtitulo++;
}

function adicionarTexto(botao, index) {

    let bloco = botao.parentElement.querySelector(".textos");

    let html = `
        <textarea name="subtitulos[${index}][textos][]" placeholder="Digite o texto"></textarea>
    `;

    bloco.insertAdjacentHTML("beforeend", html);
}

function adicionarImagem(botao, index) {

    let bloco = botao.parentElement.querySelector(".textos");

    let html = `
        <input type="text" name="subtitulos[${index}][imagens][]" placeholder="URL da imagem">
    `;

    bloco.insertAdjacentHTML("beforeend", html);
}
