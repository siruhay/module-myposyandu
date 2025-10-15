<template>
	<form-create with-helpdesk>
		<template v-slot:default="{ combos: { categories, genders }, record }">
			<v-card-text>
				<v-row dense>
					<v-col cols="12">
						<v-text-field
							label="Nama"
							v-model="record.name"
							hide-details
						></v-text-field>
					</v-col>

					<v-col cols="6">
						<v-text-field
							label="N.I.K"
							v-model="record.slug"
							hide-details
							@blur="fetchBeneficiary(record)"
						></v-text-field>
					</v-col>

					<v-col cols="6">
						<v-text-field
							label="Nomor HP"
							v-model="record.phone"
							hide-details
						></v-text-field>
					</v-col>

					<v-col cols="6">
						<v-select
							:items="genders"
							label="Jenis Kelamin"
							v-model="record.gender_id"
							hide-details
						></v-select>
					</v-col>

					<v-col cols="3">
						<v-text-field
							label="RW"
							v-model="record.citizen"
							hide-details
						></v-text-field>
					</v-col>

					<v-col cols="3">
						<v-text-field
							label="RT"
							v-model="record.neighborhood"
							hide-details
						></v-text-field>
					</v-col>

					<v-col cols="12">
						<v-select
							:items="categories"
							label="Kategori"
							v-model="record.category_id"
							hide-details
						></v-select>
					</v-col>
				</v-row>
			</v-card-text>
		</template>
	</form-create>
</template>

<script>
export default {
	name: "myposyandu-recipient-create",

	methods: {
		fetchBeneficiary: function (record) {
			this.$http(`/myposyandu/api/fetch-data`, {
				method: "GET",
				params: {
					model: "beneficiary",
					refid: record.slug,
				},
			}).then((res) => {
				record.name = res.name;
				record.slug = res.slug;
				record.phone = res.phone;
				record.gender_id = res.gender_id;
				record.citizen = res.citizen;
				record.neighborhood = res.neighborhood;
				record.category_id = res.category_id;
			});
		},
	},
};
</script>
