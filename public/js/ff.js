// Lista de palavras disponíveis para o modo solo, cada uma com um tema associado
const palavrasTemas = [
    { palavra: "ELEFANTE", tema: "Animal" },
    { palavra: "BRASIL", tema: "País" },
    { palavra: "COMPUTADOR", tema: "Tecnologia" },
    { palavra: "PIZZA", tema: "Comida" },
    { palavra: "LUA", tema: "Espaço" }
  ];

  // Variáveis globais do jogo
  let palavraSecreta = "";       // Armazena a palavra que o jogador deve adivinhar
  let tema = "";                 // Tema da palavra
  let letrasCorretas = [];       // Letras que o jogador acertou
  let letrasErradas = [];        // Letras ou palavras que o jogador errou

  // Inicia o modo solo, escolhendo uma palavra aleatória da lista
  function iniciarJogoSolo() {
    const sorteada = palavrasTemas[Math.floor(Math.random() * palavrasTemas.length)];
    palavraSecreta = sorteada.palavra;
    tema = sorteada.tema;
    iniciarJogo(); // Continua o fluxo para iniciar o jogo
  }

  // Exibe o formulário para o segundo jogador digitar a palavra e o tema
  function mostrarFormularioDoisJogadores() {
    document.getElementById("formDoisJogadores").classList.remove("d-none");
  }

  // Inicia o jogo no modo dois jogadores com a palavra digitada
  function iniciarJogoDoisJogadores() {
    const palavra = document.getElementById("palavraJogador").value.toUpperCase(); // Converte para maiúsculas
    const temaInput = document.getElementById("temaJogador").value;
    if (!palavra || !temaInput) return alert("Preencha a palavra e o tema!");

    palavraSecreta = palavra;
    tema = temaInput;
    iniciarJogo();
  }

  // Inicializa as variáveis e configura a interface do jogo
  function iniciarJogo() {
    letrasCorretas = [];
    letrasErradas = [];

    // Esconde seleções de modo e mostra o jogo
    document.getElementById("modoSelecao").classList.add("d-none");
    document.getElementById("formDoisJogadores").classList.add("d-none");
    document.getElementById("jogo").classList.remove("d-none");

    // Atualiza o tema na interface e limpa mensagens anteriores
    document.getElementById("temaAtual").textContent = tema;
    document.getElementById("mensagem").textContent = "";

    // Habilita o campo de entrada e foca nele
    document.getElementById("entrada").disabled = false;
    document.getElementById("entrada").focus();

    // Atualiza os elementos visuais do jogo
    atualizarEspacos();
    atualizarLetrasDigitadas();
    atualizarCanvas();
  }

  // Mostra os espaços da palavra com as letras corretas reveladas
  function atualizarEspacos() {
    const container = document.getElementById("espacos");
    container.innerHTML = ""; // Limpa conteúdo anterior

    for (let letra of palavraSecreta) {
      const span = document.createElement("span");
      span.textContent = letrasCorretas.includes(letra) ? letra : ""; // Mostra letra se acertada
      container.appendChild(span);
    }
  }

  // Processa a tentativa do jogador (letra ou palavra)
  function tentarLetra() {
    if (event) event.preventDefault(); // Impede o envio do formulário (recarregamento da página)

    const input = document.getElementById("entrada");
    const tentativa = input.value.toUpperCase().trim(); // Converte para maiúsculas e remove espaços
    input.value = ""; // Limpa o campo após a tentativa

    // Se não for uma letra ou palavra válida (somente A-Z), ignora
    if (!tentativa.match(/^[A-Z]+$/)) return;

    // Tentativa de palavra inteira
    if (tentativa.length > 1) {
      if (tentativa === palavraSecreta) {
        // Acertou a palavra inteira: adiciona todas as letras como corretas (sem duplicar)
        letrasCorretas = [...new Set(palavraSecreta)];
        atualizarEspacos();
        mostrarModal("🎉 Parabéns!", "Acertaste a palavra inteira!");
        desabilitarJogo();
      } else {
        // Palavra errada: conta como erro, mas não penaliza repetição
        if (!letrasErradas.includes(tentativa)) letrasErradas.push(tentativa);
        atualizarEstadoJogo();
      }
      return;
    }

    // Tentativa de uma letra
    const letra = tentativa;

    // Ignora se já foi tentada antes (acertada ou errada)
    if (letrasCorretas.includes(letra) || letrasErradas.includes(letra)) return;

    // Verifica se a letra está na palavra
    if (palavraSecreta.includes(letra)) {
      letrasCorretas.push(letra);
    } else {
      letrasErradas.push(letra);
    }

    atualizarEstadoJogo();
  }

  // Atualiza contadores, letras erradas, espaços e canvas
  function atualizarEstadoJogo() {
    document.getElementById("erros").textContent = letrasErradas.length;
    atualizarEspacos();
    atualizarLetrasEscritas();
    atualizarCanvas();
    verificarFimDeJogo();
  }

  // Atualiza a lista visível de letras e palavras erradas
  function atualizarLetrasEscritas() {
    document.getElementById("letrasEscritas").textContent = letrasErradas.join(", ");
  }

  // Verifica se o jogo foi vencido ou perdido
  function verificarFimDeJogo() {
    // Verifica se todas as letras da palavra foram adivinhadas
    const venceu = [...new Set(palavraSecreta)].every(l => letrasCorretas.includes(l));

    if (venceu) {
      mostrarModal("🎉 Parabéns!", "Venceste!");
      desabilitarJogo();
    } else if (letrasErradas.length >= 6) {
      mostrarModal("😢 Que pena!", `Perdeste! A palavra era "<strong>${palavraSecreta}</strong>".`);
      desabilitarJogo();
    }
  }

  // Mostra um modal de resultado (vitória ou derrota)
  function mostrarModal(titulo, mensagem) {
    document.getElementById("resultadoTitulo").textContent = titulo;
    document.getElementById("resultadoMensagem").innerHTML = mensagem;
    new bootstrap.Modal(document.getElementById("resultadoModal")).show();
  }

  // Desativa o campo de entrada após o fim do jogo
  function desabilitarJogo() {
    document.getElementById("entrada").disabled = true;
  }

  function desenharEstruturaForca(ctx) {
    ctx.strokeStyle = "#000";
    ctx.lineWidth = 2;

    ctx.beginPath();
    ctx.moveTo(10, 230); ctx.lineTo(190, 230); // base
    ctx.moveTo(50, 230); ctx.lineTo(50, 20);   // poste vertical
    ctx.lineTo(130, 20); ctx.lineTo(130, 40);  // parte superior e gancho
    ctx.stroke();
  }

  // Desenha a forca no canvas com base na quantidade de erros
  function atualizarCanvas() {
    const canvas = document.getElementById("forcaCanvas");
    const ctx = canvas.getContext("2d");
    ctx.clearRect(0, 0, canvas.width, canvas.height); // Limpa o canvas antes de redesenhar

    ctx.strokeStyle = "#000";
    ctx.lineWidth = 2;

    // Estrutura da forca (base, poste, topo, gancho)
    ctx.beginPath();
    ctx.moveTo(10, 230); ctx.lineTo(190, 230); // base
    ctx.moveTo(50, 230); ctx.lineTo(50, 20);   // poste vertical
    ctx.lineTo(130, 20); ctx.lineTo(130, 40);  // parte superior
    ctx.stroke();

    // Desenha partes do boneco conforme o número de erros
    if (letrasErradas.length >= 1) { // Cabeça
        // Inicia o desenho da cabeça
        ctx.beginPath();
        // Desenha um círculo (a cabeça) com centro em (130, 55) e raio 15
        ctx.arc(130, 55, 15, 0, Math.PI * 2);
        // Finaliza o desenho da linha/círculo
        ctx.stroke();
      }

      if (letrasErradas.length >= 2) { // Tronco
        // Inicia o desenho do tronco
        ctx.beginPath();
        // Move o ponto de início para (130, 70), abaixo da cabeça
        ctx.moveTo(130, 70);
        // Desenha uma linha do ponto (130, 70) até (130, 120), formando o tronco
        ctx.lineTo(130, 120);
        // Finaliza o desenho da linha
        ctx.stroke();
      }

      if (letrasErradas.length >= 3) { // Braço esquerdo
        // Inicia o desenho do braço esquerdo
        ctx.beginPath();
        // Move o ponto de início para (130, 80), logo abaixo da cabeça
        ctx.moveTo(130, 80);
        // Desenha uma linha do ponto (130, 80) até (110, 100), formando o braço esquerdo
        ctx.lineTo(110, 100);
        // Finaliza o desenho da linha
        ctx.stroke();
      }

      if (letrasErradas.length >= 4) { // Braço direito
        // Inicia o desenho do braço direito
        ctx.beginPath();
        // Move o ponto de início para (130, 80), o mesmo local do braço esquerdo
        ctx.moveTo(130, 80);
        // Desenha uma linha do ponto (130, 80) até (150, 100), formando o braço direito
        ctx.lineTo(150, 100);
        // Finaliza o desenho da linha
        ctx.stroke();
      }

      if (letrasErradas.length >= 5) { // Perna esquerda
        // Inicia o desenho da perna esquerda
        ctx.beginPath();
        // Move o ponto de início para (130, 120), logo abaixo do tronco
        ctx.moveTo(130, 120);
        // Desenha uma linha da posição (130, 120) até (110, 150), formando a perna esquerda
        ctx.lineTo(110, 150);
        // Finaliza o desenho da linha
        ctx.stroke();
      }

      if (letrasErradas.length >= 6) { // Perna direita
        // Inicia o desenho da perna direita
        ctx.beginPath();
        // Move o ponto de início para (130, 120), mesma posição da perna esquerda
        ctx.moveTo(130, 120);
        // Desenha uma linha da posição (130, 120) até (150, 150), formando a perna direita
        ctx.lineTo(150, 150);
        // Finaliza o desenho da linha
        ctx.stroke();
      }

  }
 // Lista de palavras disponíveis para o modo solo, cada uma com um tema associado
