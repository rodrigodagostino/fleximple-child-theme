module.exports = {
  env: {
    browser: false,
    es6: true,
    jquery: true,
    node: true,
  },
  plugins: ['react', 'jsx-a11y', 'prettier'],
  extends: [
    'eslint:recommended',
    'plugin:react/recommended',
    'plugin:jsx-a11y/recommended',
    'plugin:prettier/recommended',
  ],
  globals: {
    wp: true,
    wpApiSettings: true,
    window: true,
    document: true,
    navigator: true,
    location: true,
    history: true,
    fetch: false,
  },
  parserOptions: {
    parser: '@babel/eslint-parser',
    ecmaFeatures: {
      jsx: true,
      modules: true,
    },
    ecmaVersion: 2020,
    requireConfigFile: false,
    sourceType: 'module',
  },
  settings: {
    react: {
      pragma: 'wp',
      version: 'detect',
    },
  },
  rules: {
    'prettier/prettier': 'error',
    'react/react-in-jsx-scope': 'off',
  },
}
