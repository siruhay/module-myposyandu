<template>
	<form-create with-helpdesk>
		<template v-slot:default="{ combos: { complaints }, record }">
			<v-card-text>
				<v-row dense>
					<v-col cols="12">
						<v-combobox
							:items="complaints"
							:return-object="false"
							label="Pengaduan"
							v-model="record.complaint_id"
						></v-combobox>
					</v-col>
				</v-row>
			</v-card-text>
		</template>
	</form-create>
</template>

<script>
export default {
	name: "myposyandu-premise-create",
};
</script>
