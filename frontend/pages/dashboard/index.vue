<template>
	<page-home page-name="myposyandu-dashboard">
		<template v-slot:default>
			<v-row dense>
				<v-col cols="3">
					<v-sheet border="thin" rounded="lg">
						<div class="px-4 py-2">
							<div class="text-overline">Pengaduan Berproses</div>
						</div>
						<v-card-text class="pt-0 pb-2">
							<div class="font-weight-light">
								<span class="text-h4">100</span>
								<span class="text-h6">/1000</span>
							</div>
						</v-card-text>
						<v-divider></v-divider>
						<div class="d-flex align-center pl-4 pr-3 py-2">
							<div class="text-caption">Lihat semua data</div>
							<v-spacer></v-spacer>
							<v-icon>arrow_circle_right</v-icon>
						</div>
					</v-sheet>
				</v-col>

				<v-col cols="3">
					<v-sheet border="thin" rounded="lg">
						<div class="px-4 py-2">
							<div class="text-overline">Pengaduan Selesai</div>
						</div>
						<v-card-text class="pt-0 pb-2">
							<div class="font-weight-light">
								<span class="text-h4">100</span>
								<span class="text-h6">/1000</span>
							</div>
						</v-card-text>
						<v-divider></v-divider>
						<div class="d-flex align-center pl-4 pr-3 py-2">
							<div class="text-caption">Lihat semua data</div>
							<v-spacer></v-spacer>
							<v-icon>arrow_circle_right</v-icon>
						</div>
					</v-sheet>
				</v-col>

				<v-col cols="3">
					<v-sheet border="thin" rounded="lg">
						<div class="px-4 py-2">
							<div class="text-overline">Kegiatan Berproses</div>
						</div>
						<v-card-text class="pt-0 pb-2">
							<div class="font-weight-light">
								<span class="text-h4">100</span>
								<span class="text-h6">/1000</span>
							</div>
						</v-card-text>
						<v-divider></v-divider>
						<div class="d-flex align-center pl-4 pr-3 py-2">
							<div class="text-caption">Lihat semua data</div>
							<v-spacer></v-spacer>
							<v-icon>arrow_circle_right</v-icon>
						</div>
					</v-sheet>
				</v-col>

				<v-col cols="3">
					<v-sheet border="thin" rounded="lg">
						<div class="px-4 py-2">
							<div class="text-overline">Kegiatan Selesai</div>
						</div>
						<v-card-text class="pt-0 pb-2">
							<div class="font-weight-light">
								<span class="text-h4">100</span>
								<span class="text-h6">/1000</span>
							</div>
						</v-card-text>
						<v-divider></v-divider>
						<div class="d-flex align-center pl-4 pr-3 py-2">
							<div class="text-caption">Lihat semua data</div>
							<v-spacer></v-spacer>
							<v-icon>arrow_circle_right</v-icon>
						</div>
					</v-sheet>
				</v-col>
			</v-row>
		</template>
	</page-home>
</template>

<script>
export default {
	name: "myposyandu-dashboard",
};
</script>
