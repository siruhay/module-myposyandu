<template>
	<form-edit with-helpdesk>
		<template v-slot:default="{ combos: { services }, record }">
			<v-card-text>
				<v-row dense>
					<v-col cols="12">
						<v-text-field
							autocomplete="off"
							label="Nama Kegiatan"
							v-model="record.name"
							hide-details
						></v-text-field>
					</v-col>

					<v-col cols="6">
						<v-select
							:items="services"
							autocomplete="off"
							label="Bidang"
							v-model="record.service_id"
							hide-details
						></v-select>
					</v-col>

					<v-col cols="6">
						<v-date-input
							autocomplete="off"
							prepend-icon=""
							label="Tanggal"
							v-model="record.date"
							hide-details
						></v-date-input>
					</v-col>

					<v-col cols="6">
						<v-currency-field
							autocomplete="off"
							label="Jumlah Kebutuhan Anggaran"
							v-model="record.budget"
							hide-details
						></v-currency-field>
					</v-col>

					<v-col cols="6">
						<v-currency-field
							autocomplete="off"
							label="Jumlah Penerima Manfaat"
							v-model="record.participants"
							hide-details
						></v-currency-field>
					</v-col>

					<v-col cols="12">
						<v-text-field
							autocomplete="off"
							label="Pelaksana"
							v-model="record.executor"
							hide-details
						></v-text-field>
					</v-col>

					<v-col cols="12">
						<v-textarea
							autocomplete="off"
							label="Keterangan"
							v-model="record.description"
							hide-details
						></v-textarea>
					</v-col>
				</v-row>
			</v-card-text>
		</template>
	</form-edit>
</template>

<script>
export default {
	name: "myposyandu-activity-edit",
};
</script>
