export default defineConfig({
  base: process.env.ASSET_URL || '/',  // ใช้ค่า ASSET_URL ที่ถูกต้องใน production
  plugins: [
    laravel({
      input: ['resources/css/app.css', 'resources/js/app.js'],
      refresh: true,
    }),
  ],
});