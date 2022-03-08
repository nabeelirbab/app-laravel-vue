<template>
	<div class="charts">
		<filter-container>
			<class-filter v-model="filters.classes" :single="true"></class-filter>
			<genre-filter v-model="filters.genres" :single="true"></genre-filter>
		</filter-container>
		<div class="chart-results">
			<div v-if="loadedAll">
				<div class="charts-section" v-if="!filters.classes.length || (currentClass == 'album')">
					<div class="header flex justify-between">
						<h2>Top Albums</h2>
						<a style="cursor:pointer" v-if="amount <= 7" @click.prevent="seeMore('album')">See more >></a>
					</div>
					<div class="chart-row">
						<div v-if="results.album" class="chart-result" v-for="(album, index) in results.album" :key="index">
							<release-tile :release="album" :size="150" mode="charts" :position="index"></release-tile>
						</div>
						<div class="not-found-div" v-if="!results.album || !results.album.length">
							No Albums Found
						</div>
					</div>
				</div>
				<div class="charts-section" v-if="!filters.classes.length || (currentClass == 'single')">
					<div class="header flex justify-between">
						<h2>Top Singles</h2>
						<a style="cursor:pointer" v-if="amount <= 7" @click.prevent="seeMore('single')">See more >></a>
					</div>
					<div class="chart-row">
						<div v-if="results.single" class="chart-result" v-for="(single, index) in results.single" :key="index">
							<release-tile :release="single" :size="150" mode="charts" :position="index"></release-tile>
						</div>
						<div class="not-found-div" v-if="!results.single || !results.single.length">
							No Singles Found
						</div>
					</div>
				</div>
				<div class="charts-section" v-if="!filters.classes.length || (currentClass == 'ep')">
					<div class="header flex justify-between">
						<h2>Top Top EPs</h2>
						<a style="cursor:pointer" v-if="amount <= 7" @click.prevent="seeMore('ep')">See more >></a>
					</div>
					<div class="chart-row">
						<div v-if="results.ep" class="chart-result" v-for="(ep, index) in results.ep">
							<release-tile :release="ep" :size="150" mode="charts" :position="index"></release-tile>
						</div>
						<div class="not-found-div" v-if="!results.ep || !results.ep.length">
							No EP's Found
						</div>
					</div>
				</div>
				<div class="charts-section" v-if="!filters.classes.length || (currentClass == 'compilation')">
					<div class="header flex justify-between">
						<h2>Top Compilations</h2>
						<a style="cursor:pointer" v-if="amount <= 7" class="see-more" @click.prevent="seeMore('compilation')">See more >></a>
					</div>
					<div class="chart-row">
						<div v-if="results.compilation" class="chart-result" v-for="(compilation, index) in results.compilation" :key="index">
							<release-tile :release="compilation" :size="150" mode="charts" :position="index"></release-tile>
						</div>
						<div class="not-found-div" v-if="!results.compilation || !results.compilation.length">
							No Compilations Found
						</div>
					</div>
				</div>
				<div class="charts-section" v-if="!filters.classes.length || (currentClass == 'sample')">
					<div class="header flex justify-between">
						<h2>Top Sample Packs</h2>
						<a style="cursor:pointer" v-if="amount <= 7" @click.prevent="seeMore('sample')">See more >></a>
					</div>
					<div class="chart-row">
						<div v-if="results.sample" class="chart-result" v-for="(sample, index) in results.sample" :key="index">
							<release-tile :release="sample" :size="150" mode="charts" :position="index"></release-tile>
						</div>
						<div class="not-found-div" v-if="!results.sample || !results.sample.length">
							No Sample Packs Found
						</div>
					</div>
				</div>
			</div>
			<div v-else>
				<div style="display:flex;justfiy-content:center;align-items:center;">
					<spinner style="margin: 3em auto;" :animation-duration="1000" :size="60" color="black" />
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import { HalfCircleSpinner as Spinner } from "epic-spinners";

import FilterContainer from "global/filters/filter-container";
import ClassFilter from "global/filters/class-filter";
import GenreFilter from "global/filters/genre-filter";

import ReleaseTile from "global/releases/release-tile";

export default {
	data() {
		return {
			loadedAll: false,
			amount: 12,
			filters: {
				classes: [],
				genres: [],
			},
			results: {
				albums: [],
				singles: [],
				eps: [],
				compilations: [],
			},
		};
	},
	computed: {
	    currentClass: function () {
	      if(this.filters.classes.length > 0) {
	      	return this.filters.classes[0].val;
	      }
	      return '';
	    },
  	},
	created: function() {
		if (this.$route.query.filter) {
			this.filters.classes.push({
				name: this.capitalizeFirstLetter(this.$route.query.filter),
				val: this.$route.query.filter,
			});
		}
		this.fetchCharts();
	},
	watch: {
		filters: {
			handler: function() {
				this.fetchCharts();
			},
			deep: true,
		},
	},
	methods: {
		fetchCharts() {
			this.loadedAll = false;
			this.filters.newsearch = 1;
			axios.post(`/api/charts/${this.amount}`, this.filters).then((response) => {
				if(response.data.filters) {
					if(JSON.stringify(response.data.filters) === JSON.stringify(this.filters)) {
						this.results = response.data.returndata;
					}
				}else{
					this.results = response.data;
				}
				this.loadedAll = true;
			});
		},
		seeMore(className) {
			this.amount = 20;
			this.filters.classes.push({
				name: this.capitalizeFirstLetter(className),
				val: className,
			});
		},
		capitalizeFirstLetter(string) {
			return string.charAt(0).toUpperCase() + string.slice(1);
		},
	},
	components: {
		Spinner,

		FilterContainer,
		ClassFilter,
		GenreFilter,

		ReleaseTile,
	},
};
</script>

<style lang="scss" scoped>
.charts {
	display: flex;
	align-items: flex-start;

	@media (max-width: 900px) {
		display: block;
	}

	.chart-results {
		padding: 0 20px;

		.charts-section {
			margin: 40px 0;
			.header {
				margin-bottom: 20px;
				align-items: flex-start;
				h2 {
					margin: 0 10px 0 0;
				}
			}

			.chart-row {
				display: grid;
				grid-template-columns: repeat(5, 1fr);
				@media (max-width: 900px) {
					grid-template-columns: repeat(3, 1fr);
				}
				@media (max-width: 650px) {
					grid-template-columns: repeat(2, 1fr);
				}
				grid-gap: 10px;
			}
		}
	}

	.not-found-div {
		width: 800px;
		text-align: center;
	}
}
</style>
