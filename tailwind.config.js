/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ['./app/Views/**/*.php', './public/assets/js/**/*.js'],
  theme: {
    extend: {
      colors: {
        burgundy: { DEFAULT: '#6E0F2F', dark: '#4A0A20', deep: '#600018' },
        gold: '#D8BC67',
        ivory: '#F7F2ED',
        charcoal: '#2E2A33',
        soft: '#E9E1DA',
        void: '#000000',
        landing: {
          DEFAULT: '#FAF8F5',
          soft: '#F4F0EA',
          deep: '#EDE6DD',
        },
      },
      fontFamily: {
        display: ['Montserrat', 'system-ui', 'sans-serif'],
        body: ['Lato', 'system-ui', 'sans-serif'],
      },
      backgroundImage: {
        'hero-glow':
          'radial-gradient(ellipse 80% 50% at 50% -20%, rgba(216,188,103,0.18), transparent), radial-gradient(ellipse 60% 40% at 100% 0%, rgba(110,15,47,0.35), transparent)',
        'grid-futuristic':
          'linear-gradient(rgba(216,188,103,0.06) 1px, transparent 1px), linear-gradient(90deg, rgba(216,188,103,0.06) 1px, transparent 1px)',
      },
      backgroundSize: {
        grid: '48px 48px',
      },
      boxShadow: {
        glow: '0 0 60px -12px rgba(216,188,103,0.35)',
        card: '0 25px 50px -12px rgba(0,0,0,0.35)',
      },
      animation: {
        'fade-up': 'fadeUp 0.8s ease-out forwards',
        float: 'float 8s ease-in-out infinite',
        'spin-slow': 'spinSlow 22s linear infinite',
        'pulse-glow': 'pulseGlow 3s ease-in-out infinite',
        'scan-slow': 'scanSlow 11s ease-in-out infinite',
        twinkle: 'twinkle 4s ease-in-out infinite',
        'mesh-drift': 'meshDrift 22s ease-in-out infinite',
        'mesh-drift-slow': 'meshDrift 32s ease-in-out infinite reverse',
      },
      keyframes: {
        meshDrift: {
          '0%, 100%': { transform: 'translate(0%, 0%) scale(1)' },
          '40%': { transform: 'translate(3%, -2%) scale(1.04)' },
          '70%': { transform: 'translate(-2%, 2%) scale(0.97)' },
        },
        fadeUp: {
          '0%': { opacity: '0', transform: 'translateY(24px)' },
          '100%': { opacity: '1', transform: 'translateY(0)' },
        },
        float: {
          '0%, 100%': { transform: 'translateY(0)' },
          '50%': { transform: 'translateY(-8px)' },
        },
        spinSlow: {
          '0%': { transform: 'rotate(0deg)' },
          '100%': { transform: 'rotate(360deg)' },
        },
        pulseGlow: {
          '0%, 100%': { opacity: '0.35', filter: 'blur(0px)' },
          '50%': { opacity: '0.7', filter: 'blur(1px)' },
        },
        scanSlow: {
          '0%, 100%': { transform: 'translateY(-5%)', opacity: '0.2' },
          '50%': { transform: 'translateY(85%)', opacity: '0.5' },
        },
        twinkle: {
          '0%, 100%': { opacity: '0.2', transform: 'scale(1)' },
          '50%': { opacity: '0.9', transform: 'scale(1.2)' },
        },
      },
    },
  },
  plugins: [],
};
