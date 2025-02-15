<?php 
     if(!isset($_SESSION)) {
        session_start();
        $authUsuario = $_SESSION["authUsuario"];
        
    }
    if (isset($_SESSION["authUsuario"])) {
        header("Location: ../Home/index.php");
        exit(); // Encerra o script para garantir que o redirecionamento funcione
    }
    
    require_once (__DIR__.'../../DAO/comandaProdutoDAO.php'); 
    if(isset($authUsuario)){
        $comandaProdutos = ComandaProdutoDAO::showById($authUsuario['id']);
    }else{
        $comandaProdutos = "";
    }


?>


<header class="bg-light py-3 shadow-sm sticky-top">
    <div class="container d-flex justify-content-between align-items-center">
        <!-- Logo -->
        <a href="../Home/" class="navbar-brand d-flex align-items-center text-dark fw-bold" aria-label="Loja de Material Escolar">
            <img src="../../img/Logo.png" alt="Logo" class="me-2 position-absolute" style="height: 90px;">
        </a>

        <!-- Menu de navegação -->
         
        <nav>
            <ul class="nav">
                <li class="nav-item"><a href="../Home/" class="nav-link text-dark">Home</a></li>
                <li class="nav-item"><a href="../Produtos/totalProdutos.php" class="nav-link text-dark">Produtos</a></li>
                <li class="nav-item"><a href="../Home/#sobre" class="nav-link text-dark">Sobre Nós</a></li>
                <li class="nav-item"><a href="https://api.whatsapp.com/send/?phone=5511971233824&text&type=phone_number&app_absent=0" class="nav-link text-dark">Contato</a></li>
                <!-- Ícone de lupa -->
               <li class="nav-item">
                    <a href="../Produtos/totalProdutos.php"  class="nav-link text-dark" aria-label="Buscar produtos">
                        <i class="fas fa-search"></i>
                    </a>
                </li>
                <!-- Ícone de perfil -->
                <li class="nav-item">
                    <a href="#" class="nav-link text-dark" id="profile-icon" aria-label="Perfil do usuário">
                        <i class="fas fa-user-circle"></i>
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Barra de pesquisa (oculta inicialmente) -->
        <div id="search-bar" class="container position-absolute" style="display: none; top: 10px; right: 0; padding-top: 70px; width: 300px;">
            <form class="form"action="../Produtos/totalProdutos.php" style="width: 100%;">
                <label for="search" style="width: 100%;">
                    <input required="" autocomplete="off" placeholder="Pesquise " id="search" type="text" style="width: 100%;">
                    <div class="icon">
                        <svg stroke-width="2" stroke="currentColor" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="swap-on">
                            <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" stroke-linejoin="round" stroke-linecap="round"></path>
                        </svg>
                        <svg stroke-width="2" stroke="currentColor" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="swap-off">
                            <path d="M10 19l-7-7m0 0l7-7m-7 7h18" stroke-linejoin="round" stroke-linecap="round"></path>
                        </svg>
                    </div>
                    <button type="reset" class="close-btn me-5">
                        <svg viewBox="0 0 20 20" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg">
                            <path clip-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" fill-rule="evenodd"></path>
                        </svg>
                    </button>
                </label>
            </form>
        </div>
    </div>
</header>

<!-- Modal Perfil -->
<div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="profileModalLabel">Perfil do Usuário</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Conteúdo do perfil -->
        <p>Bem-vindo ao seu perfil. Realize login ou logout!</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
        <a href="../Login/">
            <button type="button" class="btn btn-primary">Login</button>
        </a>
      </div>
    </div>
  </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', () => {
   
    const profileIcon = document.getElementById('profile-icon');

    // Exibe o modal do perfil ao clicar no ícone de perfil
    profileIcon.addEventListener('click', function () {
        const profileModal = new bootstrap.Modal(document.getElementById('profileModal'));
        profileModal.show();
    });
});
</script>
