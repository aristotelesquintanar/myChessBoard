# 🏁 Tablero de Ajedrez Interactivo

Un tablero de ajedrez completamente funcional con interfaz drag & drop, personalización de colores y controles avanzados. Perfecto para enseñar posiciones, practicar tácticas o crear escenarios personalizados.

![Chess Board](https://img.shields.io/badge/Chess-Interactive-blue) ![PHP](https://img.shields.io/badge/PHP-7.4+-blue) ![JavaScript](https://img.shields.io/badge/JavaScript-ES6+-yellow) ![License](https://img.shields.io/badge/License-MIT-green)

## ✨ Características Principales

### 🎮 Funcionalidades del Tablero
- **Drag & Drop Intuitivo**: Arrastra y suelta piezas con facilidad
- **Tablero Responsivo**: Se adapta automáticamente al 80% del viewport más pequeño
- **Símbolos Unicode**: Utiliza símbolos de ajedrez Unicode para una visualización perfecta
- **Coordenadas del Tablero**: Muestra filas (1-8) y columnas (a-h) como en un tablero real
- **Efectos Visuales**: Animaciones suaves y efectos hover en las piezas

### 🎨 Personalización Completa
- **Color de Piezas Blancas**: Selector de color para personalizar las piezas blancas
- **Color de Piezas Negras**: Selector de color para personalizar las piezas negras  
- **Color de Casillas Claras**: Personaliza el color de las casillas claras
- **Color de Casillas Oscuras**: Personaliza el color de las casillas oscuras
- **Cambios en Tiempo Real**: Todos los cambios de color se aplican instantáneamente

### 🔧 Controles Avanzados
- **Reiniciar Tablero**: Restaura la posición inicial del ajedrez
- **Limpiar Tablero**: Elimina todas las piezas para crear posiciones personalizadas
- **Deshacer Movimiento**: Sistema completo de historial con función undo
- **Historial de Movimientos**: Guarda todos los movimientos realizados

### 🎯 Características Técnicas
- **Arquitectura Híbrida**: PHP para el backend + JavaScript para la interactividad
- **Diseño Responsivo**: Funciona perfectamente en desktop, tablet y móvil
- **CSS Variables**: Sistema modular de colores fácilmente personalizable
- **Estado Persistente**: Mantiene el estado del juego durante la sesión
- **Validación de Movimientos**: Previene movimientos inválidos (misma casilla)

## 🚀 Instalación y Uso

### Requisitos
- Servidor web con soporte PHP (Apache, Nginx, etc.)
- PHP 7.4 o superior
- Navegador web moderno con soporte HTML5

### Instalación Rápida
1. Clona o descarga el repositorio
2. Coloca el archivo `index.php` en tu servidor web
3. Accede a través de tu navegador
4. ¡Listo para usar!

```bash
# Ejemplo con servidor local
git clone [repository-url]
cd myChessBoard
php -S localhost:8000
# Abre http://localhost:8000 en tu navegador
```

## 📖 Cómo Usar

### Movimiento de Piezas
1. **Hacer clic y arrastrar**: Selecciona cualquier pieza y arrástrala a su nueva posición
2. **Soltar**: Suelta la pieza en la casilla deseada
3. **Confirmación visual**: La pieza se moverá y el tablero se actualizará

### Personalización de Colores
1. **Panel de Controles**: Utiliza el panel lateral derecho
2. **Selectores de Color**: Haz clic en cualquier selector de color
3. **Cambio Instantáneo**: Los colores se actualizan en tiempo real
4. **Combinaciones Ilimitadas**: Crea tu estilo único de tablero

### Gestión del Juego
- **Reiniciar**: Vuelve a la posición inicial estándar del ajedrez
- **Limpiar**: Crea un tablero vacío para posiciones personalizadas
- **Deshacer**: Revierte el último movimiento realizado

## 🎨 Casos de Uso

### 📚 Educación
- **Enseñanza de Ajedrez**: Ideal para instructores y estudiantes
- **Análisis de Posiciones**: Estudia posiciones específicas sin restricciones
- **Problemas Tácticos**: Configura puzzles y ejercicios personalizados

### 🏆 Entrenamiento
- **Práctica de Aperturas**: Configura y practica diferentes aperturas
- **Análisis de Finales**: Estudia posiciones de final de juego
- **Simulación de Partidas**: Recrea partidas famosas para análisis

### 🎯 Presentaciones
- **Demostraciones**: Perfecto para presentaciones y conferencias
- **Streaming**: Ideal para streamers de ajedrez
- **Análisis en Vivo**: Herramienta perfecta para comentaristas

## 🛠️ Arquitectura Técnica

### Backend (PHP)
```php
// Definición de piezas con símbolos Unicode
$pieceSymbols = [
  "white" => ["king" => "♔", "queen" => "♕", ...],
  "black" => ["king" => "♚", "queen" => "♛", ...]
];

// Tablero inicial en formato matriz 8x8
$initialBoard = [...];
```

### Frontend (JavaScript)
```javascript
// Estado del juego
let board = deepClone(initialBoard);
let moveHistory = [];
let dragged = null;

// Sistema de drag & drop
function renderBoard() { ... }
function updateColors() { ... }
```

### Estilos (CSS)
```css
:root {
  --square-size: min(10vw, 10vh);
  --dark-piece-color: #111827;
  --light-piece-color: #ffffff;
  /* Variables CSS personalizables */
}
```

## 🎨 Personalización Avanzada

### Modificar Colores por Defecto
Edita las variables CSS en `:root` para cambiar los colores predeterminados:

```css
:root {
  --dark-piece-color: #your-color;
  --light-piece-color: #your-color;
  --light-square-color: #your-color;
  --dark-square-color: #your-color;
}
```

### Cambiar Tamaño del Tablero
Modifica la variable `--square-size` para ajustar el tamaño:

```css
:root {
  --square-size: min(8vw, 8vh); /* Tablero más pequeño */
  --square-size: min(12vw, 12vh); /* Tablero más grande */
}
```

## 🤝 Contribuciones

Las contribuciones son bienvenidas. Para contribuir:

1. Fork el proyecto
2. Crea una rama para tu feature (`git checkout -b feature/AmazingFeature`)
3. Commit tus cambios (`git commit -m 'Add some AmazingFeature'`)
4. Push a la rama (`git push origin feature/AmazingFeature`)
5. Abre un Pull Request

## 📝 Roadmap

### Próximas Características
- [ ] Validación completa de movimientos de ajedrez
- [ ] Modo de juego contra IA
- [ ] Exportar/Importar posiciones en formato FEN
- [ ] Grabación y reproducción de partidas
- [ ] Modo multijugador online
- [ ] Temas predefinidos de colores
- [ ] Sonidos de movimiento
- [ ] Análisis automático de posiciones

### Mejoras Técnicas
- [ ] Optimización de rendimiento
- [ ] Soporte para PWA (Progressive Web App)
- [ ] Modo offline completo
- [ ] API REST para integración
- [ ] Base de datos para guardar partidas

## 🐛 Reportar Problemas

Si encuentras algún bug o tienes sugerencias:

1. Revisa los [issues existentes](../../issues)
2. Crea un nuevo issue con:
   - Descripción detallada del problema
   - Pasos para reproducir
   - Capturas de pantalla (si aplica)
   - Información del navegador/sistema

## 📄 Licencia

Este proyecto está licenciado bajo la Licencia MIT - ver el archivo [LICENSE](LICENSE) para más detalles.

### MIT License

```
Copyright (c) 2025 Aristóteles Quintanar

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
```

## 👨‍💻 Autor

**Aristóteles Quintanar**
- Email: [axzquint@gmail.com](mailto:axzquint@gmail.com)
- GitHub: [@aristotelesquintanar](https://github.com/aristotelesquintanar)

## 🙏 Agradecimientos

- Comunidad de ajedrez por la inspiración
- Contribuidores de código abierto
- Usuarios que proporcionan feedback valioso

---

⭐ **¡Si te gusta este proyecto, dale una estrella!** ⭐

*Hecho 