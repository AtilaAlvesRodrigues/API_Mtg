@extends('layouts.layout')

@section('title', 'Cartas de Magic: The Gathering - 10ª Edição')

@section('content')
    <!-- Logo -->
    <div class="logo-container text-center my-3">
        <a href="/">
            <img src="{{ asset('images/logo_Magic.jpg') }}" alt="Magic: The Gathering Logo" class="img-fluid" />
        </a>
        <!-- Botão de Login -->
        <a href="/login" class="btn btn-primary" style="position: absolute; top: 10px; right: 10px;">
            Login
        </a>
        <!-- Botão para mudar o tema -->
        <div style="position: absolute; top: 10px; left: 10px;">
            <button id="theme-toggle-btn-top-left" class="btn theme-toggle-trigger" title="Alternar tema"
                style="background: none; border: none; padding: 0; width: 40px; height: 40px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; transition: transform 0.3s ease;"
                onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">
                <!-- Ícone será carregado por theme-toggle.js -->
            </button>
        </div>
    </div>

    <h1 class="text-center mb-4">Cartas de Magic: The Gathering - 10ª Edição</h1>

    <!-- Barra de pesquisa -->
    <div class="search-bar">
        <input type="text" class="form-control mb-2" id="searchName" placeholder="Pesquisar por Nome da Carta">
        <input type="text" class="form-control mb-2" id="searchManaCost" placeholder="Pesquisar por Custo de Mana">

        <select class="form-control mb-2" id="searchKeyword">
            <option value="">Pesquisar por Palavra-chave</option>
            <option value="Deathtouch">Deathtouch</option>
            <option value="Defender">Defender</option>
            <option value="Double Strike">Double Strike</option>
            <option value="Equip">Equip</option>
            <option value="First strike">First strike</option>
            <option value="Flash">Flash</option>
            <option value="Flying">Flying</option>
            <option value="Haste">Haste</option>
            <option value="Hexproof">Hexproof</option>
            <option value="Indestructible">Indestructible</option>
            <option value="Lifelink">Lifelink</option>
            <option value="Menace">Menace</option>
            <option value="Protection">Protection</option>
            <option value="Reach">Reach</option>
            <option value="Trample">Trample</option>
            <option value="Vigilance">Vigilance</option>
            <option value="Ward">Ward</option>
        </select>

        <select class="form-control mb-2" id="searchType">
            <option value="">Pesquisar por Tipo da Carta</option>
            <option value="Artifact">Artefato</option>
            <option value="Creature">Criatura</option>
            <option value="Enchantment">Encantamento</option>
            <option value="Sorcery">Feitiço</option>
            <option value="Instant">Mágica Instantânea</option>
            <option value="Planeswalker">Planeswalker</option>
            <option value="Land">Terreno</option>
        </select>

        <select class="form-control mb-2" id="searchColor">
            <option value="">Pesquisar por Cor da Carta</option>
            <option value="w">Branco 🟡</option>
            <option value="u">Azul 🔵</option>
            <option value="b">Preto ⚫</option>
            <option value="r">Vermelho 🔴</option>
            <option value="g">Verde 🟢</option>
            <option value="colorless">Incolor ⚪</option>
        </select>
    </div>

    <div class="text-center mt-3">
        <button id="clearFilters" class="btn btn-danger">Limpar Filtros</button>
    </div>

    <div id="cardContainer" class="card-container mt-4">
        <!-- Cards serão inseridos aqui via JS -->
    </div>

    <div class="d-flex justify-content-center mt-4">
        <nav aria-label="Page navigation
                ::contentReference[oaicite:0]{index=0}
                 
