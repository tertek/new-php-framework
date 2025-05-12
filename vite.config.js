import { defineConfig } from "vite"
import tailwindcss from '@tailwindcss/vite'
import path from "path"

// https://vitejs.dev/config/
export default defineConfig({

  //  Do not copy public dir into build
  publicDir: false,

  // Add entrypoint
  build: {
    // our entry
    rollupOptions: {
      input: path.resolve(__dirname, "resources/js/app.js"),
    },

    // manifest
    manifest: 'manifest.json',

    // store build into public directory so that it is accessible
    outDir: './public/build',
  },

  // Adjust Vite's dev server for DDEV
  // https://vitejs.dev/config/server-options.html
  server: {
    // Respond to all network requests
    host: "0.0.0.0",
    strictPort: true,
    // Defines the origin of the generated asset URLs during development, this must be set to the
    // Vite dev server URL given by ddev-vite-sitecar add-on variable VITE_SERVER_URI.
    origin: process.env.VITE_SERVER_URI,
    // Configure CORS securely for the Vite dev server to allow requests from *.ddev.site domains,
    // supports additional hostnames (via regex). If you use another `project_tld`, adjust this.
    cors: {
      origin: /https?:\/\/([A-Za-z0-9\-\.]+)?(\.ddev\.site)(?::\d+)?$/,
    },
  },

  plugins: [
    tailwindcss(),
  ],
  
})