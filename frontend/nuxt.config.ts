// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
	compatibilityDate: '2024-11-01',
	devtools: { enabled: true },
	components: ['~/components', '~/shared/icons'],
	app: {
		head: {
			link: [
				{
					rel: 'stylesheet',
					href: 'https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap'
				}
			]
		}
	},
	build: {
		transpile: ['vue3-apexcharts']
	},
	runtimeConfig: {
		public: {
			apiBase: process.env.NUXT_PUBLIC_API_BASE || 'http://localhost:8000' // fallback para desenvolvimento
		}
	},
	modules: [
		'@nuxtjs/tailwindcss',
		'@vee-validate/nuxt',
		'@pinia/nuxt',
		'pinia-plugin-persistedstate/nuxt',
	],
	veeValidate: {
		autoImports: true,
		componentNames: {
			Form: 'VeeForm',
			Field: 'VeeField',
			ErrorMessage: 'VeeErrorMessage'
		}
	},
	css: ['@/assets/css/main.css'],
	ssr: false,
});
