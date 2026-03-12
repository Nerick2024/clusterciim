# Blueprint

## Visión General

Este proyecto es una aplicación web estática construida con Astro.js. El objetivo es crear un sitio rápido, de alto rendimiento y visualmente impactante con un mínimo de JavaScript por defecto.

## Pila Tecnológica

*   **Framework:** Astro.js
*   **Lenguaje:** TypeScript
*   **Estilos:** Tailwind CSS
*   **Dependencias:**
    *   `aos`: para animaciones de scroll.
    *   `tailwindcss`: para estilos.
    *   `@astrojs/tailwind`: para la integración de Tailwind con Astro.

## Dirección de Diseño

El diseño del sitio seguirá una estética **premium, fresca y minimalista**, con un **tema oscuro** como base. Las características visuales clave incluyen:

*   **Fondos Oscuros y Composiciones Estáticas:** Se utiliza una base de fondos negros o grises muy oscuros. Sobre esta base, se crean composiciones visuales estáticas mediante el uso de grandes círculos de degradado, suaves y difuminados. Esto crea profundidad y una sensación premium de manera sutil y elegante.
*   **Animaciones Sutiles y Deliberadas:** Las animaciones se utilizan con moderación, principalmente para transiciones de estado (hover, focus) y para animaciones de scroll (`AOS`). Se evita el uso de animaciones de fondo continuas o que puedan distraer, en favor de las composiciones estáticas.
*   **Acentos de Color Vibrantes:** Empleo de colores de acento, principalmente púrpuras y azules, para resaltar elementos interactivos como botones, enlaces y tarjetas. Estos colores se usan en degradados para añadir un toque dinámico.
*   **Tipografía Limpia:** Selección de fuentes modernas y legibles, con un claro énfasis jerárquico para títulos, subtítulos y cuerpo de texto.
*   **Componentes Elevados:** Diseño de tarjetas y otros componentes con sombras suaves o "brillos" (glows) para que parezcan "flotar" sobre el fondo.
*   **Iconografía Significativa:** Uso de iconografía limpia y moderna para mejorar la comprensión y la navegación.

## Plan de Implementación

1.  **Implementación del Nuevo Diseño "Premium Dark" (En Progreso):**
    *   **Layout & Colores Base:** Se han definido y aplicado los colores primarios (`primary`, `secondary`) y de fondo (`bg`) en `tailwind.config.mjs` y se han aplicado al `Layout.astro`. (✓ Hecho)
    *   **Componente `Hero`:** Rediseñado con el estilo "Premium Dark". (✓ Hecho)
    *   **Componente `About`:** Rediseñado con fondos decorativos estáticos (degradados suaves y difuminados) según la preferencia del usuario. (✓ Hecho)
    *   **Componente `AreasOfImpact`:** Creado y añadido a `index.astro`, siguiendo el estilo "Premium Dark". (✓ Hecho)

2.  **Próximos Pasos:**
    *   Revisar y rediseñar los componentes restantes (`Navbar`, `Footer`, etc.) para asegurar una consistencia visual completa con la estética "Premium Dark".
    *   Validar la correcta visualización y capacidad de respuesta en dispositivos móviles.
    *   Realizar una revisión final de accesibilidad y rendimiento.