const palavrasTemas = [
    { palavra: "ELEFANTE", tema: "Animal" },
    { palavra: "BRASIL", tema: "País" },
    { palavra: "COMPUTADOR", tema: "Tecnologia" },
    { palavra: "PIZZA", tema: "Comida" },
    { palavra: "LUA", tema: "Espaço" }
  ];

  // Variáveis globais do jogo
  let palavraSecreta = "";       // Armazena a palavra que o jogador deve adivinhar
  let tema = "";                 // Tema da palavra
  let letrasCorretas = [];       // Letras que o jogador acertou
  let letrasErradas = [];        // Letras ou palavras que o jogador errou

  // Inicia o modo solo, escolhendo uma palavra aleatória da lista
  function iniciarJogoSolo() {
    const sorteada = palavrasTemas[Math.floor(Math.random() * palavrasTemas.length)];
    palavraSecreta = sorteada.palavra;
    tema = sorteada.tema;
    iniciarJogo(); // Continua o fluxo para iniciar o jogo
  }

  // Exibe o formulário para o segundo jogador digitar a palavra e o tema
  function mostrarFormularioDoisJogadores() {
    document.getElementById("formDoisJogadores").classList.remove("d-none");
  }

  // Inicia o jogo no modo dois jogadores com a palavra digitada
  function iniciarJogoDoisJogadores() {
    const palavra = document.getElementById("palavraJogador").value.toUpperCase(); // Converte para maiúsculas
    const temaInput = document.getElementById("temaJogador").value;
    if (!palavra || !temaInput) return alert("Preencha a palavra e o tema!");

    palavraSecreta = palavra;
    tema = temaInput;
    iniciarJogo();
  }

  // Inicializa as variáveis e configura a interface do jogo
  function iniciarJogo() {
    letrasCorretas = [];
    letrasErradas = [];

    // Esconde seleções de modo e mostra o jogo
    document.getElementById("modoSelecao").classList.add("d-none");
    document.getElementById("formDoisJogadores").classList.add("d-none");
    document.getElementById("jogo").classList.remove("d-none");

    // Atualiza o tema na interface e limpa mensagens anteriores
    document.getElementById("temaAtual").textContent = tema;
    document.getElementById("mensagem").textContent = "";

    // Habilita o campo de entrada e foca nele
    document.getElementById("entrada").disabled = false;
    document.getElementById("entrada").focus();

    // Atualiza os elementos visuais do jogo
    atualizarEspacos();
    atualizarLetrasDigitadas();
    atualizarCanvas();
  }

  // Mostra os espaços da palavra com as letras corretas reveladas
  function atualizarEspacos() {
    const container = document.getElementById("espacos");
    container.innerHTML = ""; // Limpa conteúdo anterior

    for (let letra of palavraSecreta) {
      const span = document.createElement("span");
      span.textContent = letrasCorretas.includes(letra) ? letra : ""; // Mostra letra se acertada
      container.appendChild(span);
    }
  }

  // Processa a tentativa do jogador (letra ou palavra)
  function tentarLetra() {
    if (event) event.preventDefault(); // Impede o envio do formulário (recarregamento da página)

    const input = document.getElementById("entrada");
    const tentativa = input.value.toUpperCase().trim(); // Converte para maiúsculas e remove espaços
    input.value = ""; // Limpa o campo após a tentativa

    // Se não for uma letra ou palavra válida (somente A-Z), ignora
    if (!tentativa.match(/^[A-Z]+$/)) return;

    // Tentativa de palavra inteira
    if (tentativa.length > 1) {
      if (tentativa === palavraSecreta) {
        // Acertou a palavra inteira: adiciona todas as letras como corretas (sem duplicar)
        letrasCorretas = [...new Set(palavraSecreta)];
        atualizarEspacos();
        mostrarModal("🎉 Parabéns!", "Acertaste a palavra inteira!");
        desabilitarJogo();
      } else {
        // Palavra errada: conta como erro, mas não penaliza repetição
        if (!letrasErradas.includes(tentativa)) letrasErradas.push(tentativa);
        atualizarEstadoJogo();
      }
      return;
    }

    // Tentativa de uma letra
    const letra = tentativa;

    // Ignora se já foi tentada antes (acertada ou errada)
    if (letrasCorretas.includes(letra) || letrasErradas.includes(letra)) return;

    // Verifica se a letra está na palavra
    if (palavraSecreta.includes(letra)) {
      letrasCorretas.push(letra);
    } else {
      letrasErradas.push(letra);
    }

    atualizarEstadoJogo();
  }

  // Atualiza contadores, letras erradas, espaços e canvas
  function atualizarEstadoJogo() {
    document.getElementById("erros").textContent = letrasErradas.length;
    atualizarEspacos();
    atualizarLetrasEscritas();
    atualizarCanvas();
    verificarFimDeJogo();
  }

  // Atualiza a lista visível de letras e palavras erradas
  function atualizarLetrasEscritas() {
    document.getElementById("letrasEscritas").textContent = letrasErradas.join(", ");
  }

  // Verifica se o jogo foi vencido ou perdido
  function verificarFimDeJogo() {
    // Verifica se todas as letras da palavra foram adivinhadas
    const venceu = [...new Set(palavraSecreta)].every(l => letrasCorretas.includes(l));

    if (venceu) {
      mostrarModal("🎉 Parabéns!", "Venceste!");
      desabilitarJogo();
    } else if (letrasErradas.length >= 6) {
      mostrarModal("😢 Que pena!", `Perdeste! A palavra era "<strong>${palavraSecreta}</strong>".`);
      desabilitarJogo();
    }
  }

  // Mostra um modal de resultado (vitória ou derrota)
  function mostrarModal(titulo, mensagem) {
    document.getElementById("resultadoTitulo").textContent = titulo;
    document.getElementById("resultadoMensagem").innerHTML = mensagem;
    new bootstrap.Modal(document.getElementById("resultadoModal")).show();
  }

  // Desativa o campo de entrada após o fim do jogo
  function desabilitarJogo() {
    document.getElementById("entrada").disabled = true;
  }

  function desenharEstruturaForca(ctx) {
    ctx.strokeStyle = "#000";
    ctx.lineWidth = 2;

    ctx.beginPath();
    ctx.moveTo(10, 230); ctx.lineTo(190, 230); // base
    ctx.moveTo(50, 230); ctx.lineTo(50, 20);   // poste vertical
    ctx.lineTo(130, 20); ctx.lineTo(130, 40);  // parte superior e gancho
    ctx.stroke();
  }

  // Desenha a forca no canvas com base na quantidade de erros
  function atualizarCanvas() {
    const canvas = document.getElementById("forcaCanvas");
    const ctx = canvas.getContext("2d");
    ctx.clearRect(0, 0, canvas.width, canvas.height); // Limpa o canvas antes de redesenhar

    ctx.strokeStyle = "#000";
    ctx.lineWidth = 2;

    // Estrutura da forca (base, poste, topo, gancho)
    ctx.beginPath();
    ctx.moveTo(10, 230); ctx.lineTo(190, 230); // base
    ctx.moveTo(50, 230); ctx.lineTo(50, 20);   // poste vertical
    ctx.lineTo(130, 20); ctx.lineTo(130, 40);  // parte superior
    ctx.stroke();

    // Desenha partes do boneco conforme o número de erros
    if (letrasErradas.length >= 1) { // Cabeça
        // Inicia o desenho da cabeça
        ctx.beginPath();
        // Desenha um círculo (a cabeça) com centro em (130, 55) e raio 15
        ctx.arc(130, 55, 15, 0, Math.PI * 2);
        // Finaliza o desenho da linha/círculo
        ctx.stroke();
      }

      if (letrasErradas.length >= 2) { // Tronco
        // Inicia o desenho do tronco
        ctx.beginPath();
        // Move o ponto de início para (130, 70), abaixo da cabeça
        ctx.moveTo(130, 70);
        // Desenha uma linha do ponto (130, 70) até (130, 120), formando o tronco
        ctx.lineTo(130, 120);
        // Finaliza o desenho da linha
        ctx.stroke();
      }

      if (letrasErradas.length >= 3) { // Braço esquerdo
        // Inicia o desenho do braço esquerdo
        ctx.beginPath();
        // Move o ponto de início para (130, 80), logo abaixo da cabeça
        ctx.moveTo(130, 80);
        // Desenha uma linha do ponto (130, 80) até (110, 100), formando o braço esquerdo
        ctx.lineTo(110, 100);
        // Finaliza o desenho da linha
        ctx.stroke();
      }

      if (letrasErradas.length >= 4) { // Braço direito
        // Inicia o desenho do braço direito
        ctx.beginPath();
        // Move o ponto de início para (130, 80), o mesmo local do braço esquerdo
        ctx.moveTo(130, 80);
        // Desenha uma linha do ponto (130, 80) até (150, 100), formando o braço direito
        ctx.lineTo(150, 100);
        // Finaliza o desenho da linha
        ctx.stroke();
      }

      if (letrasErradas.length >= 5) { // Perna esquerda
        // Inicia o desenho da perna esquerda
        ctx.beginPath();
        // Move o ponto de início para (130, 120), logo abaixo do tronco
        ctx.moveTo(130, 120);
        // Desenha uma linha da posição (130, 120) até (110, 150), formando a perna esquerda
        ctx.lineTo(110, 150);
        // Finaliza o desenho da linha
        ctx.stroke();
      }

      if (letrasErradas.length >= 6) { // Perna direita
        // Inicia o desenho da perna direita
        ctx.beginPath();
        // Move o ponto de início para (130, 120), mesma posição da perna esquerda
        ctx.moveTo(130, 120);
        // Desenha uma linha da posição (130, 120) até (150, 150), formando a perna direita
        ctx.lineTo(150, 150);
        // Finaliza o desenho da linha
        ctx.stroke();
      }

  }
