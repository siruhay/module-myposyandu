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

		// activity
		{
			path: "activity",
			component: () =>
				import(
					/* webpackChunkName: "myposyandu" */ "@modules/myposyandu/frontend/pages/activity/index.vue"
				),
			children: [
				{
					path: "",
					name: "myposyandu-activity",
					component: () =>
						import(
							/* webpackChunkName: "myposyandu" */ "@modules/myposyandu/frontend/pages/activity/crud/data.vue"
						),
				},

				{
					path: "create",
					name: "myposyandu-activity-create",
					component: () =>
						import(
							/* webpackChunkName: "myposyandu" */ "@modules/myposyandu/frontend/pages/activity/crud/create.vue"
						),
				},

				{
					path: ":activity/edit",
					name: "myposyandu-activity-edit",
					component: () =>
						import(
							/* webpackChunkName: "myposyandu" */ "@modules/myposyandu/frontend/pages/activity/crud/edit.vue"
						),
				},

				{
					path: ":activity/show",
					name: "myposyandu-activity-show",
					component: () =>
						import(
							/* webpackChunkName: "myposyandu" */ "@modules/myposyandu/frontend/pages/activity/crud/show.vue"
						),
				},
			],
		},

		// founding
		{
			path: "activity/:activity/founding",
			component: () =>
				import(
					/* webpackChunkName: "myposyandu" */ "@modules/myposyandu/frontend/pages/activity-founding/index.vue"
				),
			children: [
				{
					path: "",
					name: "myposyandu-founding",
					component: () =>
						import(
							/* webpackChunkName: "myposyandu" */ "@modules/myposyandu/frontend/pages/activity-founding/crud/data.vue"
						),
				},

				{
					path: "create",
					name: "myposyandu-founding-create",
					component: () =>
						import(
							/* webpackChunkName: "myposyandu" */ "@modules/myposyandu/frontend/pages/activity-founding/crud/create.vue"
						),
				},

				{
					path: ":founding/edit",
					name: "myposyandu-founding-edit",
					component: () =>
						import(
							/* webpackChunkName: "myposyandu" */ "@modules/myposyandu/frontend/pages/activity-founding/crud/edit.vue"
						),
				},

				{
					path: ":founding/show",
					name: "myposyandu-founding-show",
					component: () =>
						import(
							/* webpackChunkName: "myposyandu" */ "@modules/myposyandu/frontend/pages/activity-founding/crud/show.vue"
						),
				},
			],
		},

		// beneficiary
		{
			path: "beneficiary",
			component: () =>
				import(
					/* webpackChunkName: "myposyandu" */ "@modules/myposyandu/frontend/pages/beneficiary/index.vue"
				),
			children: [
				{
					path: "",
					name: "myposyandu-beneficiary",
					component: () =>
						import(
							/* webpackChunkName: "myposyandu" */ "@modules/myposyandu/frontend/pages/beneficiary/crud/data.vue"
						),
				},

				{
					path: "create",
					name: "myposyandu-beneficiary-create",
					component: () =>
						import(
							/* webpackChunkName: "myposyandu" */ "@modules/myposyandu/frontend/pages/beneficiary/crud/create.vue"
						),
				},

				{
					path: ":beneficiary/edit",
					name: "myposyandu-beneficiary-edit",
					component: () =>
						import(
							/* webpackChunkName: "myposyandu" */ "@modules/myposyandu/frontend/pages/beneficiary/crud/edit.vue"
						),
				},

				{
					path: ":beneficiary/show",
					name: "myposyandu-beneficiary-show",
					component: () =>
						import(
							/* webpackChunkName: "myposyandu" */ "@modules/myposyandu/frontend/pages/beneficiary/crud/show.vue"
						),
				},
			],
		},

		// complaint
		{
			path: "complaint",
			component: () =>
				import(
					/* webpackChunkName: "mposyandu" */ "@modules/myposyandu/frontend/pages/complaint/index.vue"
				),
			children: [
				{
					path: "",
					name: "myposyandu-complaint",
					component: () =>
						import(
							/* webpackChunkName: "mposyandu" */ "@modules/myposyandu/frontend/pages/complaint/crud/data.vue"
						),
				},

				{
					path: "create",
					name: "myposyandu-complaint-create",
					component: () =>
						import(
							/* webpackChunkName: "mposyandu" */ "@modules/myposyandu/frontend/pages/complaint/crud/create.vue"
						),
				},

				{
					path: ":complaint/edit",
					name: "myposyandu-complaint-edit",
					component: () =>
						import(
							/* webpackChunkName: "mposyandu" */ "@modules/myposyandu/frontend/pages/complaint/crud/edit.vue"
						),
				},

				{
					path: ":complaint/show",
					name: "myposyandu-complaint-show",
					component: () =>
						import(
							/* webpackChunkName: "mposyandu" */ "@modules/myposyandu/frontend/pages/complaint/crud/show.vue"
						),
				},
			],
		},

		// report
		{
			path: "report",
			component: () =>
				import(
					/* webpackChunkName: "myposyandu" */ "@modules/myposyandu/frontend/pages/report/index.vue"
				),
			children: [
				{
					path: "",
					name: "myposyandu-report",
					component: () =>
						import(
							/* webpackChunkName: "myposyandu" */ "@modules/myposyandu/frontend/pages/report/crud/data.vue"
						),
				},

				{
					path: "create",
					name: "myposyandu-report-create",
					component: () =>
						import(
							/* webpackChunkName: "myposyandu" */ "@modules/myposyandu/frontend/pages/report/crud/create.vue"
						),
				},

				{
					path: ":report/edit",
					name: "myposyandu-report-edit",
					component: () =>
						import(
							/* webpackChunkName: "myposyandu" */ "@modules/myposyandu/frontend/pages/report/crud/edit.vue"
						),
				},

				{
					path: ":report/show",
					name: "myposyandu-report-show",
					component: () =>
						import(
							/* webpackChunkName: "myposyandu" */ "@modules/myposyandu/frontend/pages/report/crud/show.vue"
						),
				},
			],
		},
	],
};
