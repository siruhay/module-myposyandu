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

		// funding
		{
			path: "activity/:activity/funding",
			component: () =>
				import(
					/* webpackChunkName: "myposyandu" */ "@modules/myposyandu/frontend/pages/activity-funding/index.vue"
				),
			children: [
				{
					path: "",
					name: "myposyandu-funding",
					component: () =>
						import(
							/* webpackChunkName: "myposyandu" */ "@modules/myposyandu/frontend/pages/activity-funding/crud/data.vue"
						),
				},

				{
					path: "create",
					name: "myposyandu-funding-create",
					component: () =>
						import(
							/* webpackChunkName: "myposyandu" */ "@modules/myposyandu/frontend/pages/activity-funding/crud/create.vue"
						),
				},

				{
					path: ":funding/edit",
					name: "myposyandu-funding-edit",
					component: () =>
						import(
							/* webpackChunkName: "myposyandu" */ "@modules/myposyandu/frontend/pages/activity-funding/crud/edit.vue"
						),
				},

				{
					path: ":funding/show",
					name: "myposyandu-funding-show",
					component: () =>
						import(
							/* webpackChunkName: "myposyandu" */ "@modules/myposyandu/frontend/pages/activity-funding/crud/show.vue"
						),
				},
			],
		},

		// premise
		{
			path: "activity/:activity/premise",
			component: () =>
				import(
					/* webpackChunkName: "myposyandu" */ "@modules/myposyandu/frontend/pages/activity-premise/index.vue"
				),
			children: [
				{
					path: "",
					name: "myposyandu-premise",
					component: () =>
						import(
							/* webpackChunkName: "myposyandu" */ "@modules/myposyandu/frontend/pages/activity-premise/crud/data.vue"
						),
				},

				{
					path: "create",
					name: "myposyandu-premise-create",
					component: () =>
						import(
							/* webpackChunkName: "myposyandu" */ "@modules/myposyandu/frontend/pages/activity-premise/crud/create.vue"
						),
				},

				{
					path: ":premise/edit",
					name: "myposyandu-premise-edit",
					component: () =>
						import(
							/* webpackChunkName: "myposyandu" */ "@modules/myposyandu/frontend/pages/activity-premise/crud/edit.vue"
						),
				},

				{
					path: ":premise/show",
					name: "myposyandu-premise-show",
					component: () =>
						import(
							/* webpackChunkName: "myposyandu" */ "@modules/myposyandu/frontend/pages/activity-premise/crud/show.vue"
						),
				},
			],
		},

		// recipient
		{
			path: "activity/:activity/recipient",
			component: () =>
				import(
					/* webpackChunkName: "myposyandu" */ "@modules/myposyandu/frontend/pages/activity-recipient/index.vue"
				),
			children: [
				{
					path: "",
					name: "myposyandu-recipient",
					component: () =>
						import(
							/* webpackChunkName: "myposyandu" */ "@modules/myposyandu/frontend/pages/activity-recipient/crud/data.vue"
						),
				},

				{
					path: "create",
					name: "myposyandu-recipient-create",
					component: () =>
						import(
							/* webpackChunkName: "myposyandu" */ "@modules/myposyandu/frontend/pages/activity-recipient/crud/create.vue"
						),
				},

				{
					path: ":recipient/edit",
					name: "myposyandu-recipient-edit",
					component: () =>
						import(
							/* webpackChunkName: "myposyandu" */ "@modules/myposyandu/frontend/pages/activity-recipient/crud/edit.vue"
						),
				},

				{
					path: ":recipient/show",
					name: "myposyandu-recipient-show",
					component: () =>
						import(
							/* webpackChunkName: "myposyandu" */ "@modules/myposyandu/frontend/pages/activity-recipient/crud/show.vue"
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
