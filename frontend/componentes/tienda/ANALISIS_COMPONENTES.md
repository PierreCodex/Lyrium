# Análisis de Componentes de Tienda

## Archivos ACTIVOS (Se están usando)

### Usados en tienda.php directamente:
1. ✅ **tienda-header.php** - Header de la tienda (línea 331)
2. ✅ **slider-publicidad-horizontal.php** - Slider de publicidad horizontal (línea 350)
3. ✅ **tienda-info-card.php** - Card de información de la tienda (línea 359, solo premium)
4. ✅ **modal-producto-rapido.php** - Modal de vista rápida de productos (línea 387)

### Usados en los 3 layouts (layout-1.php, layout-2.php, layout-3.php):
5. ✅ **tienda-banner-publicitario.php** - Banner publicitario de ofertas especiales
6. ✅ **tienda-productos-grid.php** - Grid de productos destacados

### Usados indirectamente (a través de tienda-sidebar.php):
7. ✅ **sidebar-productos-vertical.php** - Sidebar vertical con productos (solo premium)

### Archivos en componentes/ (fuera de tienda/):
- ✅ **tienda-tabs.php** - Tabs principales con productos
- ✅ **tienda-sidebar.php** - Sidebar (llama a sidebar-productos-vertical.php)
- ✅ **tienda-banner.php** - Banner principal/carrusel

## Archivos NO USADOS (Candidatos a eliminar o renombrar)

1. ❌ **_index.php** - No se usa en ningún lado
2. ❌ **ad-banner-grande.php** - No se usa en ningún lado
3. ❌ **ad-banner-horizontal.php** - No se usa en ningún lado
4. ❌ **producto-card.php** - No se usa en ningún lado
5. ❌ **productos-filtros.php** - No se usa en ningún lado
6. ❌ **productos-grid.php** - No se usa en ningún lado
7. ❌ **productos-scroll.php** - No se usa en ningún lado
8. ❌ **tienda-descripcion.php** - No se usa en ningún lado

## Recomendaciones de Organización

### Opción 1: Crear subcarpetas por uso
```
componentes/tienda/
├── layouts/
│   ├── layout-1.php
│   ├── layout-2.php
│   └── layout-3.php
├── compartidos/          [NUEVO - Usados en todos los layouts]
│   ├── tienda-banner-publicitario.php
│   └── tienda-productos-grid.php
├── header/               [NUEVO - Componentes del header]
│   └── tienda-header.php
├── sidebar/              [NUEVO - Componentes del sidebar]
│   └── sidebar-productos-vertical.php
├── sliders/              [NUEVO - Sliders y carruseles]
│   └── slider-publicidad-horizontal.php
├── modales/              [NUEVO - Modales]
│   └── modal-producto-rapido.php
├── cards/                [NUEVO - Cards de información]
│   └── tienda-info-card.php
└── deprecated/           [NUEVO - Archivos no usados]
    ├── _index.php
    ├── ad-banner-grande.php
    ├── ad-banner-horizontal.php
    ├── producto-card.php
    ├── productos-filtros.php
    ├── productos-grid.php
    ├── productos-scroll.php
    └── tienda-descripcion.php
```

### Opción 2: Renombrar con prefijos claros
```
componentes/tienda/
├── layouts/
│   ├── layout-1.php
│   ├── layout-2.php
│   └── layout-3.php
├── SHARED_banner-publicitario.php
├── SHARED_productos-grid.php
├── HEADER_tienda-header.php
├── SIDEBAR_productos-vertical.php
├── SLIDER_publicidad-horizontal.php
├── MODAL_producto-rapido.php
├── CARD_info-tienda.php
└── UNUSED_*.php (mover a carpeta deprecated/)
```

### Opción 3: Mantener plano pero con nombres descriptivos
```
componentes/tienda/
├── layouts/
│   ├── layout-1.php (Sidebar derecha)
│   ├── layout-2.php (Sidebar izquierda)
│   └── layout-3.php (Full width)
├── all-layouts-banner-publicitario.php
├── all-layouts-productos-grid.php
├── main-header.php
├── sidebar-productos-vertical.php
├── slider-publicidad-horizontal.php
├── modal-producto-rapido.php
├── info-card.php
└── deprecated/ (archivos no usados)
```

## Mapeo de Uso por Layout

### Layout 1 (Sidebar Derecha)
- tienda-tabs.php (componentes/)
- tienda-sidebar.php (componentes/) → sidebar-productos-vertical.php
- tienda-banner-publicitario.php
- tienda-productos-grid.php

### Layout 2 (Sidebar Izquierda)
- tienda-tabs.php (componentes/)
- tienda-sidebar.php (componentes/) → sidebar-productos-vertical.php
- tienda-banner-publicitario.php
- tienda-productos-grid.php

### Layout 3 (Full Width)
- tienda-tabs.php (componentes/)
- tienda-sidebar.php (componentes/) → sidebar-productos-vertical.php
- tienda-banner-publicitario.php (aparece 2 veces)
- tienda-productos-grid.php

### Componentes Globales (Todos los layouts)
- tienda-header.php
- tienda-banner.php (carrusel principal)
- slider-publicidad-horizontal.php
- tienda-info-card.php (solo premium)
- modal-producto-rapido.php
