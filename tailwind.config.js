module.exports = {
  theme: {
    extend: {}
  },
  variants: {
    opacity: ['responsive', 'hover', 'focus', 'active', 'disabled'],
  },
  plugins: [
    require('@tailwindcss/custom-forms')
  ]
}
