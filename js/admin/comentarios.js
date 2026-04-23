let indexSubtitulo = 0;

function adicionarSubtitulo() {

    let container = document.getElementById("conteudo");

    let html = `
        <div class="subtitulo-bloco">

            <input class="input-subtitulo" type="text" name="subtitulos[${indexSubtitulo}][titulo]" placeholder="Subtítulo">

            <div class="textos"></div>

            <button class="btn-adc-texto-img" type="button" onclick="adicionarTexto(this, ${indexSubtitulo})">
                + Texto
            </button>

            <button class="btn-adc-texto-img" type="button" onclick="adicionarImagem(this, ${indexSubtitulo})">
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
        <textarea class="texto" name="subtitulos[${index}][textos][]" placeholder="Digite o texto"></textarea>
    `;

    bloco.insertAdjacentHTML("beforeend", html);
}

function adicionarImagem(botao, index) {

    let bloco = botao.parentElement.querySelector(".textos");

    let html = `
        <input type="file" class="input-img" name="subtitulos[${index}][imagens][]" accept="image/*">
    `;

    bloco.insertAdjacentHTML("beforeend", html);
}
