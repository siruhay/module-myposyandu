<template>
	<form-show with-helpdesk>
		<template v-slot:default="{ combos: { services }, record }">
			<v-card-text>
				<v-row dense>
					<v-col cols="12">
						<v-text-field
							autocomplete="off"
							label="Nama Warga"
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

			<div class="text-overline px-4">dokumen</div>
			<v-divider></v-divider>

			<v-card-text>
				<v-row dense>
					<v-col
						v-for="(document, documentIndex) in record.paths"
						:key="documentIndex"
						cols="12"
					>
						<file-upload
							:accept="document.mime"
							:label="document.name"
							:extension="document.extension"
							:slug="document.slug"
							:callback="(res) => (document.path = res.path)"
							v-model="document.path"
							backend-url="/myposyandu/api/upload-document"
							density="comfortable"
							deletable
							hide-details
							readonly
							uploadable
						></file-upload>
					</v-col>
				</v-row>
			</v-card-text>
		</template>

		<template v-slot:helpdesk></template>
	</form-show>
</template>

<script>
export default {
	name: "myposyandu-complaint-show",
};
</script>
