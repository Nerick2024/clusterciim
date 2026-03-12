/** @type {import('tailwindcss').Config} */
export default {
  content: ['./src/**/*.{astro,html,js,jsx,md,mdx,svelte,ts,tsx,vue}'],
  theme: {
    extend: {
      colors: {
        primary: '#22ffff',
        secondary: '#00e0ff',
        tertiary: '#38769c',
        bg: '#00010b',
      },
    },
  },
  plugins: [],
}
