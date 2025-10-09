export default {
	path: "/myposyandu",
	meta: { requiredAuth: true },
	component: () =>
		import(
			/* webpackChunkName: "myposyandu" */ "@modules/myposyandu/frontend/pages/Base.vue"
		),
	children: [
		{
			path: "",
			redirect: { name: "myposyandu-dashboard" },
		},

		{
			path: "dashboard",
			name: "myposyandu-dashboard",
			component: () =>
				import(
					/* webpackChunkName: "myposyandu" */ "@modules/myposyandu/frontend/pages/dashboard/index.vue"
				),
		},

		// pagename
		// {
		// 	path: "pagename",
		// 	component: () =>
		// 		import(
		// 			/* webpackChunkName: "myposyandu" */ "@modules/myposyandu/frontend/pages/pagename/index.vue"
		// 		),
		// 	children: [
		// 		{
		// 			path: "",
		// 			name: "myposyandu-pagename",
		// 			component: () =>
		// 				import(
		// 					/* webpackChunkName: "myposyandu" */ "@modules/myposyandu/frontend/pages/pagename/crud/data.vue"
		// 				),
		// 		},

		// 		{
		// 			path: "create",
		// 			name: "myposyandu-pagename-create",
		// 			component: () =>
		// 				import(
		// 					/* webpackChunkName: "myposyandu" */ "@modules/myposyandu/frontend/pages/pagename/crud/create.vue"
		// 				),
		// 		},

		// 		{
		// 			path: ":pagename/edit",
		// 			name: "myposyandu-pagename-edit",
		// 			component: () =>
		// 				import(
		// 					/* webpackChunkName: "myposyandu" */ "@modules/myposyandu/frontend/pages/pagename/crud/edit.vue"
		// 				),
		// 		},

		// 		{
		// 			path: ":pagename/show",
		// 			name: "myposyandu-pagename-show",
		// 			component: () =>
		// 				import(
		// 					/* webpackChunkName: "myposyandu" */ "@modules/myposyandu/frontend/pages/pagename/crud/show.vue"
		// 				),
		// 		},
		// 	],
		// },
	],
};
