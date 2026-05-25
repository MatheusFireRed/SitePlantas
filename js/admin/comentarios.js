let contadorSubtitulo = 0;

function adicionarSubtitulo() {

    let container = document.getElementById("conteudo");

    let html = `
        <div class="bloco-subtitulo">

            <input type="hidden" name="subtitulos[${contadorSubtitulo}][ordem]" value="${contadorSubtitulo}">

            <input type="text"
                   name="subtitulos[${contadorSubtitulo}][titulo]"
                   class="input-subtitulo"
                   placeholder="Subtítulo">

            <div class="textos"></div>

            <button type="button" class="btn-adc-texto-img"
                onclick="adicionarTexto(this, ${contadorSubtitulo})">
                + Texto
            </button>

            <button type="button" class="btn-adc-texto-img"
                onclick="adicionarImagem(this, ${contadorSubtitulo})">
                + Imagem
            </button>

        </div>
    `;

    container.insertAdjacentHTML("beforeend", html);

    contadorSubtitulo++;
}

function adicionarTexto(botao, index) {

    let container = botao.parentElement.querySelector(".textos");
    let ordem = container.children.length;

    let html = `
        <textarea 
            name="subtitulos[${index}][textos][${ordem}][conteudo]"
            class="texto"
            placeholder="Digite o texto..."></textarea>

        <input type="hidden"
            name="subtitulos[${index}][textos][${ordem}][ordem]"
            value="${ordem}">
    `;

    container.insertAdjacentHTML("beforeend", html);
}

function adicionarImagem(botao, index) {

    let container = botao.parentElement.querySelector(".textos");
    let ordem = container.children.length;

    let html = `
        <input type="file"
            name="subtitulos[${index}][imagens][${ordem}][arquivo]"
            class="input-img">

        <input type="hidden"
            name="subtitulos[${index}][imagens][${ordem}][ordem]"
            value="${ordem}">
    `;

    container.insertAdjacentHTML("beforeend", html);
}