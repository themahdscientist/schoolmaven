/** @type {import('tailwindcss').Config} */
import preset from './vendor/filament/support/tailwind.config.preset'

export default {
  presets: [preset],
  content: [
    './resources/**/*.{php,js,html}',
    './app/Filament/**/*.php',
    './resources/views/filament/**/*.blade.php',
    './vendor/filament/**/*.blade.php',
    './vendor/wire-elements/modal/**/*.blade.php',
    './app/Http/Livewire/**/*Table.php',
    './app/PowerGridThemes/*.php',
    './vendor/power-components/livewire-powergrid/resources/views/**/*.php',
    './vendor/power-components/livewire-powergrid/src/Themes/Tailwind.php'
  ],
  darkMode: 'class',
  theme: {
    extend: {
      colors: {
        'danger': '#B22222 ',
        'success': '#32CD32',
        'warning': '#FFD700',
        'primary': '#4AAD52',
        'secondary': '#EAEAEA',
        'info': '#4682B4',
        'light': '#F6F7F8',
        'dark': '#242423',
        'body-dark': '#3A3A41',
        'sm-red': '',
        'sm-green': '',
        'sm-blue': '',
        'accent-from': '#00bf7d',
        'accent-to': '#f1fb58',
      },
      backgroundImage: {
        'big-banner': 'url(\'../../public/src/images/website/big-banner.png\')',
        'small-banner': 'url(\'../../public/src/images/website/small-banner.png\')',
      },
      fontFamily: {
        'roboto': ['Roboto', 'sans-serif'],
        'satoshi': ['Satoshi', 'sans-serif'],
        'k-mono': ['K_Mono', 'serif'],
        'aladin': ['Aladin', 'serif'],
        'anta': ['Anta', 'serif'],
        'agbalumo': ['Agbalumo', 'serif'],
      },
      boxShadow: {
        'default': '0px 8px 13px -3px rgba(0, 0, 0, 0.07)',
        'card': '4px 4px 1px rgba(0, 0, 0, 0.12)',
        'card-2': '-4px 4px 1px rgba(0, 0, 0, 0.12)',
        'card-3': '-2px 4px 1px rgba(0, 0, 0, 0.12)',
      },
      dropShadow: {
        1: '0px 1px 0px #E2E8F0',
        2: '0px 1px 4px rgba(0, 0, 0, 0.12)',
      },
    },
  },
  plugins: [
    require('flowbite/plugin')({
      charts: false,
      forms: false,
      tooltip: true,
    }),
  ],
}

