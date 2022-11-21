import babel from 'rollup-plugin-babel'

const pkg  = require('../../package')
const year = new Date().getFullYear()

const globals = {
  jquery: 'jQuery'
}

export default {
  input  : 'build/js/AdminLTE.js',
  output : {
    banner: `/*!
 * AdminLTE v${pkg.version} (${pkg.homepage})
 * Copyright 2022-${year} ${pkg.author}
 */`,
    file  : 'dist/js/adminlte.js',
    format: 'umd',
    globals,
    name  : 'adminlte'
  },
  plugins: [
    babel({
      exclude: 'node_modules/**',
      externalHelpers: true
    })
  ]
}
