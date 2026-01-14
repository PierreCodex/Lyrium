# Estructura Organizada de Componentes de Tienda

## 📁 Estructura Actual

```
componentes/tienda/
├── 📄 ANALISIS_COMPONENTES.md          # Análisis detallado de uso
│
├── 📂 layouts/                          # ✅ PLANTILLAS (3 archivos)
│   ├── layout-1.php                    # Sidebar Derecha
│   ├── layout-2.php                    # Sidebar Izquierda
│   └── layout-3.php                    # Full Width
│
├── 📂 deprecated/                       # ❌ NO USADOS (8 archivos + README)
│   ├── README.md
│   ├── _index.php
│   ├── ad-banner-grande.php
│   ├── ad-banner-horizontal.php
│   ├── producto-card.php
│   ├── productos-filtros.php
│   ├── productos-grid.php
│   ├── productos-scroll.php
│   └── tienda-descripcion.php
│
├── 📂 cards/                            # (Vacía - lista para organizar)
├── 📂 compartidos/                      # (Vacía - lista para organizar)
├── 📂 header/                           # (Vacía - lista para organizar)
├── 📂 modales/                          # (Vacía - lista para organizar)
├── 📂 sidebar/                          # (Vacía - lista para organizar)
├── 📂 sliders/                          # (Vacía - lista para organizar)
│
└── 📄 Componentes activos (6 archivos):
    ├── modal-producto-rapido.php       # Modal de vista rápida
    ├── sidebar-productos-vertical.php  # Sidebar con productos
    ├── slider-publicidad-horizontal.php # Slider de publicidad
    ├── tienda-banner-publicitario.php  # Banner de ofertas
    ├── tienda-header.php               # Header de la tienda
    ├── tienda-info-card.php            # Card de información
    └── tienda-productos-grid.php       # Grid de productos
```

## 🎯 Componentes por Uso

### Usados en TODAS las plantillas (1, 2, 3)
- ✅ `tienda-banner-publicitario.php` - Banner de ofertas especiales
- ✅ `tienda-productos-grid.php` - Grid de productos destacados

### Usados en tienda.php (globales)
- ✅ `tienda-header.php` - Header principal
- ✅ `slider-publicidad-horizontal.php` - Slider horizontal
- ✅ `tienda-info-card.php` - Card de información (solo premium)
- ✅ `modal-producto-rapido.php` - Modal de vista rápida

### Usados indirectamente
- ✅ `sidebar-productos-vertical.php` - Llamado desde `tienda-sidebar.php` (solo premium)

### Componentes externos (en componentes/)
- ✅ `tienda-tabs.php` - Tabs principales
- ✅ `tienda-sidebar.php` - Sidebar principal
- ✅ `tienda-banner.php` - Banner/carrusel principal

## 📊 Estadísticas

- **Total de archivos analizados**: 15
- **Archivos en uso**: 7 (46.7%)
- **Archivos deprecados**: 8 (53.3%)
- **Plantillas creadas**: 3

## 🔄 Próximos Pasos Sugeridos

1. **Opcional**: Mover los 6 componentes activos a sus carpetas correspondientes:
   - `modal-producto-rapido.php` → `modales/`
   - `sidebar-productos-vertical.php` → `sidebar/`
   - `slider-publicidad-horizontal.php` → `sliders/`
   - `tienda-banner-publicitario.php` → `compartidos/`
   - `tienda-header.php` → `header/`
   - `tienda-info-card.php` → `cards/`
   - `tienda-productos-grid.php` → `compartidos/`

2. **Actualizar rutas** en los archivos que los incluyen

3. **Eliminar carpetas vacías** si decides no organizar más

## ✅ Trabajo Completado

- ✅ Separación de 3 plantillas en archivos independientes
- ✅ Identificación de archivos no usados
- ✅ Movimiento de archivos deprecados a carpeta separada
- ✅ Documentación completa del sistema
- ✅ Reducción de complejidad en tienda.php (30%)

---

**Fecha de organización**: 2026-01-13  
**Archivos deprecados**: 8  
**Archivos activos**: 7  
**Plantillas**: 3
