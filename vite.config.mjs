import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import html from '@rollup/plugin-html';
import { glob } from 'glob';

/**
 * Get Files from a directory
 * @param {string} query
 * @returns array
 */
function GetFilesArray(query) {
  return glob.sync(query);
}

/**
 * JS Files
 */
const pageJsFiles = GetFilesArray('resources/assets/js/*.js');
const vendorJsFiles = GetFilesArray('resources/assets/vendor/js/*.js');
const libsJsFiles = GetFilesArray('resources/assets/vendor/libs/**/*.js');

/**
 * SCSS Files
 */
const coreScssFiles = GetFilesArray('resources/assets/vendor/scss/**/!(_)*.scss');
const libsScssFiles = GetFilesArray('resources/assets/vendor/libs/**/!(_)*.scss');
const libsCssFiles = GetFilesArray('resources/assets/vendor/libs/**/*.css');
const fontsScssFiles = GetFilesArray('resources/assets/vendor/fonts/!(_)*.scss');

// Processing Window Assignment for Libs like jKanban, pdfMake
function libsWindowAssignment() {
  return {
    name: 'libsWindowAssignment',
    transform(src, id) {
      if (id.includes('jkanban.js')) {
        return src.replace('this.jKanban', 'window.jKanban');
      } else if (id.includes('vfs_fonts')) {
        return src.replaceAll('this.pdfMake', 'window.pdfMake');
      }
    }
  };
}

export default defineConfig({
  plugins: [
    laravel({
      input: [
        'resources/css/app.css',
        'resources/assets/css/demo.css',
        'resources/js/app.js',
        'resources/assets/js/front-page-landing.js',
        ...pageJsFiles,
        ...vendorJsFiles,
        ...libsJsFiles,
        'resources/js/laravel-user-management.js', // Processing Laravel User Management CRUD JS File
        ...coreScssFiles,
        ...libsScssFiles,
        ...libsCssFiles,
        ...fontsScssFiles
      ],
      refresh: true,
    }),
    html(),
    libsWindowAssignment()
  ]
});
