<?php
/**
 * Tablero de Ajedrez Interactivo con Drag & Drop
 * 
 * @author Aristóteles Quintanar <axzquint@gmail.com>
 * @license MIT License
 * 
 * MIT License
 * 
 * Copyright (c) 2025 Aristóteles Quintanar
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

// --- Definiciones en PHP (lado servidor) ---
$pieceSymbols = [
  "white" => [
    "king"   => "♔",
    "queen"  => "♕",
    "rook"   => "♖",
    "bishop" => "♗",
    "knight" => "♘",
    "pawn"   => "♙",
  ],
  "black" => [
    "king"   => "♚",
    "queen"  => "♛",
    "rook"   => "♜",
    "bishop" => "♝",
    "knight" => "♞",
    "pawn"   => "♟",
  ],
];

// Construimos el tablero inicial (8x8)
$initialBoard = [
  // Fila 8 (piezas negras)
  [
    ["type"=>"rook","color"=>"black"],
    ["type"=>"knight","color"=>"black"],
    ["type"=>"bishop","color"=>"black"],
    ["type"=>"queen","color"=>"black"],
    ["type"=>"king","color"=>"black"],
    ["type"=>"bishop","color"=>"black"],
    ["type"=>"knight","color"=>"black"],
    ["type"=>"rook","color"=>"black"],
  ],
  // Fila 7 (peones negros)
  array_fill(0, 8, ["type"=>"pawn","color"=>"black"]),
  // Filas 6-3 (vacías)
  array_fill(0, 8, null),
  array_fill(0, 8, null),
  array_fill(0, 8, null),
  array_fill(0, 8, null),
  // Fila 2 (peones blancos)
  array_fill(0, 8, ["type"=>"pawn","color"=>"white"]),
  // Fila 1 (piezas blancas)
  [
    ["type"=>"rook","color"=>"white"],
    ["type"=>"knight","color"=>"white"],
    ["type"=>"bishop","color"=>"white"],
    ["type"=>"queen","color"=>"white"],
    ["type"=>"king","color"=>"white"],
    ["type"=>"bishop","color"=>"white"],
    ["type"=>"knight","color"=>"white"],
    ["type"=>"rook","color"=>"white"],
  ],
];

// Serializamos a JSON para usar del lado cliente (JS)
$initialBoardJSON = json_encode($initialBoard);
$pieceSymbolsJSON = json_encode($pieceSymbols);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>Tablero de Ajedrez (PHP + Drag & Drop)</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <!--
  /**
 * Tablero de Ajedrez Interactivo con Drag & Drop
 * 
 * @author Aristóteles Quintanar <axzquint@gmail.com>
 * @license MIT License
 * 
 * MIT License
 * 
 * Copyright (c) 2025 Aristóteles Quintanar
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */
  -->
  <style>
    :root {
      --square-size: min(10vw, 10vh);
      --light: #fde68a;   /* ámbar claro */
      --light-dark: #fef3c7;
      --dark:  #92400e;   /* ámbar oscuro */
      --dark-dark: #78350f;
      --border: #e5e7eb;
      --muted: #6b7280;
      --primary: #2563eb;
      --primary-foreground: #ffffff;
      --secondary: #e5e7eb;
      --secondary-foreground: #111827;
      --ring: #3b82f6;
      --dark-piece-color: #111827; /* Color personalizable para piezas negras */
      --light-piece-color: #ffffff; /* Color personalizable para piezas blancas */
      --light-square-color: #fde68a; /* Color personalizable para casillas claras */
      --dark-square-color: #92400e; /* Color personalizable para casillas oscuras */
    }
    body {
      font-family: ui-sans-serif, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
      background: #0b0c10;
      color: #e5e7eb;
      display: flex;
      min-height: 100vh;
      margin: 0;
    }
    .container {
      margin: 20px;
      display: flex;
      flex-direction: row;
      align-items: center;
      gap: 40px;
      width: 100%;
      height: 100vh;
      justify-content: center;
    }
    .main-content {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 24px;
    }
    .controls {
      display: flex;
      flex-direction: column;
      gap: 16px;
      min-width: 200px;
      padding: 20px;
      background: rgba(17, 24, 39, 0.5);
      border-radius: 12px;
      border: 1px solid var(--border);
    }
    .controls h3 {
      margin: 0 0 12px 0;
      color: var(--primary-foreground);
      font-size: 16px;
      text-align: center;
    }
    .btn {
      padding: 8px 16px;
      border-radius: 8px;
      border: none;
      cursor: pointer;
      transition: filter .15s ease;
      font-weight: 600;
    }
    .btn-primary { background: var(--primary); color: var(--primary-foreground); }
    .btn-secondary { background: var(--secondary); color: var(--secondary-foreground); }
    .btn-undo { background: #f59e0b; color: var(--primary-foreground); }
    .btn:hover { filter: brightness(1.05); }
    .btn:disabled { 
      opacity: 0.5; 
      cursor: not-allowed; 
      filter: none; 
    }
    .board-wrap {
      position: relative;
    }
    .board {
      display: grid;
      grid-template-columns: repeat(8, var(--square-size));
      border: 2px solid var(--border);
      background: #111827;
    }
    .square {
      width: var(--square-size);
      height: var(--square-size);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: calc(var(--square-size) * 0.65);
      cursor: pointer;
      position: relative;
      transition: background-color .15s ease, transform .05s ease;
      user-select: none;
    }
    .square.light { background: var(--light-square-color); }
    .square.dark  { background: var(--dark-square-color); color: #111827; }
    .square.highlight {
      outline: 2px solid var(--ring);
      outline-offset: -2px;
    }
    .piece {
      transition: transform .1s ease;
      text-shadow: 0 1px 1px rgba(0,0,0,.8);
    }
    .piece.white {
      color: var(--light-piece-color) !important;
      text-shadow: 0 1px 1px rgba(0,0,0,.8);
    }
    .piece.black {
      color: var(--dark-piece-color) !important;
      text-shadow: 0 1px 1px rgba(255,255,255,.3);
    }
    .piece:hover { transform: scale(1.08); }
    .piece:active { transform: scale(0.95); }
    .ranks, .files {
      position: absolute;
      color: var(--muted);
      font-size: 12px;
    }
    .ranks {
      left: calc(-1 * var(--square-size) * 0.6);
      top: 0;
      height: calc(var(--square-size) * 8);
      display: flex;
      flex-direction: column;
      justify-content: space-around;
      font-size: calc(var(--square-size) * 0.25);
    }
    .ranks > div { height: var(--square-size); display: flex; align-items: center; }
    .files {
      bottom: calc(-1 * var(--square-size) * 0.4);
      left: 0;
      width: calc(var(--square-size) * 8);
      display: flex;
      justify-content: space-around;
      font-size: calc(var(--square-size) * 0.25);
    }
    .files > div { width: var(--square-size); text-align: center; }
    .help {
      max-width: 520px;
      text-align: center;
      color: var(--muted);
      font-size: 14px;
      line-height: 1.45;
    }
    .help strong { color: #e5e7eb; }
    .color-control {
      display: flex;
      align-items: center;
      gap: 8px;
      color: var(--muted);
      font-size: 14px;
    }
    .color-picker {
      width: 32px;
      height: 32px;
      border: 2px solid var(--border);
      border-radius: 6px;
      cursor: pointer;
      background: none;
      padding: 0;
    }
    .color-picker::-webkit-color-swatch-wrapper {
      padding: 0;
    }
    .color-picker::-webkit-color-swatch {
      border: none;
      border-radius: 4px;
    }
  </style>
</head>
<body>
  <div class="container">
    <!-- Contenido principal (tablero e instrucciones) -->
    <div class="main-content">
      <!-- Tablero -->
      <div class="board-wrap">
        <!-- Etiquetas de filas (ranks) -->
        <div class="ranks" id="ranks"></div>
        <!-- Etiquetas de columnas (files) -->
        <div class="files" id="files"></div>
        <!-- La grilla -->
        <div class="board" id="board"></div>
      </div>

      <!-- Instrucciones -->
      <div class="help">
        <p><strong>Cómo usar:</strong> arrastra y suelta cualquier pieza para moverla por el tablero.</p>
        <p>Perfecto para enseñar posiciones, practicar tácticas o montar escenarios personalizados.</p>
        <hr style="margin: 20px 0; border: 1px solid var(--muted); opacity: 0.3;">
        <p style="font-size: 12px; opacity: 0.7;">
          <strong>Creado por:</strong> Aristóteles Quintanar<br>
          <strong>Email:</strong> axzquint@gmail.com<br>
          <strong>Licencia:</strong> MIT License
        </p>
      </div>
    </div>

    <!-- Panel de controles a la derecha -->
    <div class="controls">
      <h3>Controles</h3>
      
      <button id="btnReset" class="btn btn-primary">Reiniciar Tablero</button>
      <button id="btnClear" class="btn btn-secondary">Limpiar Tablero</button>
      <button id="btnUndo" class="btn btn-undo" disabled>Deshacer Movimiento</button>
      
      <div class="color-control">
        <label for="lightPieceColor">Piezas blancas:</label>
        <input type="color" id="lightPieceColor" class="color-picker" value="#ffffff">
      </div>
      
      <div class="color-control">
        <label for="darkPieceColor">Piezas negras:</label>
        <input type="color" id="darkPieceColor" class="color-picker" value="#111827">
      </div>
      
      <div class="color-control">
        <label for="lightSquareColor">Casillas claras:</label>
        <input type="color" id="lightSquareColor" class="color-picker" value="#fde68a">
      </div>
      
      <div class="color-control">
        <label for="darkSquareColor">Casillas oscuras:</label>
        <input type="color" id="darkSquareColor" class="color-picker" value="#92400e">
      </div>
    </div>
  </div>

  <script>
    // --- Datos enviados desde PHP ---
    const initialBoard = <?php echo $initialBoardJSON; ?>;       // 8x8 con objetos o null
    const pieceSymbols = <?php echo $pieceSymbolsJSON; ?>;       // mapa color->tipo->símbolo

    // Copia profunda simple
    const deepClone = (obj) => JSON.parse(JSON.stringify(obj));

    // Estado (lado cliente)
    let board = deepClone(initialBoard);
    let dragged = null; // { piece, fromRow, fromCol }
    let highlighted = null; // { row, col }
    let moveHistory = []; // Array of { board, move: { from, to, capturedPiece } }
    let darkPieceColor = '#111827'; // Color actual de las piezas negras
    let lightPieceColor = '#ffffff'; // Color actual de las piezas blancas
    let lightSquareColor = '#fde68a'; // Color actual de las casillas claras
    let darkSquareColor = '#92400e'; // Color actual de las casillas oscuras

    const files = ["a","b","c","d","e","f","g","h"];
    const ranks = ["8","7","6","5","4","3","2","1"];

    const boardEl = document.getElementById('board');
    const ranksEl = document.getElementById('ranks');
    const filesEl = document.getElementById('files');

    // Render de etiquetas
    ranksEl.innerHTML = ranks.map(r => `<div>${r}</div>`).join('');
    filesEl.innerHTML = files.map(f => `<div>${f}</div>`).join('');

    // Render del tablero
    function renderBoard() {
      boardEl.innerHTML = '';
      for (let row = 0; row < 8; row++) {
        for (let col = 0; col < 8; col++) {
          const isLight = (row + col) % 2 === 0;
          const isHighlighted = highlighted && highlighted.row === row && highlighted.col === col;
          const sq = document.createElement('div');
          sq.className = `square ${isLight ? 'light' : 'dark'}${isHighlighted ? ' highlight' : ''}`;
          sq.dataset.row = row;
          sq.dataset.col = col;

          // Eventos de destino
          sq.addEventListener('dragover', (e) => {
            e.preventDefault();
            highlighted = { row, col };
            // Evita re-render completo por cada pixel; solo toggles
            sq.classList.add('highlight');
          });

          sq.addEventListener('dragleave', () => {
            if (highlighted && highlighted.row === row && highlighted.col === col) {
              highlighted = null;
              sq.classList.remove('highlight');
            }
          });

          sq.addEventListener('drop', (e) => {
            e.preventDefault();
            if (highlighted && highlighted.row === row && highlighted.col === col) {
              highlighted = null;
              sq.classList.remove('highlight');
            }
            if (!dragged) return;

            const { piece, fromRow, fromCol } = dragged;
            // No permitir soltar en la misma casilla
            if (fromRow === row && fromCol === col) {
              dragged = null;
              return;
            }
            
            // Guardar estado actual en historial antes del movimiento
            const capturedPiece = board[row][col]; // Pieza que será capturada (si existe)
            moveHistory.push({
              board: deepClone(board),
              move: {
                from: { row: fromRow, col: fromCol },
                to: { row, col },
                capturedPiece: capturedPiece
              }
            });
            
            // Actualizar estado
            const next = deepClone(board);
            next[fromRow][fromCol] = null;
            next[row][col] = piece;
            board = next;
            dragged = null;
            updateUndoButton();
            renderBoard();
          });

          // Pieza (si existe)
          const piece = board[row][col];
          if (piece) {
            const span = document.createElement('div');
            span.className = `piece ${piece.color === 'white' ? 'white' : 'black'}`;
            span.textContent = pieceSymbols[piece.color][piece.type];
            span.setAttribute('draggable', 'true');
            


            // Eventos de arrastre
            span.addEventListener('dragstart', () => {
              dragged = { piece, fromRow: row, fromCol: col };
            });

            sq.appendChild(span);
          }

          boardEl.appendChild(sq);
        }
      }
    }

    // Función para actualizar el estado del botón undo
    function updateUndoButton() {
      const undoBtn = document.getElementById('btnUndo');
      undoBtn.disabled = moveHistory.length === 0;
    }

    // Controles
    document.getElementById('btnReset').addEventListener('click', () => {
      board = deepClone(initialBoard);
      dragged = null;
      highlighted = null;
      moveHistory = [];
      updateUndoButton();
      renderBoard();
    });

    document.getElementById('btnClear').addEventListener('click', () => {
      board = Array.from({ length: 8 }, () => Array(8).fill(null));
      dragged = null;
      highlighted = null;
      moveHistory = [];
      updateUndoButton();
      renderBoard();
    });

    document.getElementById('btnUndo').addEventListener('click', () => {
      if (moveHistory.length === 0) return;
      
      // Restaurar el estado anterior
      const lastState = moveHistory.pop();
      board = deepClone(lastState.board);
      
      dragged = null;
      highlighted = null;
      updateUndoButton();
      renderBoard();
    });

    // Controles de color
    document.getElementById('lightPieceColor').addEventListener('change', (e) => {
      lightPieceColor = e.target.value;
      document.documentElement.style.setProperty('--light-piece-color', lightPieceColor);
    });

    document.getElementById('darkPieceColor').addEventListener('change', (e) => {
      darkPieceColor = e.target.value;
      document.documentElement.style.setProperty('--dark-piece-color', darkPieceColor);
    });

    document.getElementById('lightSquareColor').addEventListener('change', (e) => {
      lightSquareColor = e.target.value;
      document.documentElement.style.setProperty('--light-square-color', lightSquareColor);
    });

    document.getElementById('darkSquareColor').addEventListener('change', (e) => {
      darkSquareColor = e.target.value;
      document.documentElement.style.setProperty('--dark-square-color', darkSquareColor);
    });

    // Primer render
    updateUndoButton();
    renderBoard();
  </script>
</body>
</html>